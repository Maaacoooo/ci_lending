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


    /**
     * Returns a range of array of data as per request
     * - Used by Borrower List Pagination
     * @param  Int      $limit        The limit of records to be returned
     * @param  Int      $id           The ID of page
     * @param  String   $search       The search query
     * @param  Int      $is_deleted   if deleted record or not
     * @return Array             [description]
     */
    function fetch_borrowers($limit, $id, $search, $is_deleted) {

            if($search) {
              $this->db->like('borrowers.firstname', $search);
              $this->db->or_like('borrowers.middlename', $search);
              $this->db->or_like('borrowers.lastname', $search);
              $this->db->or_like('borrowers.spouse_name', $search);
              $this->db->or_like('borrowers.id', $search);
            }            

            $this->db->where('borrowers.is_deleted', $is_deleted);
            $this->db->limit($limit, (($id-1)*$limit));

            $query = $this->db->get("borrowers");

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
    function count_borrowers($search, $is_deleted) {
        if($search) {
            $this->db->like('borrowers.firstname', $search);
            $this->db->or_like('borrowers.middlename', $search);
            $this->db->or_like('borrowers.lastname', $search);
            $this->db->or_like('borrowers.spouse_name', $search);
            $this->db->or_like('borrowers.id', $search);
        }

        $this->db->where('is_deleted', $is_deleted);
        return $this->db->count_all_results("borrowers");
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
        } else {
            //return the expenses categories
            return $this->db->get('expenses')->result_array();
        }
    }


    function fetch_income($loan_id = null) {

        if($loan_id) {
            //expenses record of a loan
        } else {
            //return the expenses categories
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


}