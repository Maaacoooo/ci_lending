<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

Class Expenses_model extends CI_Model {


    function create($user) {

        $data = array(
            'payee'         => strip_tags($this->input->post('payee')),
            'receipt'       => strip_tags($this->input->post('receipt')),
            'description'   => strip_tags($this->input->post('description')),
            'amount'        => strip_tags($this->input->post('amount')),
            'user'          => $user
        );

        $this->db->insert('store_expenses', $data);

        return $this->db->insert_id();
    }


    function view($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('store_expenses');

        return $query->row_array();
    }


    function fetch_expenses($limit, $id, $search, $date = NULL) {

            if($search) {
              $this->db->like('payee', $search);
              $this->db->or_like('description', $search);
              $this->db->or_like('amount', $search);
              $this->db->or_like('receipt', $search);
            }  

            if(!is_null($limit)) {
               if (!is_null($id)) {
                  $this->db->limit($limit, (($id-1)*$limit));
               } else {
                 $this->db->limit($limit);
               }
            }


            if(!is_null($date)) {
               switch ($date) {
                 case 'now':
                   $from = unix_to_human(strtotime("today"), TRUE,'eu');
                   $to   = unix_to_human(strtotime("tomorrow"), TRUE,'eu');
                   $this->db->where('store_expenses.created_at BETWEEN "'.$from.'" AND "'.$to.'"');
                   break;
                 
                 default:
                   $arr_date = (explode("-",$date));
                   $str_from = str_replace(" ", "", ($arr_date[0]));
                   $str_to = str_replace(" ", "", ($arr_date[1]));

                   $arr_from = explode('/', $str_from);
                   $from = $arr_from[2].'-'.$arr_from[0].'-'.$arr_from[1];

                   $arr_to = explode('/', $str_to);
                   $to = $arr_to[2].'-'.$arr_to[0].'-'.$arr_to[1] . ' 23:59:59';
                   $this->db->where('store_expenses.created_at BETWEEN "'.$from.'" AND "'.$to.'"');

                   break;
               }

            }

            $this->db->select('
              users.username as user,
              users.name,
              store_expenses.id,
              store_expenses.payee,
              store_expenses.amount,
              store_expenses.receipt,
              store_expenses.description,
              store_expenses.created_at
              ');
            $this->db->join('users', 'users.username = store_expenses.user', 'left');
            $this->db->order_by('store_expenses.created_at', 'DESC');

            $query = $this->db->get("store_expenses");

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;

    }

    
    function count_expenses($search, $date = NULL) {
        if($search) {
              $this->db->like('payee', $search);
              $this->db->or_like('description', $search);
              $this->db->or_like('amount', $search);
              $this->db->or_like('receipt', $search);
        } 
        return $this->db->count_all_results("store_expenses");
    }



   


}