<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ranking extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Level_Model');
	}

	public function index()
	{
		$data['user'] = array();
			$user = $this->facebook->request('get', '/me?fields=id,name,email');
			if (!isset($user['error']))
			{
				$data['user'] = $user;
			}
		// $idfb = $data['user']['idfb'];
		$dl = $this->Level_Model->ShowAll();
		// foreach ($dl as $key => $value) {
		// 	return $value['name'].":".$value['rank']."<br/>";
		// }
		$data = array(
			'mangdl'=>$dl
		);
		if(empty($dl))
		{
			redirect($to = "Level", $status = 302, $headers = [], $secure = null);
		}
		else
		{
			$this->load->view('ranking',$data);
		}
	}

}

/* End of file Ranking.php */
/* Location: ./application/controllers/Ranking.php */