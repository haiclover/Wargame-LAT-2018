<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testing extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('testing');
	}

}

/* End of file Testing.php */
/* Location: ./application/controllers/Testing.php */