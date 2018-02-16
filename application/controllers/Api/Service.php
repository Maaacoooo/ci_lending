<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This Controller is tasked to accept cron jobs
 */
class Service extends CI_Controller {

	public function __construct()	{
		parent::__construct();		
       $this->load->model('user_model');
       $this->load->model('settings_model');
       $this->load->model('loans_model');
	}


  /**
   * Automatic Add on Ledger - FEES AND PENALTY
   */
  function GenerateFees($api_key = NULL) {


      $data = NULL;

      //change of request
      if(isset($_GET['api_key'])) {
        $api_key = $_GET['api_key'];
      }

      //fetch API KEY AUTH data
      $api = $this->settings_model->setting('API_KEY_AUTH');

      if($api_key == $api['value']) {

          $date = date('d');

          $from = unix_to_human(strtotime('15 days ago'), 'eu', TRUE);
          $to = unix_to_human(strtotime('now'), 'eu', TRUE);

          $data = $this->loans_model->fetch_active_loans($from, $to);
        
          if ($date == 4 || $date == 19) {
            foreach ($data as $d) {
                echo $d['name'];
                //Add Penalty to Ledger
                  $this->loans_model->add_ledger($d['loan_id'], (((($d['borrowed_amount'])*0.05))*-1), NULL, 'Automatic Fees Applied by the System', 'PNTY');
                

                //Save Logs  ///////////////////////////          
                  $log[] = array(
                      'user'    =>  NULL,
                      'tag'     =>  'loan',
                      'tag_id'  =>  $d['loan_id'],
                      'action'  =>  'Penalty Applied'
                      );         

                  $this->logs_model->save_logs($log);   

                //Send SMS Notification  /////////////////////
                $message = "Hi ".$d['name']."! You failed to pay the scheduled payment. As a result of that, an automatic penalty of 5%(".moneytize(($d['borrowed_amount'])*0.05).") has been applied.
          ".COMPANY_NAME;

                $number = $d['contacts'];

                  $this->smsgateway->sendMessageToNumber($number, $message, SMS_DEVICE); //Send SMS
              }

          }

      } else {
        show_error('Please contact the System Administrator!',403,'Access Denied!');
      }


      echo json_encode($data, JSON_PRETTY_PRINT); 


  }

  /**
   * Do An SMS Command
   * @param [type] $request [description]
   */
  function DoSMSReminder($request = NULL, $api_key) {
    switch ($request) {
      case 'payment':
        
         $data = NULL;

          //change of request
          if(isset($_GET['api_key'])) {
            $api_key = $_GET['api_key'];
          }

          //fetch API KEY AUTH data
          $api = $this->settings_model->setting('API_KEY_AUTH');

          if($api_key == $api['value']) {

              $date = date('d');

              $from = unix_to_human(strtotime('15 days ago'), 'eu', TRUE);
              $to = unix_to_human(strtotime('now'), 'eu', TRUE);

              $data = $this->loans_model->fetch_active_loans($from, $to);
              
              //$date == 12 || $date == 28
              if (TRUE) {
                foreach ($data as $d) {
                    echo $d['name'];
                  

                    //Save Logs  ///////////////////////////          
                      $log[] = array(
                          'user'    =>  NULL,
                          'tag'     =>  'loan',
                          'tag_id'  =>  $d['loan_id'],
                          'action'  =>  'Sent SMS Notification'
                          );         

                      $this->logs_model->save_logs($log);   

                    //Send SMS Notification  /////////////////////
                    $message = "Hi ".$d['name']."! How is your day? We would like to remind you for the payment of your loan application. Payments are only accepted in our office, and our accredited collectors. Have a nive day!  
              ".COMPANY_NAME;

                    $number = $d['contacts'];

                      $data['sms'] = $this->smsgateway->sendMessageToNumber($number, $message, SMS_DEVICE); //Send SMS
                  }

              }

          } else {
            show_error('Please contact the System Administrator!',403,'Access Denied!');
          }


          echo json_encode($data, JSON_PRETTY_PRINT); 

        break;      
      default:
        # code...
        break;
    }
  }


}
