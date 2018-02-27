<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

Class Payments_Model extends CI_Model {



    function generateID() {

        $total_rows = $this->db->count_all('loans_payments');
        return 'PAY'. date('Y').'-'.prettyID(($total_rows + 1), 5);  
    }

    function check_pin_user($pin) {
        $this->db->where('pin', $pin);
        return $this->db->get('users')->row_array();
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
        $this->set_scheduled_payment($loan_id, $amount);
        
        return $id;
    }


    function set_scheduled_payment($loan_id, $amount) {
      //fetch schedules
        $this->db->where('loan_id', $loan_id);
        $query = $this->db->get('loans_payments_schedule');
        
        foreach ($query->result_array() as $sched) {
          if($sched['amount'] != $sched['paid_actual'] && $amount != 0) {
              
              $balance = $sched['amount'] - $sched['paid_actual'];

              if ($amount > $balance) {
                //update actual_paid same with the amount
                $this->db->where('id', $sched['id']);
                $this->db->update('loans_payments_schedule', array('paid_actual' => $sched['amount']));
                //set new amount value
                $amount = $amount - $balance;
              } else {
                $this->db->where('id', $sched['id']);
                $this->db->update('loans_payments_schedule', array('paid_actual' => $amount));
                //set new amount value
                $amount = 0;
              }

          }
        }

        return $amount;

        
    }


    function view($id) {
        $this->db->select('
              users.username as user,
              CONCAT(users.firstname, " ",users.lastname) as name, 
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
              CONCAT(users.firstname, " ",users.lastname) as name, 
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



    /**
     * --------------------------------------------------------------------
     * Schedules
     * --------------------------------------------------------------------
     */
    
    function set_schedules($loan_id, $loan_days=0, $loan_amount=NULL, $startdate = NULL) {
      

      if (!is_null($startdate)) {
        $startdate = date('Y-m-d', strtotime($startdate));
      } else {
        $startdate = date('Y-m-d');
      }

      
      $enddate = AddDays($loan_days, $startdate);
      $data = getSchedules($startdate, $enddate, $loan_amount);

      foreach ($data as $d) {
        $d['loan_id'] = $loan_id;
        $compile[] = $d; //rebuild 
      }

      return $this->db->insert_batch('loans_payments_schedule', $compile);
  }



  function fetch_schedules($limit, $id, $loan_id = NULL, $search = NULL, $date = NULL) {

            
            if(!is_null($limit)) {
               if (!is_null($id)) {
                  $this->db->limit($limit, (($id-1)*$limit));
               } else {
                 $this->db->limit($limit);
               }
            }

            $this->db->select('
              CONCAT(borrowers.firstname, " ",borrowers.lastname) as borrower, 
              borrowers.id as borrower_id,
              loans.id as loan_id,
              loans.borrowed_percentage,
              loans.borrowed_amount,
              loans_payments_schedule.id,
              loans_payments_schedule.schedule,
              loans_payments_schedule.amount,
              loans_payments_schedule.paid_actual,
              loans_payments_schedule.paid_date
              ');
            $this->db->join('loans', 'loans.id = loans_payments_schedule.loan_id', 'left');
            $this->db->join('borrowers', 'borrowers.id = loans.borrower_id', 'left');

            $this->db->group_by('loans_payments_schedule.id');

            if(!is_null($loan_id)) {
            $this->db->where('loans_payments_schedule.loan_id', $loan_id);
            }

            if(!is_null($search)) {
                  $this->db->like('borrowers.firstname', $search);
                  $this->db->or_like('borrowers.middlename', $search);
                  $this->db->or_like('borrowers.lastname', $search);;
                  $this->db->or_like('borrowers.id', $search);
                  $this->db->or_like('loans.id', $search);
                  $this->db->or_like('loans.due_date', $search);
                  $this->db->or_like('loans_payments_schedule.schedule,', $search);
            }  

            if (!is_null($date)) {
              switch ($date) {
                case 'now':
                  $from = unix_to_human(strtotime("today"), TRUE,'eu');
                  $to   = unix_to_human(strtotime("tomorrow"), TRUE,'eu');
                  $this->db->where('loans_payments_schedule.created_at BETWEEN "'.$from.'" AND "'.$to.'"');
                  break;

                case 'week':
                  $from = unix_to_human(strtotime("this week"), TRUE,'eu');
                  $to   = unix_to_human(strtotime("next week"), TRUE,'eu');
                  $this->db->where('loans_payments_schedule.created_at BETWEEN "'.$from.'" AND "'.$to.'"');
                  break;

                case 'year':
                  $this->db->where('YEAR(loans_payments_schedule.created_at) = YEAR(now())');
                  break;

                case 'month':
                  $this->db->where('MONTH(loans_payments_schedule.created_at) = MONTH(now())');
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


                  $this->db->where('loans_payments_schedule.created_at BETWEEN "'.$from.'" AND "'.$to.'"');

                  break;
              }

            }

            $query = $this->db->get("loans_payments_schedule");

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;

    }

    
    function count_schedules($loan_id = NULL, $search = NULL, $date = NULL) {
        

        $this->db->join('loans', 'loans.id = loans_payments_schedule.loan_id', 'left');
        $this->db->join('borrowers', 'borrowers.id = loans.borrower_id', 'left');

         if(!is_null($loan_id)) {
            $this->db->where('loans_payments_schedule.loan_id', $loan_id);
        }

        if(!is_null($search)) {
            $this->db->like('borrowers.firstname', $search);
            $this->db->or_like('borrowers.middlename', $search);
            $this->db->or_like('borrowers.lastname', $search);;
            $this->db->or_like('borrowers.id', $search);
            $this->db->or_like('loans.id', $search);
            $this->db->or_like('loans.due_date', $search);
            $this->db->or_like('loans_payments_schedule.schedule,', $search);
        }   

         if (!is_null($date)) {
              switch ($date) {
                case 'now':
                  $from = unix_to_human(strtotime("today"), TRUE,'eu');
                  $to   = unix_to_human(strtotime("tomorrow"), TRUE,'eu');
                  $this->db->where('loans_payments_schedule.created_at BETWEEN "'.$from.'" AND "'.$to.'"');
                  break;

                case 'week':
                  $from = unix_to_human(strtotime("this week"), TRUE,'eu');
                  $to   = unix_to_human(strtotime("next week"), TRUE,'eu');
                  $this->db->where('loans_payments_schedule.created_at BETWEEN "'.$from.'" AND "'.$to.'"');
                  break;

                case 'year':
                  $this->db->where('YEAR(loans_payments_schedule.created_at) = YEAR(now())');
                  break;

                case 'month':
                  $this->db->where('MONTH(loans_payments_schedule.created_at) = MONTH(now())');
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


                  $this->db->where('loans_payments_schedule.created_at BETWEEN "'.$from.'" AND "'.$to.'"');

                  break;
              }

            }

        return $this->db->count_all_results("loans_payments_schedule");
    } 


}