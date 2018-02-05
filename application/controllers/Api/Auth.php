<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()	{
		parent::__construct();		
       $this->load->model('user_model');
       $this->load->model('settings_model');
       $this->load->model('loans_model');
	}


  function getAllPins($api_key = null) {

  		//change of request
  		if(isset($_GET['api_key'])) {
  			$api_key = $_GET['api_key'];
  		}

  		//fetch API KEY AUTH data
  		$api = $this->settings_model->setting('API_KEY_AUTH');


  		if($api_key == $api['value']) {
  			$data = $this->user_model->fetch_pins();
  		} else {
  			show_error('Please contact the System Administrator!',403,'Access Denied!');
  		}


  		echo json_encode($data, JSON_PRETTY_PRINT);

  }


  function getAllBorrowers($api_key = null) {

  		//change of request
  		if(isset($_GET['api_key'])) {
  			$api_key = $_GET['api_key'];
  		}

  		//fetch API KEY AUTH data
  		$api = $this->settings_model->setting('API_KEY_AUTH');


  		if($api_key == $api['value']) {
  			$data = $this->loans_model->fetch_loans(NULL, NULL, NULL, 1, NULL);
  		} else {
  			show_error('Please contact the System Administrator!',403,'Access Denied!');
  		}


  		echo json_encode($data, JSON_PRETTY_PRINT);

  }




}
