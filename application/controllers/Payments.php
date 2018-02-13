<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {

	public function __construct()	{
		parent::__construct();		
       $this->load->model('user_model');
       $this->load->model('payments_model');
       $this->load->model('loans_model');
	}	


	public function create()    {

	    $userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

	    if($userdata) {     
	      //FORM VALIDATION
	      $this->form_validation->set_rules('id', 'ID', 'trim|required');        
	      $this->form_validation->set_rules('payee', 'Payee', 'trim|required');        
	      $this->form_validation->set_rules('amount', 'Amount', 'trim|required');        
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

	        //Add to Ledger 
	        $this->loans_model->add_ledger($id, $amount, $userdata['username'], 'Payment #'.$payment_id, 'CPAY');

	          $log[] = array(
	              'user'    =>  $userdata['username'],
	              'tag'     =>  'loans',
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


  function test() {

	    echo number_format('1000', 2, '.', ',');



  }


}
