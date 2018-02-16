<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Loans extends CI_Controller {

	public function __construct()	{
		parent::__construct();		
       $this->load->model('user_model');
       $this->load->model('borrower_model');
       $this->load->model('loans_model');
       $this->load->model('payments_model');

       $this->load->library('zip');
	}	



	public function index()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['title'] 		= 'Overall Loan Applications';
			$data['site_title'] = APP_NAME;
			$data['user'] 		= $this->user_model->userdetails($userdata['username']); //fetches users record

			//Search 
			$data['search'] = $this->input->get('search', TRUE);

			//Paginated data				            
	   		$config['num_links'] = 5;
			$config['base_url'] = base_url('/loans/index/');
			$config["total_rows"] = $this->loans_model->count_loans($data['search'], NULL, NULL);
			$config['per_page'] = 50;				
			$this->load->config('pagination'); //LOAD PAGINATION CONFIG

			$this->pagination->initialize($config);
		    if($this->uri->segment(3)){
		       $page = ($this->uri->segment(3)) ;
		  	}	else 	{
		       $page = 1;		               
		    }

		    $data["results"] = $this->loans_model->fetch_loans($config["per_page"], $page, $data['search'], NULL, NULL);
		    $str_links = $this->pagination->create_links();
		    $data["links"] = explode('&nbsp;',$str_links );

		    //ITEM NUMBERING
		    $data['per_page'] = $config['per_page'];
		    $data['page'] = $page;

		    //GET TOTAL RESULT
		    $data['total_result'] = $config["total_rows"];
		    //END PAGINATION		
		    
			if($data['user']['user_level'] > 6) {
				$this->load->view('loans/list', $data);
			} else {
				show_error('Oops! Your account does not have the privilege to view the content. Please Contact the Administrator', 403, 'Access Denied!');
			}
		    
		
			
		
		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}


	public function pending()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['title'] 		= 'Pending Applications';
			$data['site_title'] = APP_NAME;
			$data['user'] 		= $this->user_model->userdetails($userdata['username']); //fetches users record

			//Search 
			$data['search'] = $this->input->get('search', TRUE);

			//Paginated data				            
	   		$config['num_links'] = 5;
			$config['base_url'] = base_url('/loans/pending/');
			$config["total_rows"] = $this->loans_model->count_loans($data['search'], "0", NULL);
			$config['per_page'] = 50;				
			$this->load->config('pagination'); //LOAD PAGINATION CONFIG

			$this->pagination->initialize($config);
		    if($this->uri->segment(3)){
		       $page = ($this->uri->segment(3)) ;
		  	}	else 	{
		       $page = 1;		               
		    }

		    $data["results"] = $this->loans_model->fetch_loans($config["per_page"], $page, $data['search'], "0", NULL);
		    $str_links = $this->pagination->create_links();
		    $data["links"] = explode('&nbsp;',$str_links );

		    //ITEM NUMBERING
		    $data['per_page'] = $config['per_page'];
		    $data['page'] = $page;

		    //GET TOTAL RESULT
		    $data['total_result'] = $config["total_rows"];
		    //END PAGINATION		
		    
			if($data['user']['user_level'] > 6) {
				$this->load->view('loans/list', $data);
			} else {
				show_error('Oops! Your account does not have the privilege to view the content. Please Contact the Administrator', 403, 'Access Denied!');
			}
		    
		
			
		
		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}


	public function overdue()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['title'] 		= 'Pending Applications';
			$data['site_title'] = APP_NAME;
			$data['user'] 		= $this->user_model->userdetails($userdata['username']); //fetches users record

			//Search 
			$data['search'] = $this->input->get('search', TRUE);

			//Paginated data				            
	   		$config['num_links'] = 5;
			$config['base_url'] = base_url('/loans/overdue/');
			$config["total_rows"] = $this->loans_model->count_loans($data['search'], "overdue", NULL);
			$config['per_page'] = 50;				
			$this->load->config('pagination'); //LOAD PAGINATION CONFIG

			$this->pagination->initialize($config);
		    if($this->uri->segment(3)){
		       $page = ($this->uri->segment(3)) ;
		  	}	else 	{
		       $page = 1;		               
		    }

		    $data["results"] = $this->loans_model->fetch_loans($config["per_page"], $page, $data['search'], "overdue", NULL);
		    $str_links = $this->pagination->create_links();
		    $data["links"] = explode('&nbsp;',$str_links );

		    //ITEM NUMBERING
		    $data['per_page'] = $config['per_page'];
		    $data['page'] = $page;

		    //GET TOTAL RESULT
		    $data['total_result'] = $config["total_rows"];
		    //END PAGINATION		
		    
			if($data['user']['user_level'] > 6) {
				$this->load->view('loans/list', $data);
			} else {
				show_error('Oops! Your account does not have the privilege to view the content. Please Contact the Administrator', 403, 'Access Denied!');
			}
		    
		
			
		
		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}


	public function declined()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['title'] 		= 'Declined Applications';
			$data['site_title'] = APP_NAME;
			$data['user'] 		= $this->user_model->userdetails($userdata['username']); //fetches users record

			//Search 
			$data['search'] = $this->input->get('search', TRUE);

			//Paginated data				            
	   		$config['num_links'] = 5;
			$config['base_url'] = base_url('/loans/pending/');
			$config["total_rows"] = $this->loans_model->count_loans($data['search'], 2, NULL);
			$config['per_page'] = 50;				
			$this->load->config('pagination'); //LOAD PAGINATION CONFIG

			$this->pagination->initialize($config);
		    if($this->uri->segment(3)){
		       $page = ($this->uri->segment(3)) ;
		  	}	else 	{
		       $page = 1;		               
		    }

		    $data["results"] = $this->loans_model->fetch_loans($config["per_page"], $page, $data['search'], 2, NULL);
		    $str_links = $this->pagination->create_links();
		    $data["links"] = explode('&nbsp;',$str_links );

		    //ITEM NUMBERING
		    $data['per_page'] = $config['per_page'];
		    $data['page'] = $page;

		    //GET TOTAL RESULT
		    $data['total_result'] = $config["total_rows"];
		    //END PAGINATION		
		    
			if($data['user']['user_level'] > 6) {
				$this->load->view('loans/list', $data);
			} else {
				show_error('Oops! Your account does not have the privilege to view the content. Please Contact the Administrator', 403, 'Access Denied!');
			}
		    
		
			
		
		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}


	public function create()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{
			
			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required|callback_check_loans');   
			$this->form_validation->set_rules('loan_amount', 'Loan Amount', 'trim|required|decimal[2]');   
			$this->form_validation->set_rules('loan_days', 'Days of Loan', 'trim|required');   
			$this->form_validation->set_rules('loan_rate', 'Loan Percentage', 'trim|required');   
		 
		   if($this->form_validation->run() == FALSE)	{

				//convert validation errors to flashdata notification
		   		$notif['warning'] = array_values($this->form_validation->error_array());
		   		$this->sessnotif->setNotif($notif);
		   		
				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

				$acc_id = $this->encryption->decrypt($this->input->post('id')); //ID of the Borrower	

				//GET Due Date with Moment //////////////////////////////////////////
				include APPPATH.'libraries/Moment/Moment.php';
				include APPPATH.'libraries/Moment/MomentLocale.php';
				include APPPATH.'libraries/Moment/MomentPeriodVo.php';
				include APPPATH.'libraries/Moment/MomentHelper.php';
				include APPPATH.'libraries/Moment/MomentFromVo.php';

				$loan_days = strip_tags($this->input->post('loan_days')); //number of days input

				$moment = new \Moment\Moment();
				$due_date = date('Y-m-d',strtotime($loan_days." days"));


				$loan_id = $this->loans_model->create($acc_id, $due_date); //Loan ID


				if($loan_id) {

					//Save Expenses 
					foreach ($this->input->post('expense') as $key => $value) {
						$this->loans_model->add_expense($loan_id, $key, $value);
					}

					//Save Income 
					foreach ($this->input->post('income') as $key => $value) {
						$this->loans_model->add_income($loan_id, $key, $value);
					}

					//Save Creditors
					foreach ($this->input->post('creditors_name') as $key => $value) {

						$cred['name'] = $value;
						$cred['addr'] = $this->input->post('creditors_address')[$key];
						$cred['amount'] = $this->input->post('creditors_amount')[$key];
						$cred['remarks'] = $this->input->post('creditors_remarks')[$key];

						$this->loans_model->add_creditors($loan_id, $cred['name'], $cred['addr'], $cred['amount'], $cred['remarks']);
					}

					// Logs ////////////////////////////////////////
					$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'loan',
							'tag_id'	=> 	$loan_id,
							'action' 	=> 	'Loan Application - Pending'
					);

					$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'borrower',
							'tag_id'	=> 	$acc_id,
							'action' 	=> 	'Loan Application - ID:' . $loan_id . ' - Pending'
					);

				
					//Save Logs/////////////////////////
					$this->logs_model->save_logs($log);		
					////////////////////////////////////

					$this->session->set_flashdata('success', 'Loan Application Submitted! Pending for Approval');
					redirect('loans/view/'.$loan_id, 'refresh');
				}
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}


	function check_loans($id) {

		$id 	= $this->encryption->decrypt($id);
		$rows 	= $this->loans_model->count_loans(NULL, 1, $id);

		//Check if there is an existing loan
		if($rows >= 1) {
			if (isset($_POST)) {
				$this->form_validation->set_message('check_loans', 'An Open Loan record has been found.');				
			}
			return FALSE;
		} else {
			return TRUE;
		}
	}


	public function view($id)		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['site_title'] = APP_NAME;
			$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record

			//Fetch Data	
			$data['loan']	= $this->loans_model->view($id);
			$data['pay_id'] = $this->session->flashdata('pay_id');

			//Validate if record exist
			 //IF NO ID OR NO RESULT, REDIRECT
			if(!$data['loan']) {

					$notif['error'] = 'No Record Found!';
		   			$this->sessnotif->setNotif($notif);

					redirect('loans', 'refresh');
			}	

			$data['info']					= $this->borrower_model->view($data['loan']['borrower_id']);
			$data['info']['current_addr']	= $this->borrower_model->fetch_addresses($data['loan']['borrower_id'], 2)[0]['address'];

			$data['addresses']		= $this->borrower_model->fetch_addresses($data['loan']['borrower_id']);
			$data['mobiles']		= $this->borrower_model->fetch_contacts($data['loan']['borrower_id'], 0);
			$data['emails']			= $this->borrower_model->fetch_contacts($data['loan']['borrower_id'], 1);
			$data['employments']	= $this->borrower_model->fetch_works($data['loan']['borrower_id'], 0);
			$data['businesses']		= $this->borrower_model->fetch_works($data['loan']['borrower_id'], NULL);

			$data['expenses']	= $this->loans_model->fetch_expenses($id);
			$data['income']		= $this->loans_model->fetch_income($id);
			$data['creditors']	= $this->loans_model->fetch_creditors($id);

			$data['ledger']			= $this->loans_model->fetch_ledger($id);
			$data['ledger_debit']	= $this->loans_model->fetch_ledger_codes('debit');
			$data['ledger_credit']	= $this->loans_model->fetch_ledger_codes('credit');

			$data['title'] 		= 'Loan Application: ' . $data['loan']['id'];


			$data['logs']		= $this->logs_model->fetch_logs('loan', $data['loan']['id'], 50);

			$data['notes']		= $this->notes_model->fetch_notes(NULL, NULL, 'loan', $data['loan']['id']);
			$data['files']		= $this->files_model->fetch_files(NULL, NULL, 'loan', $data['loan']['id']);
			$data['payments']	= $this->payments_model->fetch_payments(NULL, NULL, $data['loan']['id']);
			
			if($data['user']['user_level'] > 6) {
				if ($this->uri->segment(4)=='print') {
					$this->load->view('loans/print', $data);	
				} else {
					$this->load->view('loans/view', $data);	
				}
			} else {
				show_error('Oops! Your account does not have the privilege to view the content. Please Contact the Administrator', 403, 'Access Denied!');
			}			

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}


	/**
	 * ------------------------------------------------------------------------------------------------
	 * Helpers
	 * ------------------------------------------------------------------------------------------------
	 */


	public function add_ledger()    {

	    $userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

	    if($userdata) {     
	      //FORM VALIDATION
	      $this->form_validation->set_rules('id', 'ID', 'trim|required');   
	      $this->form_validation->set_rules('key', 'Key', 'trim|required');   
	      $this->form_validation->set_rules('code', 'Code', 'trim|required');   
	      $this->form_validation->set_rules('amount', 'Amount', 'trim|required');   
	      $this->form_validation->set_rules('description', 'Description', 'trim|required');   
	     
	       if($this->form_validation->run() == FALSE) {

	        //convert validation errors to flashdata notification
	          $notif['warning'] = array_values($this->form_validation->error_array());
	          $this->sessnotif->setNotif($notif);
	          
	        redirect($_SERVER['HTTP_REFERER'], 'refresh');

	      } else {

	        $id = $this->encryption->decrypt($this->input->post('id')); //ID of the loan 
	        $key = $this->encryption->decrypt($this->input->post('key')); //ID of the key 

	       	$amount = abs(strip_tags($this->input->post('amount')));
	       	$description = strip_tags($this->input->post('description'));
	       	$code = strip_tags($this->input->post('code'));

	        switch ($key) {
	          case 'credit':
	            $flag = $this->loans_model->add_ledger($id, $amount, $userdata['username'], $description, $code);
	            $log_action = 'Added a Credit Record';
	            break;

	          case 'debit':
	            # code...
	            $flag = $this->loans_model->add_ledger($id, (($amount)*-1), $userdata['username'], $description, $code);
	            $log_action = 'Added a Debit Record';
	            break;	
	        }


	        if($flag) {

	          $log[] = array(
	              'user'    =>  $userdata['username'],
	              'tag'     =>  'loan',
	              'tag_id'  =>  $id,
	              'action'  =>  $log_action
	              );

	        
	          //Save Logs/////////////////////////
	          $this->logs_model->save_logs($log);   
	          ////////////////////////////////////
	          $this->session->set_flashdata('success', $log_action);
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


  public function loan_status()    {

	    $userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

	    if($userdata) {     
	      //FORM VALIDATION
	      $this->form_validation->set_rules('id', 'ID', 'trim|required');      
	      $this->form_validation->set_rules('key', 'Key', 'trim|required');      
	     
	       if($this->form_validation->run() == FALSE) {

	        //convert validation errors to flashdata notification
	          $notif['warning'] = array_values($this->form_validation->error_array());
	          $this->sessnotif->setNotif($notif);
	          
	        redirect($_SERVER['HTTP_REFERER'], 'refresh');

	      } else {

	        $id  = $this->encryption->decrypt($this->input->post('id')); //ID of the loan 
	        $key = $this->encryption->decrypt($this->input->post('key')); 

	       	switch ($key) {
	       		case 'approve':
	       			$flag = $this->loans_model->update_status($id, 1);
	       			//update approve date
	       			$this->loans_model->update_approve($id);
	       			//logs
	       			$log_action = 'Approved Loan Request';
	       			//add note
	        		$description = strip_tags($this->input->post('description'));
	       			$description = $userdata['username'] . ': Approved this Loan Request. <br/> Remarks: ' . $description;
	       			$this->notes_model->create('loan', $id, NULL, $description);

	       			$info = $this->loans_model->view($id);
	       			 //Send SMS Notification  /////////////////////
		             $message = "Hi ".$info['name']."! Your Loan Application ".$info['id']." has been approved! Thank you for patronizing ".COMPANY_NAME;

		             $number = $this->loans_model->fetch_contacts($info['borrower_id']);
		             $data['sms'] = $this->smsgateway->sendMessageToNumber($number, $message, SMS_DEVICE); //Send SMS

	       			break;

	       		case 'disapprove':
	       			//update status
	       			$flag = $this->loans_model->update_status($id, 2);
	       			$log_action = 'Disapproved Loan Request';
	       			//add note
	        		$description = strip_tags($this->input->post('description'));
	       			$description = $userdata['username'] . ': Disapproved this Loan Request. <br/> Remarks: ' . $description;
	       			$this->notes_model->create('loan', $id, NULL, $description);
	       			break;

	       		case 'close':
	       			# code...
	       			break;

	       		case 'cancel':
	       			# code...
	       			break;
	       		
	       	}
	        

	        if($flag) {

	          $log[] = array(
	              'user'    =>  $userdata['username'],
	              'tag'     =>  'loan',
	              'tag_id'  =>  $id,
	              'action'  =>  $log_action
	              );

	        
	          //Save Logs/////////////////////////
	          $this->logs_model->save_logs($log);   
	          ////////////////////////////////////
	          $this->session->set_flashdata('success', $log_action);
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


  public function disburse()    {

	    $userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

	    if($userdata) {     
	      //FORM VALIDATION
	      $this->form_validation->set_rules('id', 'ID', 'trim|required');     
	     
	       if($this->form_validation->run() == FALSE) {

	        //convert validation errors to flashdata notification
	          $notif['warning'] = array_values($this->form_validation->error_array());
	          $this->sessnotif->setNotif($notif);
	          
	        redirect($_SERVER['HTTP_REFERER'], 'refresh');

	      } else {

	        $id = $this->encryption->decrypt($this->input->post('id')); //ID of the loan 
	        $info = $this->loans_model->view($id);

	        $charge = ($info['borrowed_amount']*0.05); //the constant 5% charge
	        $interest = ((($info['borrowed_amount'])*($info['borrowed_percentage']*0.01))*-1); //get rate of interest

	        $action1 = $this->loans_model->add_ledger($id, (($info['borrowed_amount'])*-1), $userdata['username'], 'Actual Disbursed: '.moneytize($info['borrowed_amount']-$charge), 'DISB');
	        $action2 = $this->loans_model->add_ledger($id, $interest, $userdata['username'], 'Applied Standard Interests basing from '.$info['borrowed_percentage'].'% of '.moneytize($info['borrowed_amount']), 'INTR');
	        $action3 = $this->loans_model->add_ledger($id, (($charge)*-1), $userdata['username'], 'Standard Service Charge', 'SCHR');
	        $action4 = $this->loans_model->add_ledger($id, $charge, $userdata['username'], 'Service Charge Paid', 'SCHR');

	        if($action1 && $action2 && $action3 && $action4) {

	          $log[] = array(
	              'user'    =>  $userdata['username'],
	              'tag'     =>  'loan',
	              'tag_id'  =>  $id,
	              'action'  =>  'Processed Disbursement'
	              );

	        
	          //Save Logs/////////////////////////
	          $this->logs_model->save_logs($log);   
	          ////////////////////////////////////


	         //Send SMS Notification  /////////////////////
             $message = "Hi ".$info['name']."! This is to inform that you have received a disbursement amounting ".moneytize($info['borrowed_amount']-$charge)."
              ".COMPANY_NAME;

             $number = $this->loans_model->fetch_contacts($info['borrower_id']);
             $data['sms'] = $this->smsgateway->sendMessageToNumber($number, $message, SMS_DEVICE); //Send SMS
	          
	          $this->session->set_flashdata('success', 'Added a Disbursement Record!');
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



  /**
   * This downloads all the files in the File Archive
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function download($id)    {

	    $userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata
	    $data['user'] = $this->user_model->userdetails($userdata['username']);
	    if($userdata) {     


	    	if($data['user']['user_level'] > 6) {
				$info = $this->loans_model->view($id);

		     	$path = './uploads/borrowers/';
		     	$path .= $info['borrower_id'];
		     	$path .= '/loans/';
		     	$path .= $info['id'];

				$this->zip->read_dir($path, FALSE);

				// Download the file to your desktop. Name it "my_backup.zip"
				$this->zip->download($info['id'].'_FILES.zip');

			} else {
				show_error('Oops! Your account does not have the privilege to view the content. Please Contact the Administrator', 403, 'Access Denied!');
			}
	     	
	     	

	    } else {

	      $this->session->set_flashdata('error', 'You need to login!');
	      redirect('dashboard/login', 'refresh');
	    }

  }

}
