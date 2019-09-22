<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->facebook->destroy_session();
		redirect('Main', redirect);
		
	}

}

/* End of file Logout.php */
/* Location: ./application/controllers/Logout.php */