<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Code extends CI_Controller {

	public function __construct()	{
		parent::__construct();		
	}	

	public function qr($id = APP_NAME, $size = 4)		{


			include APPPATH . '/libraries/Phpqrcode/qrlib.php';

			QRcode::png($id, FALSE, 'L', $size, 1);

	}

}
