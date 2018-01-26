<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Loans extends CI_Controller {

	public function __construct()	{
		parent::__construct();		
       $this->load->model('user_model');
       $this->load->model('borrower_model');
       $this->load->model('loans_model');
	}	


	public function create()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{
			
			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   
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
				$due_date = dateform($moment->cloning()->addDays($loan_days)->calendar());


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


	function test() {
		
		var_dump($this->input->post('creditors'));
	}

	function test2() {
		include APPPATH.'libraries/Moment/Moment.php';
		include APPPATH.'libraries/Moment/MomentLocale.php';
		include APPPATH.'libraries/Moment/MomentPeriodVo.php';
		include APPPATH.'libraries/Moment/MomentHelper.php';
		include APPPATH.'libraries/Moment/MomentFromVo.php';

		$m = new \Moment\Moment();
$c = $m->cloning()->addDays(45);

echo $c->calendar(); // 16

	}


}
