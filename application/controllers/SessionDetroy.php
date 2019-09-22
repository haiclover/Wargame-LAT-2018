<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SessionDetroy extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->session->sess_destroy();
	}

	public function index()
	{
		
	}

}

/* End of file SessionDetroy.php */
/* Location: ./application/controllers/SessionDetroy.php */