<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// Load library and url helper
		$this->load->library('facebook');
		$this->load->helper('url');
	}
	public function index()
	{
		$this->load->view('start');
	}
	public function web_login()
	{
		$data['user'] = array();
		if ($this->facebook->is_authenticated())
		{
			$user = $this->facebook->request('get', '/me?fields=id,name,email');
			if (!isset($user['error']))
			{
				$data['user'] = $user;
			}

		}
		$this->load->view('web', $data);
	}
	public function js_login()
	{
		$this->load->view('js');
	}
	public function post()
	{
		header('Content-Type: application/json');

		$result = $this->facebook->request(
			'post',
			'/me/feed',
			['message' => $this->input->post('message')]
		);

		echo json_encode($result);
	}
	public function logout()
	{
		$this->facebook->destroy_session();
		redirect('web_login', redirect);
	}
}
