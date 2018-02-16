<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

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

        $user = $this->input->post('username');
        $pass = $this->input->post('password');

        $user_info = $this->user_model->check_user($user, $pass);

        if ($user_info) {
          $data["error"] = FALSE;
          $data["uid"] = $user_info["pin"];
          $data["user"]["name"] = $user_info["name"];
          $data["user"]["email"] = $user_info["email"];
          $data["user"]["created_at"] = $user_info["created_at"];
          $data["user"]["updated_at"] = $user_info["updated_at"];
        }


      } else {
        show_error('Please contact the System Administrator!',403,'Access Denied!');
      }


      echo json_encode($data, JSON_PRETTY_PRINT);

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

            $data['response'] = TRUE;
            $this->loans_model->add_ledger($loan['loan_id'], $amount, $user['username'], 'Payment #'.$payment_id.' via App Pay', 'APAY');

         }

      } else {
        show_error('Please contact the System Administrator!',403,'Access Denied!');
      }


      echo json_encode($data, JSON_PRETTY_PRINT);

  }




}
