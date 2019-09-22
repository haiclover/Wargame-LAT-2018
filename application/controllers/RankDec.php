<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RankDec extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$_SESSION['num'] = $sid-1;
	}

}

/* End of file RankDec.php */
/* Location: ./application/controllers/RankDec.php */