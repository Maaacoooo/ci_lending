<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()	{
		parent::__construct();		
       $this->load->model('user_model');
       $this->load->model('expenses_model');
       $this->load->model('loans_model');
       $this->load->model('payments_model');
	}	


	public function index()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['title'] = 'Dashboard';
			$data['site_title'] = APP_NAME;
			$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record

			$data['passwordverify'] = $this->user_model->check_user($userdata['username'], APP_DEFAULT_PASS); //boolean - returns false if default password

		    $data["pendings"] 	= $this->loans_model->fetch_loans(NULL, NULL, NULL, "0", NULL);
		    $data["active"] 	= $this->loans_model->fetch_loans(NULL, NULL, NULL, 1, NULL);
		    $data["overdue"] 	= $this->loans_model->fetch_loans(NULL, NULL, NULL, "overdue", NULL);

			if ($data['user']['user_level'] >= 10) {
				//Administrator Account
				$data['logs']		= $this->logs_model->fetch_logs(NULL, NULL, 15);
				$data['payments']	= $this->payments_model->fetch_payments(11, NULL, NULL, NULL, 'now');
				$data['expenses']	= $this->expenses_model->fetch_expenses(11, NULL, NULL, 'now');

				$this->load->view('dashboard/admin_dashboard', $data);		

			} elseif ($data['user']['user_level'] >= 8) {
				//Teller Account
				$this->load->view('dashboard/teller_dashboard', $data);		

			} elseif($data['user']['user_level'] >= 6) {
				//Collector Account 
				$this->load->view('dashboard/collector_dashboard', $data);				

			}
			

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}


	/**
	 * -------------------------------------------------------------------------------------------------------
	 * Login Functionality
	 */

	public function login()		{

		$data['title'] = 'Login';
		$data['site_title'] = APP_NAME;	


		if($this->session->userdata('admin_logged_in'))	{
		        redirect('dashboard', 'refresh');
		} else {
			
			//FORM VALIDATION
			$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_check_user');   
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			 
			   if($this->form_validation->run() == FALSE)	{

					$this->load->view('user/admin_login', $data);

				} else {
					//Sets user data
					$username = $this->input->post('username');
					$this->session->set_userdata('admin_logged_in', array('username' => $username)); //set userdata
					//Set logs
					$log[] = array(
							'user' 		=> 	$username,
							'tag' 		=> 	' ',
							'tag_id'	=> 	' ',
							'action' 	=> 	'User Logged In'
						);

					//sets a notification //////////////////////////////
					$notification['success'] = "Welcome back $username!";
					$this->sessnotif->setNotif($notification);
						
					//Save Logs/////////////////////////
					$this->logs_model->save_logs($log);		

					redirect('dashboard', 'refresh');
			}
				
		}	
	}

	public function check_user($username) {

		$result = $this->user_model->check_user($username, $this->input->post('password'));

		if($result) {	
			return TRUE;
		} else {
			$this->form_validation->set_message('check_user', 'Username or Password does not match!');
			return FALSE;
		}
	}

	/**
	 * ---------------------------------------------------------------------------------------------------------
	 */



	public function logout() {
		//sets a notification //////////////////////////////
		$notification['success'] = "You have successfully logged out!";
		$this->sessnotif->setNotif($notification);

		$this->session->unset_userdata('admin_logged_in');		  
		redirect('dashboard/login', 'refresh');
	}


	public function check_collector() {

	    $userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata
		$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record

		if($data['user']['user_level'] == 6) {	
			return TRUE;
		} else {
			$this->form_validation->set_message('check_collector', 'Your Account is not a Collector Account');
			return FALSE;
		}
	}


	public function change_pin()    {

	    $userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

	    if($userdata) {     
	      //FORM VALIDATION
	      $this->form_validation->set_rules('pin', 'PIN', 'trim|required|callback_check_collector|is_unique[users.pin]');    
	     
	       if($this->form_validation->run() == FALSE) {

	        //convert validation errors to flashdata notification
	          $notif['warning'] = array_values($this->form_validation->error_array());
	          $this->sessnotif->setNotif($notif);
	          
	        redirect($_SERVER['HTTP_REFERER'], 'refresh');

	      } else {

	      	$pin = strip_tags($this->input->post('pin'));

	        if($this->user_model->update_pin($userdata['username'], $pin)) {


	          $log[] = array(
	              'user'    =>  $userdata['username'],
	              'tag'     =>  '',
	              'tag_id'  =>  '',
	              'action'  =>  'Updated Access Pin'
	              );

	        
	          //Save Logs/////////////////////////
	          $this->logs_model->save_logs($log);   
	          ////////////////////////////////////
	          	
	          $this->session->set_flashdata('success', 'Access Pin Updated!');
	          redirect($_SERVER['HTTP_REFERER'], 'refresh');
	        } else {
	          $this->session->set_flashdata('error', 'Error Occured!');
	          redirect($_SERVER['HTTP_REFERER'], 'refresh');
	        }
	      }

	    } else {

	      $this->session->set_flashdata('error', 'You need to login!');
	      redirect('dashboard/login', 'refresh');
	    }

  }



  function test() {
  	$this->load->library('smsgateway');

  	$deviceID = 78962;
	$number = '+639058208455';
	$message = 'Paulixxx';

	//Please note options is no required and can be left out
		var_dump($this->smsgateway->sendMessageToNumber($number, $message, $deviceID));
	}


}
