<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

Class Payments_Model extends CI_Model {



    function generateID() {

        $total_rows = $this->db->count_all('loans_payments');
        return 'PAY'. date('Y').'-'.prettyID(($total_rows + 1), 5);  
    }


    function create($loan_id, $amount, $payee, $description, $receipt, $user) {

        $id = $this->generateID();

        $data = array(
            'id'          => $id,
            'loan_id'     => $loan_id,
            'amount'      => $amount,
            'payee'       => $payee,            
            'description' => $description,  
            'receipt'     => $receipt,
            'loan_id'     => $loan_id,
            'user'        => $user
        );

        $this->db->insert('loans_payments', $data);

        return $id;
    }


    function view($id) {
        $this->db->select('
              users.username as user,
              users.name,
              loans_payments.id,
              loans_payments.loan_id,
              loans_payments.receipt,
              loans_payments.amount,
              loans_payments.payee,
              loans_payments.description,
              loans_payments.created_at
              ');
        $this->db->join('users', 'users.username = loans_payments.user', 'left');
        $this->db->where('id', $id);
        $query = $this->db->get('loans_payments');

        return $query->row_array();
    }


    function fetch_payments($limit, $id, $loan_id = NULL) {

            
            if(!is_null($limit)) {
                $this->db->limit($limit, (($id-1)*$limit));
            }

            $this->db->select('
              users.username as user,
              users.name,
              loans_payments.id,
              loans_payments.receipt,
              loans_payments.amount,
              loans_payments.payee,
              loans_payments.description,
              loans_payments.created_at
              ');
            $this->db->join('users', 'users.username = loans_payments.user', 'left');

            if($loan_id) {
                $this->db->where('loan_id', $loan_id);
            }

            $this->db->order_by('loans_payments.created_at', 'DESC');

            $query = $this->db->get("loans_payments");

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;

    }

    
    function count_payments($loan_id = NULL) {
        
         if($loan_id) {
            $this->db->where('loan_id', $loan_id);
        }
        return $this->db->count_all_results("loans_payments");
    }



   


}