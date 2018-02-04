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
        $this->db->where('loans.id', $id);
        $query = $this->db->get('loans');

        return $query->row_array();
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
                $this->db->where('loans.status', $status);
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
    function count_loans($search, $status) {
        
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
              $this->db->where('loans.status', $status);
        }

        $this->db->join('borrowers', 'borrowers.id = loans.borrower_id', 'left');
        return $this->db->count_all_results("loans");
    }

    
    function view_contact($id) {
        $this->db->where('id', $id);
        return $this->db->get('borrowers_contacts')->row_array();
    }

    function delete_contact($id) {
        $this->db->where('id', $id);
        return $this->db->delete('borrowers_contacts');
    }

    function update_contact($id) {
        $data = array(
            'value'   => strip_tags($this->input->post('value'))
            );

         $this->db->where('id', $id);
         return $this->db->update('borrowers_contacts', $data);
    }

    function create_contact($acc_id, $type, $value) {
        $data = array(
            'borrower_id' => $acc_id,
            'type'        => $type,
            'value'   => $value
            );

         return $this->db->insert('borrowers_contacts', $data);
    }

    function fetch_contacts($acc_id, $type) {
        $this->db->where('type', $type);
        $this->db->where('borrower_id', $acc_id);
        $query = $this->db->get('borrowers_contacts');

        return $query->result_array();
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


    function add_ledger($loan_id, $amount, $user) {

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
            'code'        => strip_tags($this->input->post('code')),
            'description' => strip_tags($this->input->post('description')),
            'debit'       => $debit,
            'credit'      => $credit,
            'user'        => $user
          );

          $this->db->insert('loans_ledger', $data);

          return $this->db->insert_id();

    }


   


}