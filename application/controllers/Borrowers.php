<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Borrowers extends CI_Controller {

	public function __construct()	{
		parent::__construct();		
		$this->load->model('user_model');
		$this->load->model('borrower_model');
	}	


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

	public function product_list()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['title'] 		= 'Product List';
			$data['site_title'] = APP_NAME;
			$data['user'] 		= $this->user_model->userdetails($userdata['username']); //fetches users record

			//Fetch Data
			$data['brands']		= $this->brand_model->fetch_brands(NULL, NULL, NULL, 0);
			$data['units']		= $this->unit_model->fetch_units(NULL, NULL, NULL, 0);
			$data['category']	= $this->category_model->fetch_categories(NULL, NULL, NULL, 0);

			//Search 
			$search = '';
			if(isset($_GET['search'])) {
				$search = $_GET['search'];
			}

			//Paginated data				            
	   		$config['num_links'] = 5;
			$config['base_url'] = base_url('/items/product_list/');
			$config["total_rows"] = $this->item_model->count_items($search, 0);
			$config['per_page'] = 50;				
			$this->load->config('pagination'); //LOAD PAGINATION CONFIG

			$this->pagination->initialize($config);
		    if($this->uri->segment(3)){
		       $page = ($this->uri->segment(3)) ;
		  	}	else 	{
		       $page = 1;		               
		    }

		    $data["results"] = $this->item_model->fetch_items($config["per_page"], $page, $search, 0);
		    $str_links = $this->pagination->create_links();
		    $data["links"] = explode('&nbsp;',$str_links );

		    //ITEM NUMBERING
		    $data['per_page'] = $config['per_page'];
		    $data['page'] = $page;

		    //GET TOTAL RESULT
		    $data['total_result'] = $config["total_rows"];
		    //END PAGINATION		
		
			//Form Validation for user
			$this->form_validation->set_rules('name', 'Item Name', 'trim|required'); 
			$this->form_validation->set_rules('serial', 'Serial No', 'trim|is_unique[items.serial]'); 
			$this->form_validation->set_rules('category', 'Category', 'trim|required');  
			$this->form_validation->set_rules('unit', 'Unit', 'trim|required'); 			
			$this->form_validation->set_rules('desc', 'Description', 'trim'); 
			$this->form_validation->set_rules('srp', 'SRP', 'trim|decimal'); 
			$this->form_validation->set_rules('dp', 'DP', 'trim|decimal'); 
			$this->form_validation->set_rules('critical_level', 'Critical Level', 'trim'); 

			if($data['user']['usertype'] == 'Administrator') {
				$this->form_validation->set_rules('brand', 'Brand', 'trim|required'); 				
			}
			

			if($this->form_validation->run() == FALSE)	{
					$this->load->view('items/product_list', $data);
				} else {	
					
					//generate unique ITEM ID
					$code = num_to_char($this->input->post('dp'));
					$cat = prettyID($this->category_model->view($this->input->post('category'))['id'], 2);
					$brand = prettyID($this->brand_model->view($this->input->post('brand'))['id'], 2);

					$item_id = $this->item_model->generate_ItemID($code, $cat, $brand);
					//Proceed saving item					
					$action = $this->item_model->create($item_id);				
							
					if($action) {			

						// Save Log Data ///////////////////				

						$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'item',
							'tag_id'	=> 	$item_id,
							'action' 	=> 	'Product Registration'
							);

				
						//Save Logs/////////////////////////
						$this->logs_model->save_logs($log);		
						////////////////////////////////////
					
						$this->session->set_flashdata('success', 'Product Registered!');
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
			$data['brands']		= $this->brand_model->fetch_brands(NULL, NULL, NULL, 0);
			$data['units']		= $this->unit_model->fetch_units(NULL, NULL, NULL, 0);
			$data['category']	= $this->category_model->fetch_categories(NULL, NULL, NULL, 0);			
			$data['gallery']	= $this->item_model->fetch_gallery($id);			
			$data['inventory']	= $this->item_model->fetch_inventory_items(NULL, NULL, NULL, 0, $id);			

			$data['info']		= $this->item_model->view($id);
			$data['title'] 		= $data['info']['name'];

			//Validate if record exist
			 //IF NO ID OR NO RESULT, REDIRECT
				if(!$id || !$data['info'] || $data['info']['is_deleted']) {
					redirect('items', 'refresh');
			}	

			//Form Validation
			$this->form_validation->set_rules('id', 'ID', 'trim|required'); 
			$this->form_validation->set_rules('name', 'Item Name', 'trim|required'); 
			$this->form_validation->set_rules('serial', 'Serial No', 'trim|callback_check_serial'); 
			$this->form_validation->set_rules('category', 'Category', 'trim|required'); 
			$this->form_validation->set_rules('unit', 'Unit', 'trim|required'); 
			$this->form_validation->set_rules('srp', 'SRP', 'trim|decimal'); 
			$this->form_validation->set_rules('dp', 'DP', 'trim|decimal'); 
			$this->form_validation->set_rules('desc', 'Description', 'trim'); 			
			$this->form_validation->set_rules('critical_level', 'Critical Level', 'trim'); 
			
			if($data['user']['usertype'] == 'Administrator') {
				$this->form_validation->set_rules('brand', 'Brand', 'trim|required'); 				
			}
		
			//Validate Usertype
			if($data['user']['usertype'] == 'Administrator' || $data['user']['brand'] == $data['info']['brand']) {
				if($this->form_validation->run() == FALSE)	{
					//Check URI Request 
					if($this->uri->segment(4) == 'barcode') {		
						//Barcode Printing				
						$this->load->view('items/print_barcode', $data);						
					} elseif($this->uri->segment(4) == 'batch') {
						//Batch View
						$batch_id = $this->uri->segment(5);
						$data['batch'] = $this->inventory_model->view_inventory($batch_id);
						$data['logs']		= $this->logs_model->fetch_logs('inventory', $batch_id, 50);
						$this->load->view('items/batch_view', $data);						
					} elseif(!$this->uri->segment(4)) {
						//Item View
						$data['logs']		= $this->logs_model->fetch_logs('item', $id, 50);
						$this->load->view('items/view', $data);
					} else {
						show_404();
					}
				} else {	

					//Proceed saving candidate				
					$key_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row
					$action = $this->item_model->update($key_id);


					if($action) {		

						$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'item',
							'tag_id'	=> 	$key_id,
							'action' 	=> 	'Updated Item Information'
							);
				
						//Save Array of Logs ///////////////			
						$this->logs_model->save_logs($log);			
						////////////////////////////////////						
					
						$this->session->set_flashdata('success', 'Succes! Item Updated!');
						$this->session->set_flashdata('setting', 1); //used by tabs
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					} else {
						//failure
						$this->session->set_flashdata('setting', 1); //used by tabs
						$this->session->set_flashdata('error', 'Oops! Error occured!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					}			
					
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
	 * Checks the Serial of the Item. Returns True if Serial Exist from another Record
	 * @param  [type] $item [description]
	 * @return [type]       [description]
	 */
	function check_serial($serial) {


		if($serial) {
			$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata
			$item = $this->encryption->decrypt($this->input->post('id')); 

			if($this->item_model->check_serial($item, $serial)) {
				$this->form_validation->set_message('check_serial', 'Serial is Registered from another Item!');		
				return FALSE;
			} else {
				return TRUE;
			}
		} else {
			return TRUE;
		}
	}


	public function upload_gallery()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{			
			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   
		 
		   if($this->form_validation->run() == FALSE)	{

				$this->session->set_flashdata('error', 'An Error has Occured!');
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

				$this->session->set_flashdata('error', 'An Error has Occured!');
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



	public function delete()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{
			
			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   
		 
		   if($this->form_validation->run() == FALSE)	{

				$this->session->set_flashdata('error', 'An Error has Occured!');
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



	public function print_total_inventory()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['site_title'] = APP_NAME;
			$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record

			//Page Data 
			$data['items']		= $this->item_model->total_inventory();
			$data['total_items'] = $this->item_model->count_items('', '');
			$data['title'] 		= 'Total Inventory Report';

		
			//Validate Usertype
			if($data['user']['usertype'] == 'Administrator') {
				
				$this->load->view('items/print_total_inventory', $data);
				
			} else {
				show_error('Oops! Your account does not have the privilege to view the content. Please Contact the Administrator', 403, 'Access Denied!');				
			}		

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}



	public function rebatch()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{
			
			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   
		 
		   if($this->form_validation->run() == FALSE)	{

				$this->session->set_flashdata('error', 'An Error has Occured!');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

				$key_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row				
				$batch 	= $this->inventory_model->view_inventory($key_id); 
				$qty 	= $this->input->post('qty'); 
				$srp 	= $this->input->post('srp'); 
				$dp 	= $this->input->post('dp'); 

				//Subract inventory from current batch
				$this->inventory_model->add_inventory($batch['item_id'], ($qty*-1), $batch['location'], $batch['actual_price'], $batch['dealer_price']);
				//Add inventory to new batch
				$new_batch = $this->inventory_model->add_inventory($batch['item_id'], ($qty), $batch['location'], $srp, $dp);
				

				$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'inventory',
							'tag_id'	=> 	$key_id,
							'action' 	=> 	'Rebatched ' . $qty . ' items to Batch ' . $new_batch
							);

				$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'inventory',
							'tag_id'	=> 	$new_batch,
							'action' 	=> 	'Rebatched ' . $qty . ' items from Batch ' . $key_id
							);


				//Save Logs/////////////////////////
				$this->logs_model->save_logs($log);		
				////////////////////////////////////
				$this->session->set_flashdata('success', 'Successfully Rebatched!');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
				
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}





}
