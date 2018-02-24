<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

Class Loans_Model extends CI_Model {

// CREATE DATA ////////////////////////////////////////////////////////////////////


    /**
     * -------------------------------------------------------------------------------
     * Loans
     * ------------------------------------------------------------------------------- 
     */

   /**
     * Generates a  ID
     */
    function generate_loanID($acc_id) {

        $acc = explode('-', $acc_id);

        $total_rows = $this->db->count_all('loans');

        return date('Y').'-'.$acc[1].'-'.prettyID(($total_rows + 1), 5);  
    }



    function create($acc_id, $due_date) {

        $id = $this->generate_loanID($acc_id); //generate ID

        $data = array(
            'id'                    => $id,
            'borrower_id'           => $acc_id,  
            'borrowed_amount'       => strip_tags($this->input->post('loan_amount')),  
            'borrowed_percentage'   => strip_tags($this->input->post('loan_rate')),  
            'due_date'              => $due_date
        );

        $this->db->insert('loans', $data);

        return $id;
    }



    function view($id) {
        $this->db->select('
          loans.id,
          loans.borrower_id,
          loans.borrowed_amount,
          loans.due_date,
          loans.due_days,
          loans.borrowed_percentage,
          loans.description,
          loans.status,
          loans.approved_at,
          loans.created_at,
          loans.updated_at,
          CONCAT(borrowers.firstname, " ", borrowers.lastname) as name');
        $this->db->join('borrowers', 'borrowers.id = loans.borrower_id', 'left');
        $this->db->where('loans.id', $id);
        $query = $this->db->get('loans');

        return $query->row_array();
    }

    function update_status($loan_id, $status) {
        $this->db->where('id', $loan_id);
        return $this->db->update('loans', array('status' => $status));
    }

    /**
     * Updates the Approved Date Time
     * @param  [type] $loan_id [description]
     * @return [type]          [description]
     */
    function update_approve($loan_id, $loan_days) {

        $approved = unix_to_human(time(), TRUE, 'eu');
        $due_date = AddDays($loan_days, date('Y-m-d'));

        $this->db->where('id', $loan_id);
        return $this->db->update('loans', array('approved_at' => $approved, 'due_date' => $due_date));
    }

    /**
     * Returns a range of array of data as per request
     * - Used by Borrower List Pagination
     * @param  Int      $limit        The limit of records to be returned
     * @param  Int      $id           The ID of page
     * @param  String   $search       The search query
     * @param  Int      $is_deleted   if deleted record or not
     * @return Array             [description]
     */
    function fetch_loans($limit, $id, $search, $status, $acc_id) {

            //Search Query
            if($search) {
              $this->db->like('borrowers.firstname', $search);
              $this->db->or_like('borrowers.middlename', $search);
              $this->db->or_like('borrowers.lastname', $search);;
              $this->db->or_like('borrowers.id', $search);
              $this->db->or_like('loans.id', $search);
              $this->db->or_like('loans.due_date', $search);
            }            
            
            if(!is_null($limit)) {
                $this->db->limit($limit, (($id-1)*$limit));
            }

            if(!is_null($status)) {

              switch ($status) {
                        case 'overdue':
                          $this->db->where('loans.status', 1); //approved status
                          $this->db->where('loans.due_date <= NOW()');
                          break;
                        
                        default:
                          $this->db->where('loans.status', $status); //approved status                          
                          break;
                      }        
            }

            if(!is_null($acc_id)) {
                $this->db->where('loans.borrower_id', $acc_id);
            }

            $this->db->select('
                CONCAT(borrowers.firstname, " ", borrowers.lastname) as name,
                borrowers.img,
                borrowers.firstname,
                borrowers.middlename,
                borrowers.lastname,
                borrowers.civil_status,
                borrowers.sex,
                borrowers.birthdate,
                borrowers.is_deleted,
                borrowers.created_at,
                borrowers.id as borrower_id,
                loans.id,
                loans.borrower_id,
                loans.borrowed_amount,
                loans.due_date,
                loans.created_at,
                loans.updated_at,
                loans.status
            ');

            $this->db->join('borrowers', 'borrowers.id = loans.borrower_id', 'left');
            $this->db->order_by('loans.created_at', 'DESC');

            $query = $this->db->get("loans");

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;

    }

    /**
     * Counts the number of rows existing 
     * - Used by Pagination
     * @param  String     $search       The Search query
     * @param  Int        $is_deleted   if deleted record or not
     * @return Int         [description]
     */
    function count_loans($search, $status, $acc_id = NULL) {
        
        //Search Query
        if($search) {
              $this->db->like('borrowers.firstname', $search);
              $this->db->or_like('borrowers.middlename', $search);
              $this->db->or_like('borrowers.lastname', $search);;
              $this->db->or_like('borrowers.id', $search);
              $this->db->or_like('loans.id', $search);
              $this->db->or_like('loans.due_date', $search);
        }   
        if(!is_null($status)) {

              switch ($status) {
                        case 'overdue':
                          $this->db->where('loans.status', 1); //approved status
                          $this->db->where('loans.due_date <= NOW()');
                          break;
                        
                        default:
                          $this->db->where('loans.status', $status); //approved status                          
                          break;
                      }        
            }

        if(!is_null($acc_id)) {
              $this->db->where('loans.borrower_id', $acc_id);
        }

        $this->db->join('borrowers', 'borrowers.id = loans.borrower_id', 'left');
        return $this->db->count_all_results("loans");
    }

    


    /**
     * ------------------------------------------------------------------------------------------
     * Loan Expenses and Income 
     * ------------------------------------------------------------------------------------------
     */
    
    function fetch_expenses($loan_id = null) {

        if($loan_id) {
            //expenses record of a loan
           $this->db->select('
              loans_expense.id as id,
              loans_expense.amount,
              expenses.title
            '); 
            $this->db->join('loans_expense', 'loans_expense.expense_id = expenses.id AND loans_expense.loan_id="' . $loan_id . '"', 'left');

            $query = $this->db->get('expenses');

            return $query->result_array();


        } else {
            //return the expenses categories
            return $this->db->get('expenses')->result_array();
        }
    }


    function fetch_income($loan_id = null) {

        if(!is_null($loan_id)) {
            //income record of a loan
            $this->db->select('
              loans_income.id as id,
              loans_income.amount,
              income.title
            ');
            $this->db->group_by('income.title');
            $this->db->join('loans_income', 'loans_income.income_id = income.id AND loans_income.loan_id="' . $loan_id . '"', 'left');

            $query = $this->db->get('income');

            return $query->result_array();
        } else {
            //return the income categories
            return $this->db->get('income')->result_array();
        }
    }


    function add_expense($loan_id, $exp_id, $amount) {

        $data = array(
            'loan_id'       =>  $loan_id,
            'expense_id'    =>  $exp_id,
            'amount'        =>  $amount
        );

        $this->db->insert('loans_expense', $data);

        return $this->db->insert_id();
    }


    function add_income($loan_id, $inc_id, $amount) {

        $data = array(
            'loan_id'       =>  $loan_id,
            'income_id'     =>  $inc_id,
            'amount'        =>  $amount
        );

        $this->db->insert('loans_income', $data);

        return $this->db->insert_id();
    }


    /**
     * ------------------------------------------------------------------------------------------
     * Loan creditors
     * ------------------------------------------------------------------------------------------
     */

    function add_creditors($loan_id, $name, $addr, $amount, $remarks) {

        $data = array(
            'loan_id'       =>  $loan_id,
            'fullname'      =>  $name,
            'address'       =>  $addr,
            'amount'        =>  $amount,
            'remarks'       =>  $remarks
        );

        $this->db->insert('loans_creditors', $data);

        return $this->db->insert_id();
    }


    function fetch_creditors($loan_id) {

        return $this->db->where('loan_id', $loan_id)->get('loans_creditors')->result_array();


    }



    /**
     * ------------------------------------------------------------------------------------------
     * Loan ledger
     * ------------------------------------------------------------------------------------------
     */
    
    function fetch_ledger($loan_id) {

        $this->db->where('loan_id', $loan_id);
        $this->db->select('
          code,
          debit,
          credit,
          created_at,
          description,
          user
        ');

        return $this->db->get('loans_ledger')->result_array();
    }


    function fetch_ledger_codes($type = NULL) {
        if (!is_null($type)) {
          $this->db->where('type', $type);
        }
        return $this->db->get('loans_ledger_codes')->result_array();
    }


    function add_ledger($loan_id, $amount, $user, $description, $code) {

          $debit  = 0;
          $credit = 0;

          //Override Credit
          if($amount > 0) {
            $credit = abs($amount);
          }
          //Override Debit
          if($amount < 0) {
            $debit = abs($amount);
          }

          $data = array(
            'loan_id'     => $loan_id,
            'code'        => $code,
            'description' => $description,
            'debit'       => $debit,
            'credit'      => $credit,
            'user'        => $user
          );

          $this->db->insert('loans_ledger', $data);

          return $this->db->insert_id();

    }


  /**
   * -----------------------------------------------------------------------------------
   * Used By SMS
   */
  function fetch_active_loans($from = null, $to = null) {
        
    
         $this->db->select('
                CONCAT(borrowers.firstname, " ", borrowers.lastname) as name,
                borrowers.id as borrower_id,
                loans.id as loan_id,
                loans.borrowed_amount
            ');
        $this->db->join('borrowers', 'borrowers.id = loans.borrower_id', 'left');
        $this->db->where('loans.status = 1');
        $this->db->where('DATE(loans.due_date) > DATE(now())');
        $loan_data = $this->db->get('loans')->result_array(); 

        $loan_arr = array();
        if ($loan_data) {
            foreach ($loan_data as $ld) {
              $ld['contacts'] = array_values($this->fetch_contacts($ld['borrower_id'], 0));
              $loan_arr[] = $ld;  
            }      


            return $loan_arr;
        }

        return FALSE;

        //Another Query
        
  }

  function fetch_contacts($borrower_id, $type = 0) {
      $this->db->select('(value) as contact');
      $this->db->where('type', $type);
      $this->db->where('borrower_id', $borrower_id);
      $query = ($this->db->get('borrowers_contacts')->result_array());

      $data = array();
      foreach ($query as $quer) {
        $data[] =  safeContact($quer['contact']);

      }

      return $data;
  }


  function count_payments_week($loan_id, $from, $to) {
        $this->db->select('*');
        $this->db->where('loan_id', $loan_id);
        $this->db->where('loans_payments.created_at BETWEEN "'.$from.'" AND "'.$to.'"');
        return $this->db->count_all_results('loans_payments');
  }


   


}