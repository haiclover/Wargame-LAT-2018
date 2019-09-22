<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['user'] = array();
		if ($this->facebook->is_authenticated())
		{
			$user = $this->facebook->request('get', '/me?fields=id,name');
			if (!isset($user['error']))
			{
				$data['user'] = $user;
			}
		}
		$data = array(
			'mydata'=>$data
		);
		$this->load->view('login', $data);
		
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */