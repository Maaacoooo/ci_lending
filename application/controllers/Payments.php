<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {

	public function __construct()	{
		parent::__construct();		
       $this->load->model('user_model');
       $this->load->model('payments_model');
       $this->load->model('loans_model');
	}	


	public function index($page = NULL)		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['site_title'] = APP_NAME;
			$data['user'] 		= $this->user_model->userdetails($userdata['username']); //fetches users record

			//Search 
			$data['search'] = $this->input->get('search', TRUE);

			switch ($page) {
				case 'weekly':
					$data['title'] 	= 'Week\'s Payments';
					$date = 'week';
					break;

				case 'monthly':
					$data['title'] 	= 'Payments of ' . date('F Y', now());
					$date = 'month';
					break;

				case 'annual':
					$data['title'] 	= 'Payments of ' . date('Y', now());
					$date = 'year';
					break;
				
				default:
					$data['title'] 	= 'Overall Payments';
					$page = 'all';
					$date = $this->input->get('date', TRUE);
					break;
			}


			//Paginated data				            
	   		$config['num_links'] = 5;
			$config['base_url'] = base_url('/payments/index/'.$page);
			$config["total_rows"] = $this->payments_model->count_payments(NULL, $data['search'], $date);
			$config['per_page'] = 20;				
			$this->load->config('pagination'); //LOAD PAGINATION CONFIG

			$this->pagination->initialize($config);
		    if($this->uri->segment(4)){
		       $page = ($this->uri->segment(4)) ;
		  	}	else 	{
		       $page = 1;		               
		    }

		    $data["results"] = $this->payments_model->fetch_payments($config["per_page"], $page, NULL, $data['search'], $date);
		    $str_links = $this->pagination->create_links();
		    $data["links"] = explode('&nbsp;',$str_links );

		    //ITEM NUMBERING
		    $data['per_page'] = $config['per_page'];
		    $data['page'] = $page;

		    //GET TOTAL RESULT
		    $data['total_result'] = $config["total_rows"];
		    //END PAGINATION		
		    
			if ($this->input->get('action') == 'print') {
				//Override Results
				switch ($page) {
				case 'weekly':
		    		$data["results"] = $this->payments_model->fetch_payments(NULL, NULL, NULL, NULL, $date);		
					break;

				case 'monthly':
		    		$data["results"] = $this->payments_model->fetch_payments(NULL, NULL, NULL, NULL, $date);				
					break;

				case 'annual':
		    		$data["results"] = $this->payments_model->fetch_payments(NULL, NULL, NULL, NULL, $date);					
					break;
				
				default:
					if ($this->input->get('date')) {
						$date = $this->input->get('date', TRUE);
						$data['title'] = 'Payments of '. $date;
		    			$data["results"] = $this->payments_model->fetch_payments(NULL, NULL, NULL, NULL, $date);			
					} else {
		    			$data["results"] = $this->payments_model->fetch_payments(NULL, NULL, NULL, NULL, $date);					
					}
					break;
				}
				$this->load->view('payments/print', $data);
			} else {
				$this->load->view('payments/list', $data);
			}
		    
		
			
		
		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}

	public function create()    {

	    $userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

	    if($userdata) {     
	      //FORM VALIDATION
	      $this->form_validation->set_rules('id', 'ID', 'trim|required');        
	      $this->form_validation->set_rules('payee', 'Payee', 'trim|required');        
	      $this->form_validation->set_rules('amount', 'Amount', 'trim|required|greater_than[0]');        
	      $this->form_validation->set_rules('receipt', 'Receipt', 'trim');             
	      $this->form_validation->set_rules('description', 'Description', 'trim');    
	     
	       if($this->form_validation->run() == FALSE) {

	        //convert validation errors to flashdata notification
	          $notif['warning'] = array_values($this->form_validation->error_array());
	          $this->sessnotif->setNotif($notif);
	          
	        redirect($_SERVER['HTTP_REFERER'], 'refresh');

	      } else {

	        $id = $this->encryption->decrypt($this->input->post('id')); //ID of the loan 

	        //hello variables
	        $payee = strip_tags($this->input->post('payee'));
	        $amount = strip_tags($this->input->post('amount'));
	        $receipt = strip_tags($this->input->post('receipt'));
	        $description = strip_tags($this->input->post('description'));

	        $payment_id = $this->payments_model->create($id, $amount, $payee, $description, $receipt, $userdata['username']);

	        
	        if($payment_id) {
			//payment markup
	        $this->session->set_flashdata('pay_id', $payment_id);
	        //Add to Ledger 
	        $this->loans_model->add_ledger($id, $amount, $userdata['username'], 'Payment #'.$payment_id, 'CPAY');

	          $log[] = array(
	              'user'    =>  $userdata['username'],
	              'tag'     =>  'loan',
	              'tag_id'  =>  $id,
	              'action'  =>  'Submitted a Payment'
	              );

	        
	          //Save Logs/////////////////////////
	          $this->logs_model->save_logs($log);   
	          ////////////////////////////////////
	          $this->session->set_flashdata('success', 'Payment Submitted!');
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



  public function update()    {

	    $userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

	    if($userdata) {     
	      //FORM VALIDATION
	      $this->form_validation->set_rules('id', 'ID', 'trim|required|callback_check_user');    
	     
	       if($this->form_validation->run() == FALSE) {

	        //convert validation errors to flashdata notification
	          $notif['warning'] = array_values($this->form_validation->error_array());
	          $this->sessnotif->setNotif($notif);
	          
	        redirect($_SERVER['HTTP_REFERER'], 'refresh');

	      } else {

	        $id = $this->encryption->decrypt($this->input->post('id')); //ID of the loan 

	        $description = strip_tags($this->input->post('description'));
	        $title = strip_tags($this->input->post('title'));

	        if($this->notes_model->update($id, $description, $title)) {
	          $this->session->set_flashdata('success', 'Note Updated!');
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


  public function delete()    {

	    $userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

	    if($userdata) {     
	      //FORM VALIDATION
	      $this->form_validation->set_rules('id', 'ID', 'trim|required|callback_check_user');    
	     
	       if($this->form_validation->run() == FALSE) {

	        //convert validation errors to flashdata notification
	          $notif['warning'] = array_values($this->form_validation->error_array());
	          $this->sessnotif->setNotif($notif);
	          
	        redirect($_SERVER['HTTP_REFERER'], 'refresh');

	      } else {

	        $id = $this->encryption->decrypt($this->input->post('id')); //ID of the loan 

	        if($this->notes_model->delete($id)) {
	          $this->session->set_flashdata('success', 'Note Deleted!');
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


  public function view($id = NULL)		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['site_title'] = APP_NAME;
			$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record

			$data['info']	= $this->payments_model->view($id);	
			$data['title']	= 'Payment Invoice: ' . $data['info']['id'];		

			//Validate if record exist
			 //IF NO ID OR NO RESULT, REDIRECT
			 
			if(!$data['info']) {
				$notif['error'] = 'No Record Found!';
		   		$this->sessnotif->setNotif($notif);

				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}			
			
			if ($this->uri->segment(4)=='print') {
				$this->load->view('payments/print', $data);	
			} else {
				$this->load->view('payments/view', $data);	
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}


}
