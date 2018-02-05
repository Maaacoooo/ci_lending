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


  function GenerateFees() {

  }

  function DoSMSReminderBulk() {

  }

  function DoEmailReminderBulk() {

  )


}
