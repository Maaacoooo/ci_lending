<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notes extends CI_Controller {

	public function __construct()	{
		parent::__construct();		
       $this->load->model('user_model');
       $this->load->model('notes_model');
	}	


	public function create()    {

	    $userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

	    if($userdata) {     
	      //FORM VALIDATION
	      $this->form_validation->set_rules('tag_id', 'Tag ID', 'trim|required');    
	      $this->form_validation->set_rules('tag', 'Tag', 'trim|required');    
	      $this->form_validation->set_rules('description', 'Description', 'trim|required');    
	     
	       if($this->form_validation->run() == FALSE) {

	        //convert validation errors to flashdata notification
	          $notif['warning'] = array_values($this->form_validation->error_array());
	          $this->sessnotif->setNotif($notif);
	          
	        redirect($_SERVER['HTTP_REFERER'], 'refresh');

	      } else {

	        $tag_id = $this->encryption->decrypt($this->input->post('tag_id')); //ID of the loan 
	        $tag 	= $this->encryption->decrypt($this->input->post('tag')); //ID of the loan 

	        if($this->notes_model->create($tag, $tag_id, $userdata['username'])) {

	          $log[] = array(
	              'user'    =>  $userdata['username'],
	              'tag'     =>  $tag,
	              'tag_id'  =>  $tag_id,
	              'action'  =>  'Created a Note'
	              );

	        
	          //Save Logs/////////////////////////
	          $this->logs_model->save_logs($log);   
	          ////////////////////////////////////
	          $this->session->set_flashdata('success', 'Note Saved!');
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

	        if($this->notes_model->update($id)) {
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


  function check_user($id) {

	    $id 		= $this->encryption->decrypt($id); //ID of the loan 
  		$userdata 	= $this->session->userdata('admin_logged_in');

  		$info	= $this->notes_model->view($id);

  		if($info['user'] == $userdata['username']) {
  			return TRUE;
  		} else {
			$this->form_validation->set_message('check_user', 'You are not allowed to update or delete this note!');
  			return FALSE;
  		}



  }




}
