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


    function fetch_payments($limit, $id, $loan_id = NULL, $search = NULL, $date = NULL) {

            
            if(!is_null($limit)) {
               if (!is_null($id)) {
                  $this->db->limit($limit, (($id-1)*$limit));
               } else {
                 $this->db->limit($limit);
               }
            }

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

            if(!is_null($loan_id)) {
            $this->db->where('loan_id', $loan_id);
            }

            if(!is_null($search)) {
                  $this->db->like('loans_payments.id', $search);
                  $this->db->or_like('loans_payments.payee', $search);
                  $this->db->or_like('loans_payments.amount', $search);;
                  $this->db->or_like('loans_payments.description', $search);
                  $this->db->or_like('loans_payments.receipt', $search);
                  $this->db->or_like('loans_payments.created_at', $search);
            }  

            if (!is_null($date)) {
              switch ($date) {
                case 'now':
                  $from = unix_to_human(strtotime("today"), TRUE,'eu');
                  $to   = unix_to_human(strtotime("tomorrow"), TRUE,'eu');
                  $this->db->where('loans_payments.created_at BETWEEN "'.$from.'" AND "'.$to.'"');
                  break;

                case 'week':
                  $from = unix_to_human(strtotime("this week"), TRUE,'eu');
                  $to   = unix_to_human(strtotime("next week"), TRUE,'eu');
                  $this->db->where('loans_payments.created_at BETWEEN "'.$from.'" AND "'.$to.'"');
                  break;

                case 'year':
                  $this->db->where('YEAR(loans_payments.created_at) = YEAR(now())');
                  break;

                case 'month':
                  $this->db->where('MONTH(loans_payments.created_at) = MONTH(now())');
                  break;
                
                default:
                  //Standard fetch date procedure
                  $arr_date = (explode("-",$date));
                  $str_from = str_replace(" ", "", ($arr_date[0]));
                  $str_to = str_replace(" ", "", ($arr_date[1]));

                  $arr_from = explode('/', $str_from);
                  $from = $arr_from[2].'-'.$arr_from[0].'-'.$arr_from[1];

                  $arr_to = explode('/', $str_to);
                  $to = $arr_to[2].'-'.$arr_to[0].'-'.$arr_to[1] . ' 23:59:59';
                  $this->db->where('loans_payments.created_at BETWEEN "'.$from.'" AND "'.$to.'"');

                  break;
              }

            }

            $this->db->order_by('loans_payments.created_at', 'DESC');

            $query = $this->db->get("loans_payments");

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;

    }

    
    function count_payments($loan_id = NULL, $search = NULL, $date = NULL) {
        
         if(!is_null($loan_id)) {
            $this->db->where('loan_id', $loan_id);
        }

        if(!is_null($search)) {
              $this->db->like('loans_payments.id', $search);
              $this->db->or_like('loans_payments.payee', $search);
              $this->db->or_like('loans_payments.amount', $search);;
              $this->db->or_like('loans_payments.description', $search);
              $this->db->or_like('loans_payments.receipt', $search);
              $this->db->or_like('loans_payments.created_at', $search);
        }   

        if (!is_null($date)) {
              switch ($date) {
                case 'now':
                  $from = unix_to_human(strtotime("today"), TRUE,'eu');
                  $to   = unix_to_human(strtotime("tomorrow"), TRUE,'eu');

                  $this->db->where('loans_payments.created_at BETWEEN "'.$from.'" AND "'.$to.'"');
                  break;

                case 'week':
                  $from = unix_to_human(strtotime("this week"), TRUE,'eu');
                  $to   = unix_to_human(strtotime("next week"), TRUE,'eu');

                  $this->db->where('loans_payments.created_at BETWEEN "'.$from.'" AND "'.$to.'"');
                  break;

                case 'month':
                  $this->db->where('MONTH(loans_payments.created_at) = MONTH(now())');
                  break;

                case 'year':
                  $this->db->where('YEAR(loans_payments.created_at) = YEAR(now())');
                  break;
                
                default:
                  # code...
                  break;
              }

            }

        return $this->db->count_all_results("loans_payments");
    }



   


}