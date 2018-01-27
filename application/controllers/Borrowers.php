<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Borrowers extends CI_Controller {

	public function __construct()	{
		parent::__construct();		
		$this->load->model('user_model');
		$this->load->model('borrower_model');
		$this->load->model('loans_model');
	}	


	/**
	 * ---------------------------------------------------------------------------------------------------------
	 * Borrowers
	 * ---------------------------------------------------------------------------------------------------------
	 */

	public function index()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['title'] 		= 'Borrowers Accounts';
			$data['site_title'] = APP_NAME;
			$data['user'] 		= $this->user_model->userdetails($userdata['username']); //fetches users record

			//Search 
			$data['search'] = $this->input->get('search', TRUE);

			//Paginated data				            
	   		$config['num_links'] = 5;
			$config['base_url'] = base_url('/borrowers/index/');
			$config["total_rows"] = $this->borrower_model->count_borrowers($data['search'], 0, NULL);
			$config['per_page'] = 50;				
			$this->load->config('pagination'); //LOAD PAGINATION CONFIG

			$this->pagination->initialize($config);
		    if($this->uri->segment(3)){
		       $page = ($this->uri->segment(3)) ;
		  	}	else 	{
		       $page = 1;		               
		    }

		    $data["results"] = $this->borrower_model->fetch_borrowers($config["per_page"], $page, $data['search'], 0, NULL);
		    $str_links = $this->pagination->create_links();
		    $data["links"] = explode('&nbsp;',$str_links );

		    //ITEM NUMBERING
		    $data['per_page'] = $config['per_page'];
		    $data['page'] = $page;

		    //GET TOTAL RESULT
		    $data['total_result'] = $config["total_rows"];
		    //END PAGINATION		
		    
			$this->load->view('borrower/list', $data);
		    
		
			
		
		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}

	public function create()		{


		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['title'] 		= 'Register New Account';
			$data['site_title'] = APP_NAME;
			$data['user'] 		= $this->user_model->userdetails($userdata['username']); //fetches users record

	
			//Form Validation
			$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
			$this->form_validation->set_rules('mname', 'Middle Name', 'trim|required');
			$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('bdate', 'Birth Date', 'trim|required');
			$this->form_validation->set_rules('sex', 'Sex', 'trim|required');
			$this->form_validation->set_rules('civil_stat', 'Civil Status', 'trim|required');

			//birthplace
			$this->form_validation->set_rules('bplace_bldg', 'Birthplace Bldg', 'trim');
			$this->form_validation->set_rules('bplace_strt', 'Birthplace Street', 'trim');
			$this->form_validation->set_rules('bplace_brgy', 'Birthplace Brgy', 'trim');
			$this->form_validation->set_rules('bplace_city', 'Birthplace City', 'trim|required');
			$this->form_validation->set_rules('bplace_prov', 'Birthplace Province', 'trim|required');
			$this->form_validation->set_rules('bplace_zip', 'Birthplace ZIP Code', 'trim');
			$this->form_validation->set_rules('bplace_ctry', 'Birthplace Country', 'trim|required');

			if ($this->input->post('civil_stat') == 'Married') {
				//Spouse
				$this->form_validation->set_rules('spouse_fname', 'Spouse Firstname', 'trim|required');
				$this->form_validation->set_rules('spouse_mname', 'Spouse Middlename', 'trim|required');
				$this->form_validation->set_rules('spouse_lname', 'Spouse Lastname', 'trim|required');
				$this->form_validation->set_rules('spouse_bdate', 'Spouse Birthdate', 'trim|required');
				$this->form_validation->set_rules('spouse_bplace', 'Spouse Birthplace', 'trim');
				$this->form_validation->set_rules('spouse_contact', 'Spouse Contact', 'trim|required');
				$this->form_validation->set_rules('spouse_occupation', 'Spouse Occupation', 'trim');
				$this->form_validation->set_rules('spouse_occuaddr', 'Spouse Work Address', 'trim');
			}

			// current address
			$this->form_validation->set_rules('addr_bldg', 'Current Address Bldg', 'trim|required');
			$this->form_validation->set_rules('addr_strt', 'Current Address Street', 'trim|required');
			$this->form_validation->set_rules('addr_brgy', 'Current Address Brgy', 'trim|required');
			$this->form_validation->set_rules('addr_city', 'Current Address City', 'trim|required');
			$this->form_validation->set_rules('addr_prov', 'Current Address Province', 'trim|required');
			$this->form_validation->set_rules('addr_zip', 'Current Address ZIP Code', 'trim|required');
			$this->form_validation->set_rules('addr_ctry', 'Current Address Country', 'trim|required');

			//home address
			$this->form_validation->set_rules('home_bldg', 'Home Address Bldg', 'trim|required');
			$this->form_validation->set_rules('home_strt', 'Home Address Street', 'trim');
			$this->form_validation->set_rules('home_brgy', 'Home Address Brgy', 'trim|required');
			$this->form_validation->set_rules('home_city', 'Home Address City', 'trim|required');
			$this->form_validation->set_rules('home_prov', 'Home Address Province', 'trim|required');
			$this->form_validation->set_rules('home_zip', 'Home Address ZIP Code', 'trim|required');
			$this->form_validation->set_rules('home_ctry', 'Home Address Country', 'trim|required');

			//Contacts
			$this->form_validation->set_rules('email[]', 'Email Address', 'trim');
			$this->form_validation->set_rules('contact[]', 'Contact Numbers', 'trim');

			//Educational Attainment
			$this->form_validation->set_rules('educ_level', 'Education Level', 'trim|required');
			$this->form_validation->set_rules('educ_school', 'School Attended', 'trim|required');
			$this->form_validation->set_rules('educ_course', 'Course Taken', 'trim|required');
			$this->form_validation->set_rules('educ_year', 'School Year', 'trim|required');

			//Employment / Employed
			if($this->input->post('employ_grp') || $this->input->post('employ_name')) {
				$this->form_validation->set_rules('employ_grp', 'Employer Group', 'trim|required');
				$this->form_validation->set_rules('employ_name', 'Employer Name', 'trim|required');
				$this->form_validation->set_rules('employ_position', 'Employed Position', 'trim|required');
				$this->form_validation->set_rules('employ_date', 'Employed Date', 'trim|required');
				$this->form_validation->set_rules('employ_addr', 'Employed Word Address', 'trim|required');
				$this->form_validation->set_rules('employ_contact', 'Employed Contact', 'trim|required');
				$this->form_validation->set_rules('employ_status', 'Employment Status', 'trim');
				$this->form_validation->set_rules('employ_remarks', 'Employment Remarks', 'trim');
			}

			//Business / Self-employed
			if ($this->input->post('business_nature') || $this->input->post('business_name')) {
				$this->form_validation->set_rules('business_name', 'Business Name', 'trim|required');
				$this->form_validation->set_rules('business_nature', 'Business Nature', 'trim|required');
				$this->form_validation->set_rules('business_date', 'Business Start Date', 'trim|required');
				$this->form_validation->set_rules('business_addr', 'Business Address', 'trim|required');
				$this->form_validation->set_rules('business_contact', 'Business Contact', 'trim|required');
				$this->form_validation->set_rules('business_status', 'Business Status', 'trim');
				$this->form_validation->set_rules('business_remarks', 'Business Remarks', 'trim');
			}

			//Notes
			$this->form_validation->set_rules('notes', '', 'trim|required');			

			if($this->form_validation->run() == FALSE)	{
					$this->load->view('borrower/create', $data);
				} else {	
					
					//Generate Account ID
					$acc_id = $this->borrower_model->generate_AccountID();
					
					//Proceed saving account					
					$action = $this->borrower_model->create($acc_id);				
							
					if($action) {		

						//Save addresses //////////////
						//Birthplace
						$bldg = strip_tags($this->input->post('bplace_bldg'));
						$strt = strip_tags($this->input->post('bplace_strt'));
						$brgy = strip_tags($this->input->post('bplace_brgy'));
						$city = strip_tags($this->input->post('bplace_city'));
						$prov = strip_tags($this->input->post('bplace_prov'));
						$zip  = strip_tags($this->input->post('bplace_zip'));
						$ctry = strip_tags($this->input->post('bplace_ctry'));
						$this->borrower_model->create_address($acc_id, 0, $bldg, $strt, $brgy, $city, $prov, $zip, $ctry);
						//Home Address
						$bldg = strip_tags($this->input->post('home_bldg'));
						$strt = strip_tags($this->input->post('home_strt'));
						$brgy = strip_tags($this->input->post('home_brgy'));
						$city = strip_tags($this->input->post('home_city'));
						$prov = strip_tags($this->input->post('home_prov'));
						$zip  = strip_tags($this->input->post('home_zip'));
						$ctry = strip_tags($this->input->post('home_ctry'));
						$this->borrower_model->create_address($acc_id, 1, $bldg, $strt, $brgy, $city, $prov, $zip, $ctry);
						//Current Address
						$bldg = strip_tags($this->input->post('addr_bldg'));
						$strt = strip_tags($this->input->post('addr_strt'));
						$brgy = strip_tags($this->input->post('addr_brgy'));
						$city = strip_tags($this->input->post('addr_city'));
						$prov = strip_tags($this->input->post('addr_prov'));
						$zip  = strip_tags($this->input->post('addr_zip'));
						$ctry = strip_tags($this->input->post('addr_ctry'));
						$this->borrower_model->create_address($acc_id, 2, $bldg, $strt, $brgy, $city, $prov, $zip, $ctry);


						//Save Spouse /////////////////////
						if($this->input->post('civil_stat') == 'Married') {
							$this->borrower_model->create_spouse($acc_id);
						}

						//Save Contact Numbers ///////////
						$contact = $this->input->post('contact');
						//Loop
						for ($i=0; $i < sizeof($contact); $i++) { 
							$this->borrower_model->create_contact($acc_id, 0, $contact[$i]); //save 
						}

						//Save Emails /////////////
						$email = $this->input->post('email');
						//Loop
						for ($i=0; $i < sizeof($email); $i++) { 
							$this->borrower_model->create_contact($acc_id, 1, $email[$i]); //save 
						}

						//Save Education /////////////////////
							$this->borrower_model->create_educ($acc_id);

						//Save Business
						if ($this->input->post('business_nature') || $this->input->post('business_name')) {
							$employer = strip_tags($this->input->post('business_name'));
							$position = strip_tags($this->input->post('business_nature'));
							$address = strip_tags($this->input->post('business_addr'));
							$date_start = strip_tags($this->input->post('business_date'));
							$contact = strip_tags($this->input->post('business_contact'));
							$status = strip_tags($this->input->post('business_status'));
							$remarks = strip_tags($this->input->post('business_remarks'));
							$this->borrower_model->create_work($acc_id, NULL, $employer, $position, $address, dateform($date_start), $contact, $status, $remarks);
						}

						//Save Employment
						if($this->input->post('employ_grp') || $this->input->post('employ_name')) {
							$type = strip_tags($this->input->post('employ_grp'));
							$employer = strip_tags($this->input->post('employ_name'));
							$position = strip_tags($this->input->post('employ_position'));
							$address = strip_tags($this->input->post('employ_addr'));
							$date_start = strip_tags($this->input->post('employ_date'));
							$contact = strip_tags($this->input->post('employ_contact'));
							$status = strip_tags($this->input->post('employ_status'));
							$remarks = strip_tags($this->input->post('employ_remarks'));
							$this->borrower_model->create_work($acc_id, $type, $employer, $position, $address, dateform($date_start), $contact, $status, $remarks);
						}
						//											

						// Save Log Data ///////////////////				

						$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'borrower',
							'tag_id'	=> 	$acc_id,
							'action' 	=> 	'Account Registration'
							);

				
						//Save Logs/////////////////////////
						$this->logs_model->save_logs($log);		
						////////////////////////////////////
					
						$this->session->set_flashdata('success', 'Account Registered!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					} else {
						//failure
						$this->session->set_flashdata('error', 'Error occured!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					}		
			}
		
		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}

	public function view($id)		{


		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['site_title'] = APP_NAME;
			$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record

			//Fetch Data	
			$data['info']					= $this->borrower_model->view($id);
			$data['info']['current_addr']	= $this->borrower_model->fetch_addresses($id, 2)[0]['address'];

			$data['addresses']		= $this->borrower_model->fetch_addresses($id);
			$data['mobiles']		= $this->borrower_model->fetch_contacts($id, 0);
			$data['emails']			= $this->borrower_model->fetch_contacts($id, 1);
			$data['employments']	= $this->borrower_model->fetch_works($id, 0);
			$data['businesses']		= $this->borrower_model->fetch_works($id, NULL);

			$data['loans']			= $this->loans_model->fecth_loans(NULL, NULL, NULL, NULL, $id);

			$data['expenses']		= $this->loans_model->fetch_expenses();
			$data['income']			= $this->loans_model->fetch_income();

			$data['title'] 		= $data['info']['name'];

			$data['logs']		= $this->logs_model->fetch_logs('borrower', $id, 50);

			//Validate if record exist
			 //IF NO ID OR NO RESULT, REDIRECT
				if(!$id || !$data['info'] || $data['info']['is_deleted']) {

					$notif['error'] = 'Account Deactivated. Please contact your Administrator for Reactivation!';
		   			$this->sessnotif->setNotif($notif);

					redirect('borrowers', 'refresh');
			}	
			
			$this->load->view('borrower/view', $data);	

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}




	public function delete()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{
			
			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   
		 
		   if($this->form_validation->run() == FALSE)	{

				//convert validation errors to flashdata notification
		   		$notif['warning'] = array_values($this->form_validation->error_array());
		   		$this->sessnotif->setNotif($notif);
		   		
				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

				$key_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row				

				if($this->item_model->delete($key_id)) {

					$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'item',
							'tag_id'	=> 	$key_id,
							'action' 	=> 	'Deleted Item'
							);

				
					//Save Logs/////////////////////////
					$this->logs_model->save_logs($log);		
					////////////////////////////////////

					$this->session->set_flashdata('success', 'Item Deleted!');
					redirect('items', 'refresh');
				}
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}


	/**
	 * Updates Personal Information
	 */
	public function Update_PersonalInfo()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{
			
			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');    

			$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
			$this->form_validation->set_rules('mname', 'Middle Name', 'trim|required');
			$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('bdate', 'Birth Date', 'trim|required');
			$this->form_validation->set_rules('sex', 'Sex', 'trim|required');
			$this->form_validation->set_rules('civil_stat', 'Civil Status', 'trim|required');

			//birthplace
			$this->form_validation->set_rules('bplace_bldg', 'Birthplace Bldg', 'trim');
			$this->form_validation->set_rules('bplace_strt', 'Birthplace Street', 'trim');
			$this->form_validation->set_rules('bplace_brgy', 'Birthplace Brgy', 'trim');
			$this->form_validation->set_rules('bplace_city', 'Birthplace City', 'trim|required');
			$this->form_validation->set_rules('bplace_prov', 'Birthplace Province', 'trim|required');
			$this->form_validation->set_rules('bplace_zip', 'Birthplace ZIP Code', 'trim');
			$this->form_validation->set_rules('bplace_ctry', 'Birthplace Country', 'trim|required');
		 
		   if($this->form_validation->run() == FALSE)	{

				//convert validation errors to flashdata notification
		   		$notif['warning'] = array_values($this->form_validation->error_array());
		   		$this->sessnotif->setNotif($notif);
		   		
				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

					$acc_id = $this->encryption->decrypt($this->input->post('id')); //ID of the account		

					//fetch current info
					$info = $this->borrower_model->view($acc_id);	

					//pre log data
					$log_action = "Updated Personal Information";

					//put the name into one single variable
					$old_name = $info['firstname'] . ' ' . $info['middlename'] . ' ' . $info['lastname'];
					$new_name = $this->input->post('fname') . ' ' . $this->input->post('mname') . ' ' . $this->input->post('lname');
					
					if($old_name != $new_name) {
						$log_action .= '; Changed name from ' . $old_name . ' to ' . $new_name;
					}

					//Proceed updating 
					if($this->borrower_model->update($acc_id, $info['bplace_id'])) {

						$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'borrower',
							'tag_id'	=> 	$acc_id,
							'action' 	=> 	$log_action
							);

				
						//Save Logs/////////////////////////
						$this->logs_model->save_logs($log);		
						////////////////////////////////////

						$this->session->set_flashdata('success', $log_action);
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					} else {
						$this->session->set_flashdata('error', 'Oops! An Error has Occured!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					}
					
			}
			

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}

	/**
	 * -------------------------------------------------------------------------------------------------------------
	 * Spouse 
	 * -------------------------------------------------------------------------------------------------------------
	 * 
	 */
	
	public function Update_Spouse()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{
			
			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   
			
			$this->form_validation->set_rules('spouse_fname', 'Spouse Firstname', 'trim|required');
			$this->form_validation->set_rules('spouse_mname', 'Spouse Middlename', 'trim|required');
			$this->form_validation->set_rules('spouse_lname', 'Spouse Lastname', 'trim|required');
			$this->form_validation->set_rules('spouse_bdate', 'Spouse Birthdate', 'trim|required');
			$this->form_validation->set_rules('spouse_bplace', 'Spouse Birthplace', 'trim');
			$this->form_validation->set_rules('spouse_contact', 'Spouse Contact', 'trim|required');
			$this->form_validation->set_rules('spouse_occupation', 'Spouse Occupation', 'trim');
			$this->form_validation->set_rules('spouse_occuaddr', 'Spouse Work Address', 'trim');
		 
		   if($this->form_validation->run() == FALSE)	{

				//convert validation errors to flashdata notification
		   		$notif['warning'] = array_values($this->form_validation->error_array());
		   		$this->sessnotif->setNotif($notif);
		   		
				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

				$acc_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row				

				$info = $this->borrower_model->view($acc_id);

				//check if spouse exist. if none, register new spouse
				if($info['spouse_id']) {
					//if record exits, update Spouse info
					//Update function
					if($this->borrower_model->update_spouse($info['spouse_id'])) {
						$log_action = "Updated a Spouse Record";
						//set flag
						$flag = TRUE;
					} else {
						//set error flag
						$flag = FALSE;
					}

				} else {
					//Register Spouse
					if($this->borrower_model->create_spouse($acc_id)) {
						$log_action = "Created a Spouse Record. Married to " . $this->input->post('spouse_fname') . ' ' . $this->input->post('spouse_lname');
						//set flag
						$flag = TRUE;
					}
				}

				//check if it is action successfully executed; return SUCCESS if true
				if($flag) {

					$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'borrower',
							'tag_id'	=> 	$acc_id,
							'action' 	=> 	$log_action
							);

				
					//Save Logs/////////////////////////
					$this->logs_model->save_logs($log);		
					////////////////////////////////////

					$this->session->set_flashdata('success', $log_action);
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				} else {
					//Error occurs / Error on savincg
					$this->session->set_flashdata('error', 'An Error has Occured!');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}



	/**
	 * -------------------------------------------------------------------------------------------------------------
	 * Educational Attainment
	 * -------------------------------------------------------------------------------------------------------------
	 */
	
	public function Update_Education()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{
			
			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   
			//Educational Attainment
			$this->form_validation->set_rules('educ_level', 'Education Level', 'trim|required');
			$this->form_validation->set_rules('educ_school', 'School Attended', 'trim|required');
			$this->form_validation->set_rules('educ_course', 'Course Taken', 'trim|required');
			$this->form_validation->set_rules('educ_year', 'School Year', 'trim|required');
		 
		   if($this->form_validation->run() == FALSE)	{

				//convert validation errors to flashdata notification
		   		$notif['warning'] = array_values($this->form_validation->error_array());
		   		$this->sessnotif->setNotif($notif);
		   		
				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

				$acc_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row				

				if($this->borrower_model->update_educ($acc_id)) {

					$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'borrower',
							'tag_id'	=> 	$acc_id,
							'action' 	=> 	'Updated Educational Background'
							);

				
					//Save Logs/////////////////////////
					$this->logs_model->save_logs($log);		
					////////////////////////////////////

					$this->session->set_flashdata('success', 'Updated Educational Background');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				} else {
					//Error occurs / Error on savincg
					$this->session->set_flashdata('error', 'An Error has Occured!');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}



	/**
	 * --------------------------------------------------------------------------------------------------------------
	 * Addresses
	 * --------------------------------------------------------------------------------------------------------------
	 */

	public function add_address()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{			
			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   
			$this->form_validation->set_rules('addr_bldg', 'Address Bldg', 'trim|required');
			$this->form_validation->set_rules('addr_strt', 'Address Street', 'trim|required');
			$this->form_validation->set_rules('addr_brgy', 'Address Brgy', 'trim|required');
			$this->form_validation->set_rules('addr_city', 'Address City', 'trim|required');
			$this->form_validation->set_rules('addr_prov', 'Address Province', 'trim|required');
			$this->form_validation->set_rules('addr_zip', 'Address ZIP Code', 'trim|required');
			$this->form_validation->set_rules('addr_ctry', 'Address Country', 'trim|required');
			$this->form_validation->set_rules('addr_type', 'Address Type', 'trim|required');
		 
		   if($this->form_validation->run() == FALSE)	{

				//convert validation errors to flashdata notification
		   		$notif['warning'] = array_values($this->form_validation->error_array());
		   		$this->sessnotif->setNotif($notif);
				
				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

				$acc_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row			

				$bldg = strip_tags($this->input->post('addr_bldg'));
				$strt = strip_tags($this->input->post('addr_strt'));
				$brgy = strip_tags($this->input->post('addr_brgy'));
				$city = strip_tags($this->input->post('addr_city'));
				$prov = strip_tags($this->input->post('addr_prov'));
				$zip  = strip_tags($this->input->post('addr_zip'));
				$ctry = strip_tags($this->input->post('addr_ctry'));
				$type = $this->encryption->decrypt($this->input->post('addr_type'));

				$action = $this->borrower_model->create_address($acc_id, $type, $bldg, $strt, $brgy, $city, $prov, $zip, $ctry);
				$log_action = "Added New Address";

				if($action) {

					$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'borrower',
							'tag_id'	=> 	$acc_id,
							'action' 	=> 	$log_action
							);

				
					//Save Logs/////////////////////////
					$this->logs_model->save_logs($log);		
					////////////////////////////////////
					$this->session->set_flashdata('success', $log_action);
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				} else {
					$this->session->set_flashdata('error', 'Error Occured! No file uploaded');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}



	public function update_address()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{			
			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   
			$this->form_validation->set_rules('addr_bldg', 'Address Bldg', 'trim|required');
			$this->form_validation->set_rules('addr_strt', 'Address Street', 'trim|required');
			$this->form_validation->set_rules('addr_brgy', 'Address Brgy', 'trim|required');
			$this->form_validation->set_rules('addr_city', 'Address City', 'trim|required');
			$this->form_validation->set_rules('addr_prov', 'Address Province', 'trim|required');
			$this->form_validation->set_rules('addr_zip', 'Address ZIP Code', 'trim|required');
			$this->form_validation->set_rules('addr_ctry', 'Address Country', 'trim|required');
			$this->form_validation->set_rules('addr_type', 'Address Type', 'trim|required');
		 
		   if($this->form_validation->run() == FALSE)	{

				//convert validation errors to flashdata notification
		   		$notif['warning'] = array_values($this->form_validation->error_array());
		   		$this->sessnotif->setNotif($notif);
				
				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

				$id = $this->encryption->decrypt($this->input->post('id')); //ID of the address
				$info = $this->borrower_model->view_address($id); //Fetch old address info

				$bldg = strip_tags($this->input->post('addr_bldg'));
				$strt = strip_tags($this->input->post('addr_strt'));
				$brgy = strip_tags($this->input->post('addr_brgy'));
				$city = strip_tags($this->input->post('addr_city'));
				$prov = strip_tags($this->input->post('addr_prov'));
				$zip  = strip_tags($this->input->post('addr_zip'));
				$ctry = strip_tags($this->input->post('addr_ctry'));
				$type = $this->encryption->decrypt($this->input->post('addr_type'));

				$action = $this->borrower_model->update_address($id, $info['borrower_id'], $type, $bldg, $strt, $brgy, $city, $prov, $zip, $ctry);
				$new_address = $this->borrower_model->view_address($action); // fetch new address info

				//Much more complex logging information
				//Compare details 
				if ($new_address['address'] != $info['address']) {
					$log_action = "Updated Address: " . $info['address'] . " to " . $new_address['address']; //log_action
				} else {
					//Address Types
					if($new_address['type'] == 1) {
						$addr_type = "Home";
					} elseif($new_address['type'] == 2) {
						$addr_type = "Current";
					} elseif($new_address['type'] == 3) {
						$addr_type = "Other";
					}

					$log_action = "Updated " . $new_address['address'] . " as " . $addr_type . " Address";
				}
				

				if($action) {

					$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'borrower',
							'tag_id'	=> 	$info['borrower_id'],
							'action' 	=> 	$log_action
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


	/**
	 * Updates current address, either from address list or new input
	 */
	public function update_CurrentAddr()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{			

			if ($this->input->post('new_address')) {
				//Set FORM VALIDATION for new address
				$this->form_validation->set_rules('id', 'ID', 'trim|required');   
				$this->form_validation->set_rules('addr_bldg', 'Address Bldg', 'trim|required');
				$this->form_validation->set_rules('addr_strt', 'Address Street', 'trim|required');
				$this->form_validation->set_rules('addr_brgy', 'Address Brgy', 'trim|required');
				$this->form_validation->set_rules('addr_city', 'Address City', 'trim|required');
				$this->form_validation->set_rules('addr_prov', 'Address Province', 'trim|required');
				$this->form_validation->set_rules('addr_zip', 'Address ZIP Code', 'trim|required');
				$this->form_validation->set_rules('addr_ctry', 'Address Country', 'trim|required');
			} else {
				//Set FORM VALIDATION for address list
				$this->form_validation->set_rules('id', 'ID', 'trim|required');   
				$this->form_validation->set_rules('addr_list', 'Address List', 'trim|required');   
			}
			
		 
		   if($this->form_validation->run() == FALSE)	{

				//convert validation errors to flashdata notification
		   		$notif['warning'] = array_values($this->form_validation->error_array());
		   		$this->sessnotif->setNotif($notif);

				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

				$acc_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row		
				$current_addr = $this->borrower_model->view_address(NULL, $acc_id);	

				if ($this->input->post('new_address')) {
					//Create New Address 
					$bldg = strip_tags($this->input->post('addr_bldg'));
					$strt = strip_tags($this->input->post('addr_strt'));
					$brgy = strip_tags($this->input->post('addr_brgy'));
					$city = strip_tags($this->input->post('addr_city'));
					$prov = strip_tags($this->input->post('addr_prov'));
					$zip  = strip_tags($this->input->post('addr_zip'));
					$ctry = strip_tags($this->input->post('addr_ctry'));

					$new_addr = $this->borrower_model->create_address($acc_id, 2, $bldg, $strt, $brgy, $city, $prov, $zip, $ctry); //New Address ID
					
					//save new address
					if($new_addr) {
						$info = $this->borrower_model->view_address($new_addr); //gets the data of the new address
						$log_action = "Created New Current Address: " . $info['address'] . "| Last address set was: " . $current_addr['address'];
						$flag = true;
					} else {
						$flag = false;
					}

				} else {
					//Update Current Address from Address List
					$addr_list = $this->encryption->decrypt($this->input->post('addr_list'));

					$info = $this->borrower_model->view_address($addr_list); //gets the data of the old current address

					if($this->borrower_model->update_CurrentAddr($acc_id, $addr_list)) {
						$log_action = "Changed Current Address from " . $current_addr['address'] . " to " . $info['address'];
						$flag = true;
					} else {
						$flag = false;
					}
				}

				

				if($flag) {

					$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'borrower',
							'tag_id'	=> 	$acc_id,
							'action' 	=> 	$log_action
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




	/**
	 * --------------------------------------------------------------------------------------------------------------
	 * Contacts and Emails
	 * --------------------------------------------------------------------------------------------------------------
	 * 
	 */
	


	public function add_contact()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{			
			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   
		 
		   if($this->form_validation->run() == FALSE)	{

				//convert validation errors to flashdata notification
		   		$notif['warning'] = array_values($this->form_validation->error_array());
		   		$this->sessnotif->setNotif($notif);
		   		
				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

				$acc_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row			

					if ($this->input->post('contact')) {
						//Save Contact Numbers ///////////
						$contact = $this->input->post('contact');
						//Loop
						for ($i=0; $i < sizeof($contact); $i++) { 
							$action = $this->borrower_model->create_contact($acc_id, 0, $contact[$i]); //save 
						}
						$log_action = "Added New Contact Number";
					}

					if ($this->input->post('email')) {
						//Save Emails /////////////
						$email = $this->input->post('email');
						//Loop
						for ($i=0; $i < sizeof($email); $i++) { 
							$action = $this->borrower_model->create_contact($acc_id, 1, $email[$i]); //save 
						}
						$log_action = "Added New Email Address";
					}

				if($action) {

					$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'borrower',
							'tag_id'	=> 	$acc_id,
							'action' 	=> 	$log_action
							);

				
					//Save Logs/////////////////////////
					$this->logs_model->save_logs($log);		
					////////////////////////////////////
					$this->session->set_flashdata('success', $log_action);
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				} else {
					$this->session->set_flashdata('error', 'Error Occured! No file uploaded');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}


	public function update_contact()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{			
			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   
			$this->form_validation->set_rules('value', 'Value', 'trim');   
		 
		   if($this->form_validation->run() == FALSE)	{

				//convert validation errors to flashdata notification
		   		$notif['warning'] = array_values($this->form_validation->error_array());
		   		$this->sessnotif->setNotif($notif);
		   		
				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

				$id = $this->encryption->decrypt($this->input->post('id')); //ID of the row	
				$info = $this->borrower_model->view_contact($id);	

				//if value is blank, delete contact
				if($this->input->post('value')) {
					//update contact
					//validate if task executed successfully
					if($this->borrower_model->update_contact($id)) {
						$log_action = 'Updated Contact Information: ' . $info['value'] . ' to ' . $this->input->post('value');
						$flag = true; //success flag
					} else {
						$flag = false; //error flag
					}
				} else {
					//delete contact
					if($this->borrower_model->delete_contact($id)) {
						$log_action = 'Deleted Contact Information: ' . $info['value'];
						$flag = true; //success flag
					} else {
						$flag = false; //error flag
					}
				}

				if($flag) {

					$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'borrower',
							'tag_id'	=> 	$info['borrower_id'],
							'action' 	=> 	$log_action
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



	/**
	 * -----------------------------------------------------------------------------------------------------------
	 * Work and Business Related 
	 * -----------------------------------------------------------------------------------------------------------
	 * 
	 */
	
	public function add_work()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{			
			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   

			//Employment / Employed
			if($this->input->post('employ_grp') || $this->input->post('employ_name')) {
				$this->form_validation->set_rules('employ_grp', 'Employer Group', 'trim|required');
				$this->form_validation->set_rules('employ_name', 'Employer Name', 'trim|required');
				$this->form_validation->set_rules('employ_position', 'Employed Position', 'trim|required');
				$this->form_validation->set_rules('employ_date', 'Employed Date', 'trim|required');
				$this->form_validation->set_rules('employ_addr', 'Employed Word Address', 'trim|required');
				$this->form_validation->set_rules('employ_contact', 'Employed Contact', 'trim|required');
				$this->form_validation->set_rules('employ_status', 'Employment Status', 'trim');
				$this->form_validation->set_rules('employ_remarks', 'Employment Remarks', 'trim');
			}

			//Business / Self-employed
			if ($this->input->post('business_nature') || $this->input->post('business_name')) {
				$this->form_validation->set_rules('business_name', 'Business Name', 'trim|required');
				$this->form_validation->set_rules('business_nature', 'Business Nature', 'trim|required');
				$this->form_validation->set_rules('business_date', 'Business Start Date', 'trim|required');
				$this->form_validation->set_rules('business_addr', 'Business Address', 'trim|required');
				$this->form_validation->set_rules('business_contact', 'Business Contact', 'trim|required');
				$this->form_validation->set_rules('business_status', 'Business Status', 'trim');
				$this->form_validation->set_rules('business_remarks', 'Business Remarks', 'trim');
			}
		 
		   if($this->form_validation->run() == FALSE)	{

				//convert validation errors to flashdata notification
		   		$notif['warning'] = array_values($this->form_validation->error_array());
		   		$this->sessnotif->setNotif($notif);
		   		
				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

				$acc_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row			

						//Save Business
						if ($this->input->post('business_nature') || $this->input->post('business_name')) {
							$employer = strip_tags($this->input->post('business_name'));
							$position = strip_tags($this->input->post('business_nature'));
							$address = strip_tags($this->input->post('business_addr'));
							$date_start = strip_tags($this->input->post('business_date'));
							$contact = strip_tags($this->input->post('business_contact'));
							$status = strip_tags($this->input->post('business_status'));
							$remarks = strip_tags($this->input->post('business_remarks'));
							$action = $this->borrower_model->create_work($acc_id, NULL, $employer, $position, $address, dateform($date_start), $contact, $status, $remarks);
							$log_action = "Added a New Business - " . $employer;
						}

						//Save Employment
						if($this->input->post('employ_grp') || $this->input->post('employ_name')) {
							$type = strip_tags($this->input->post('employ_grp'));
							$employer = strip_tags($this->input->post('employ_name'));
							$position = strip_tags($this->input->post('employ_position'));
							$address = strip_tags($this->input->post('employ_addr'));
							$date_start = strip_tags($this->input->post('employ_date'));
							$contact = strip_tags($this->input->post('employ_contact'));
							$status = strip_tags($this->input->post('employ_status'));
							$remarks = strip_tags($this->input->post('employ_remarks'));
							$action = $this->borrower_model->create_work($acc_id, $type, $employer, $position, $address, dateform($date_start), $contact, $status, $remarks);
							$log_action = "Added a New Employer - " . $employer;							
						}

				if($action) {

					$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'borrower',
							'tag_id'	=> 	$acc_id,
							'action' 	=> 	$log_action
							);

				
					//Save Logs/////////////////////////
					$this->logs_model->save_logs($log);		
					////////////////////////////////////
					$this->session->set_flashdata('success', $log_action);
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				} else {
					$this->session->set_flashdata('error', 'Error Occured! No file uploaded');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}



	public function update_work()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{			
			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   

			//Employment / Employed
			if($this->input->post('employ_grp') || $this->input->post('employ_name')) {
				$this->form_validation->set_rules('employ_grp', 'Employer Group', 'trim|required');
				$this->form_validation->set_rules('employ_name', 'Employer Name', 'trim|required');
				$this->form_validation->set_rules('employ_position', 'Employed Position', 'trim|required');
				$this->form_validation->set_rules('employ_date', 'Employed Date', 'trim|required');
				$this->form_validation->set_rules('employ_addr', 'Employed Word Address', 'trim|required');
				$this->form_validation->set_rules('employ_contact', 'Employed Contact', 'trim|required');
				$this->form_validation->set_rules('employ_status', 'Employment Status', 'trim');
				$this->form_validation->set_rules('employ_remarks', 'Employment Remarks', 'trim');
			}

			//Business / Self-employed
			if ($this->input->post('business_nature') || $this->input->post('business_name')) {
				$this->form_validation->set_rules('business_name', 'Business Name', 'trim|required');
				$this->form_validation->set_rules('business_nature', 'Business Nature', 'trim|required');
				$this->form_validation->set_rules('business_date', 'Business Start Date', 'trim|required');
				$this->form_validation->set_rules('business_addr', 'Business Address', 'trim|required');
				$this->form_validation->set_rules('business_contact', 'Business Contact', 'trim|required');
				$this->form_validation->set_rules('business_status', 'Business Status', 'trim');
				$this->form_validation->set_rules('business_remarks', 'Business Remarks', 'trim');
			}
		 
		   if($this->form_validation->run() == FALSE)	{

				$this->session->set_flashdata('error', 'An Error has Occured!');				
				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

				$acc_id = $this->encryption->decrypt($this->input->post('acc_id')); //ID of the Borrower's account			
				$id = $this->encryption->decrypt($this->input->post('id')); //ID of the row			

				//Save Business
						if ($this->input->post('business_nature') || $this->input->post('business_name')) {

							$employer = strip_tags($this->input->post('business_name'));
							$position = strip_tags($this->input->post('business_nature'));
							$address = strip_tags($this->input->post('business_addr'));
							$date_start = strip_tags($this->input->post('business_date'));
							$date_end = strip_tags($this->input->post('business_end'));
							$contact = strip_tags($this->input->post('business_contact'));
							$status = strip_tags($this->input->post('business_status'));
							$remarks = strip_tags($this->input->post('business_remarks'));

							//Fetch old data
							$info = $this->borrower_model->view_work($id);

							if($employer != $info['employer_business']) {
								$log_action = "Updated a Business Information: " . $info['employer_business'] . ' -> ' . $employer;
							} else {
								$log_action = "Updated a Business Information: " . $info['employer_business'];
							}

							//Update Function
							$action = $this->borrower_model->update_work($id, NULL, $employer, $position, $address, dateform($date_start), $contact, $status, $remarks, dateform($date_end));
							
							
						}

						//Save Employment
						if($this->input->post('employ_grp') || $this->input->post('employ_name')) {
							$type = strip_tags($this->input->post('employ_grp'));
							$employer = strip_tags($this->input->post('employ_name'));
							$position = strip_tags($this->input->post('employ_position'));
							$address = strip_tags($this->input->post('employ_addr'));
							$date_start = strip_tags($this->input->post('employ_date'));
							$date_end = strip_tags($this->input->post('employ_end'));
							$contact = strip_tags($this->input->post('employ_contact'));
							$status = strip_tags($this->input->post('employ_status'));
							$remarks = strip_tags($this->input->post('employ_remarks'));

							//Fetch old data
							$info = $this->borrower_model->view_work($id);

							if($employer != $info['employer_business']) {
								$log_action = "Updated an Employer Information: " . $info['employer_business'] . ' -> ' . $employer;
							} else {
								$log_action = "Updated an Employer Information: " . $info['employer_business'];
							}

							//Update Function
							$action = $this->borrower_model->update_work($id, $type, $employer, $position, $address, dateform($date_start), $contact, $status, $remarks, dateform($date_end));	

						}

				if($action) {

					$log[] = array(
								'user' 		=> 	$userdata['username'],
								'tag' 		=> 	'borrower',
								'tag_id'	=> 	$acc_id,
								'action' 	=> 	$log_action
								);

					
					//Save Logs/////////////////////////
					$this->logs_model->save_logs($log);		
					////////////////////////////////////
					$this->session->set_flashdata('success', $log_action);
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				} else {
					$this->session->set_flashdata('error', 'Error Occured! No file uploaded');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}

			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}



	public function delete_work()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{
			
			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   
			$this->form_validation->set_rules('checkbox', 'Check Box', 'trim|required');   
			$this->form_validation->set_rules('acc_id', 'Account ID', 'trim|required');   
			$this->form_validation->set_rules('key', 'key', 'trim|required');   
		 
		   if($this->form_validation->run() == FALSE)	{

		   		//convert validation errors to flashdata notification
		   		$notif['warning'] = array_values($this->form_validation->error_array());
		   		$this->sessnotif->setNotif($notif);
		   		
				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

				$id 	= $this->encryption->decrypt($this->input->post('id')); //ID of the row				
				$acc_id = $this->encryption->decrypt($this->input->post('acc_id')); //Account ID			
				$key 	= $this->encryption->decrypt($this->input->post('key')); //Type of Key	

				$info 	= $this->borrower_model->view_work($id);


				if($key) {
					//Business				
					$log_action = 'Deleted a Business Record - ' . $info['employer_business'];
				} else {
					//Employer
					$log_action = 'Deleted an Employer Record - ' . $info['employer_business'];
				}		

				//Delete Function
				if(!$this->borrower_model->delete_work($id)) {
					//Redirects and show error
					//Set Flashdata Notif
					$this->session->set_flashdata('success', $log_action);
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}

				// Log function
				$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'borrower',
							'tag_id'	=> 	$acc_id,
							'action' 	=> 	$log_action
				);
				
				// Save Logs 
				$this->logs_model->save_logs($log);		
	
				//Set Flashdata Notif
				$this->session->set_flashdata('success', $log_action);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
				
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}




	/**
	 *
	 * 	public function upload_gallery()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{			
			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   
		 
		   if($this->form_validation->run() == FALSE)	{

				//convert validation errors to flashdata notification
		   		$notif['warning'] = array_values($this->form_validation->error_array());
		   		$this->sessnotif->setNotif($notif);
		   		
				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

				$key_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row				

				if($this->item_model->upload_gallery($key_id)) {

					$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'item',
							'tag_id'	=> 	$key_id,
							'action' 	=> 	'Uploaded a Gallery Picture'
							);

				
					//Save Logs/////////////////////////
					$this->logs_model->save_logs($log);		
					////////////////////////////////////
					$this->session->set_flashdata('gallery', 1); //used by tabs
					$this->session->set_flashdata('success', 'Picture Uploaded');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				} else {
					$this->session->set_flashdata('gallery', 1); //used by tabs
					$this->session->set_flashdata('error', 'Error Occured! No file uploaded');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}

	public function delete_gallery()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{			
			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   
		 
		   if($this->form_validation->run() == FALSE)	{

				//convert validation errors to flashdata notification
		   		$notif['warning'] = array_values($this->form_validation->error_array());
		   		$this->sessnotif->setNotif($notif);
		   		
				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

				$key_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row			
				$item = $this->item_model->view_gallery($key_id);	

				if($this->item_model->delete_gallery($key_id)) {

					$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'item',
							'tag_id'	=> 	$item['item_id'],
							'action' 	=> 	'Deleted a Gallery Picture'
							);

				
					//Save Logs/////////////////////////
					$this->logs_model->save_logs($log);		
					////////////////////////////////////
					$this->session->set_flashdata('gallery', 1); //used by tabs
					$this->session->set_flashdata('success', 'Deleted Picture');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				} else {
					$this->session->set_flashdata('gallery', 1); //used by tabs
					$this->session->set_flashdata('error', 'Error Occured! No file uploaded');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}

	 */




}
