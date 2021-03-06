<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  /**
   * Intended for Android Authentication
   */

	public function __construct()	{
		parent::__construct();		
       $this->load->model('user_model');
       $this->load->model('settings_model');
       $this->load->model('loans_model');
       $this->load->model('payments_model');
       $this->load->model('borrower_model');
	}



   function authUser($api_key = null) {

      $data = NULL;

      //change of request
      if(isset($_GET['api_key'])) {
        $api_key = $_GET['api_key'];
      }

      //fetch API KEY AUTH data
      $api = $this->settings_model->setting('API_KEY_AUTH');

      if($api_key == $api['value']) {

        $pin = $this->input->post('userqr');

        if ($pin) {
          $user_info = $this->user_model->pin_login($pin);

          if ($user_info) {
            $data["error"] = FALSE;
            $data["uid"] = $user_info["username"];
            $data["user"]["name"] = $user_info["firstname"] . ' ' . $user_info["lastname"];
            $data["user"]["email"] = $user_info["email"];
            $data["user"]["created_at"] = $user_info["created_at"];
            $data["user"]["updated_at"] = $user_info["updated_at"];
          } else {
            $data['error'] = TRUE;
            $data['error_msg'] = 'Login Failed. No User Found!';
          }
        } else {
          $user = $this->input->post('email');
          $pass = $this->input->post('password');

          $user_info = $this->user_model->check_user($user, $pass);

          if ($user_info) {
            $data["error"] = FALSE;
            $data["uid"] = $user_info["username"];
            $data["user"]["name"] = $user_info["firstname"] . ' ' . $user_info["lastname"];
            $data["user"]["email"] = $user_info["email"];
            $data["user"]["created_at"] = $user_info["created_at"];
            $data["user"]["updated_at"] = $user_info["updated_at"];
          } else {
            $data['error'] = TRUE;
            $data['error_msg'] = 'Login Failed. No User Found in the System!';
          }
        }


      } else {
        show_error('Please contact the System Administrator!',403,'Access Denied!');
      }


      echo json_encode($data);

  }


  function submitPayment($api_key = null) {

      //change of request
      if(isset($_GET['api_key'])) {
        $api_key = $_GET['api_key'];
      }

      //fetch API KEY AUTH data
      $api = $this->settings_model->setting('API_KEY_AUTH');

      if($api_key == $api['value']) {
      

         $borrower_id = $this->input->post('clientid');
         $payee = $this->input->post('clientname');
         $amount = $this->input->post('pamount');
         $description = $this->input->post('description');
         $paymentdate = $this->input->post('pdate');

         $loan = $this->borrower_model->view($borrower_id);
         $user = $this->payments_model->check_pin_user($this->input->post('uid'));

         $description = $description . " Payment Submitted from RedWoods App -" . $paymentdate;

         $payment_id = $this->payments_model->create($loan['loan_id'], $amount, $payee, $description, '', $user['username']);

         if($payment_id) {

            $this->loans_model->add_ledger($loan['loan_id'], $amount, $user['username'], 'Payment #'.$payment_id.' via App Pay', 'APAY');

             $data['error'] = false; 
             $data['message'] = 'Payment saved successfully'; 

         } else {
              $data['error'] = true; 
              $data['message'] = 'Please try later';
         }

      } else {
        show_error('Please contact the System Administrator!',403,'Access Denied!');
      }


      echo json_encode($data, JSON_PRETTY_PRINT);

  }


  function getAllBorrowers($api_key = null) {

      $data = NULL;

      //change of request
      if(isset($_GET['api_key'])) {
        $api_key = $_GET['api_key'];
      }

      //fetch API KEY AUTH data
      $api = $this->settings_model->setting('API_KEY_AUTH');

      if($api_key == $api['value']) {

        
        $borrowers = $this->borrower_model->fetch_borrowers(NULL, NULL, NULL, 0);
        if ($borrowers) {
          foreach ($borrowers as $bor) {
            $temp['client_name'] = $bor['name'];
            $temp['client_id'] = $bor['id'];
            $data[] = $temp;
          }
        }


      } else {
        show_error('Please contact the System Administrator!',403,'Access Denied!');
      }


      echo json_encode($data, JSON_PRETTY_PRINT);

  }



}
