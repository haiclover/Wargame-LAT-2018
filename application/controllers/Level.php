<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Level extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Level_Model');
		$this->load->helper('captcha');
		$this->load->helper('string');
	}

	
	public function index($id = null)
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
		
		//$_SESSION['user']=$data['user']['id'];
		$csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
		);
		$data = array(
			'mydata'=>$data,
			'csrf'=>$csrf,
		);
		
		
		if($this->facebook->is_authenticated())
		{
			$name = $data['mydata']['user']['name'];
			$idfb = $data['mydata']['user']['id'];
			$dl= $this->Level_Model->ShowUser($idfb);
			if($id == "")
			{
				if(empty($dl[0]['rank']))
				{
					header("Location:".base_url()."Level/1");
				}
				else
				{
					if($dl[0]['rank']==40)
					{
						header("Location:".base_url()."ranking");
					}
					else
					{
						header("Location:".base_url()."Level/".$dl[0]['rank']);
					}
				}

			}
			else
			{
				$h = 1;
				if($id == 1)
				{
					// $_SESSION['num'] = 1;
					// $currentdata = current_url();
					$this->load->view('1', $data);
					unset($_SESSION['wrongpass']);
				}
				//($_SESSION['user'] == $dl[0]['name'] || $_SESSION['num'] == $h+1 )
				else if ($id == 2 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('2', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 3 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('3', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 4 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('4', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 5 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('5', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 6 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('6', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 7 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('7', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 8 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('8', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 9 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('9', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 10 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('10', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 11 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('11', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 12 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('12', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 13 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('13', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 14 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('14', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 15 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('15', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 16 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('16', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 17 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('17', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 18 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('18', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 19 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('19', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 20 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('20', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 21 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('21', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 22 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('22', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 23 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('23', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 24 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('24', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 25 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('25', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 26 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('26', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 27 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('27', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 28 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('28', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 29 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('29', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 30 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('30', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 31 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('31', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 32 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('32', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 33 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('33', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 34 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('34', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 35 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('35', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 36 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('36', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 37 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('37', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 38 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('38', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 39 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('39', $data);
					unset($_SESSION['wrongpass']);
				}
				else if ($id == 40 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
					$this->load->view('40', $data);
					unset($_SESSION['wrongpass']);
				}
				// else if ($id == 41 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
				// 	$this->load->view('41', $data);
				// 	unset($_SESSION['wrongpass']);
				// }
				// else if ($id == 42 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
				// 	$this->load->view('42', $data);
				// 	unset($_SESSION['wrongpass']);
				// }
				// else if ($id == 43 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
				// 	$this->load->view('43', $data);
				// 	unset($_SESSION['wrongpass']);
				// }
				// else if ($id == 44 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
				// 	$this->load->view('44', $data);
				// 	unset($_SESSION['wrongpass']);
				// }
				// else if ($id == 45 && ($dl[0]['rank']>=$id || $_SESSION['num']+1 == $id)) {
				// 	$this->load->view('45', $data);
				// 	unset($_SESSION['wrongpass']);
				// }
				//header("Location:".base_url()."ranking");
				else
				{
					if(empty($dl[0]['rank']))
					{
						header("Location:".base_url()."Level/1");
					}
					else
					{
						header("Location:".base_url()."Level/".$dl[0]['rank']);
					}
				}
			}
				
				
			}
		
		else
		{
			header("Location:".base_url());
		}
	
	}

	public function submit($sid = null)
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
		date_default_timezone_set('Asia/Ho_Chi_Minh');////TimeZone
		//$_SESSION['user']=$data['user']['id'];
		$csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
		);
		$data = array(
			'mydata'=>$data,
			'csrf'=>$csrf
		);
		$idfb = $data['mydata']['user']['id'];
		// $dluser = $this->Level_Model->ShowUser($idfb);
		
		#facebook group count member
		$token = "EAAAAUaZA8jlABAF76OSOhER01FMvvQCM2rDGkTtf1ZC7iW8oODcEfqnG6m3kkQ65NvAZA7ZCOCKjmRFZCP7ypmStZCtd1435xniZBEnrKomxrWbMgEkCpo5eZAnyNc4EOoulsYKKMaowzHYGtvfSsJKg1tBWFOyMiCZAFjscVTdk10e8cpHZCWjWgm";
		$count_group_mem = "https://graph.facebook.com/156689748317923?fields=members.limit(0).summary(true)&access_token=".$token;
		$count_group_mem = file_get_contents($count_group_mem);
		$count_group_mem = json_decode($count_group_mem,true);
		$count_group_mem = $count_group_mem['members']['summary']['total_count'];
		#facebook group count member

		//ShowUser from Level_Model
		$userdata = $this->Level_Model->ShowUser($idfb);
		$datetime = $this->Level_Model->ShowDate($idfb);
		if($sid == 1)
		{	
			if($this->input->post('password') != "19-09-1999")
			{	
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/1");

			}
			else {
				if(empty($_SESSION['num'])){
					$_SESSION['num']=0;
				}
				if($userdata[0]['rank']<=$sid+1){	
					$time = date("H:i:s");
					$date = date("d-m-Y");		
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}	
				header("Location:".base_url()."Level/2");
				
			}

		}
		else if($sid == 2)
		{	
			if($this->input->post('password') != md5(sha1(base64_encode('haiclover'))))
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
			}
			
		}
		else if($sid == 3)
		{	
			if($this->input->post('password') != "L.A.T Company")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
			}
		}
		else if($sid == 4)
		{	
			if($this->input->post('password') != $idfb)
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
			}
		}
		else if($sid == 5)
		{	
			if($this->input->post('password') != "Internet of Things")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
			}
		}
		else if($sid == 6)
		{	
			if($this->input->post('password') != $count_group_mem)
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
			}
		}
		else if($sid == 7)
		{	
			if($this->input->post('password') != "Dev is my life")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
			}
		}
		else if($sid == 8)
		{	
			if($this->input->post('password') != "Simple robots.txt vulnerability")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
			}
		}
		else if($sid == 9)
		{	
			if($this->input->post('password') != "whoami")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
			}
		}
		else if($sid == 10)
		{	
			if($this->input->post('password') != "177f6b75da142d09d92cab3c06218e2c")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
			}
		}
		else if($sid == 11)
		{	
			if($this->input->post('password') != "Tôi đồng ý với bạn" && $this->input->post('password') != "tôi đồng ý với bạn" && $this->input->post('password') != "bạn nói không sai tí nào" && $this->input->post('password') != "Bạn nói không sai tí nào")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
			}
			
		}
		else if($sid == 12)
		{	
			if(($this->input->post('password') != "c7ee1cf6fe4e0608fcfbe503589cc33005bee02c5d31137490b1aa156d8659a8"))
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
			}
			
		}
		else if($sid == 13)
		{	
			if(empty($_COOKIE['admin']))
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				setcookie('admin','admin',time()-3600);
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
			}
			
		}
		else if($sid == 14)
		{	
			if($this->input->post('password') != "Oh My God!" )
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
			}
			
		}
		else if($sid == 15)
		{	
			if($this->input->post('password') != "d941bc40991caef499df84e95ec8b75b" )
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
			}
			
		}
		else if($sid == 16)
		{	
			

			$apiKey = '708EC79E86';
			$package = 'WS24'; // Package: WS1 - WS24
			$useSSL = false; // Use HTTP or HTTPS (Secure, but slower)
			$ip = $_SERVER['REMOTE_ADDR'];
			if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			{
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			elseif(isset($_SERVER['HTTP_CLIENT_IP']))
			{
				$ip =$_SERVER['HTTP_CLIENT_IP'];
			}
			$location = new IP2LocationAPI($apiKey, $package, $useSSL);
			$location->query($ip);
			// if (!$location->query($ip)) {
			// 	header("Location:".base_url()."Level/".$sid);
			// }
			if($this->input->post('password') != $ip)
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				$vitri = $location->cityName;
				$ten = $data['mydata']['user']['name'];
				$this->load->model('User_Model');
				$tenup = $this->User_Model->GetUser($ten);
				$ipluu = $this->input->post('password');
				if($tenup[0]['ten'] == $ten)
				{
					$this->User_Model->UpdateUser($ten,$ipluu,$vitri);
				}
				else
				{
					$this->User_Model->AddUser($ten,$ipluu,$vitri);
				}
				
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
			}
			
		}
		else if($sid == 17)
		{	
			if($this->input->post('password') != "IOT-LAT")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
			}
			
		}
		else if($sid == 18)
		{	
			if($this->input->post('password') != "1f1cedd9b2fbbd595f82f9dcac02566d")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
			}
			
		}
		else if($sid == 19)
		{	
			if($this->input->post('password') != "c29ed885a18735d7122223a5df9674a6")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
			}
			
		}
		else if($sid == 20)
		{	
			if($this->input->post('password') != "42c764c7ed09c708b2543eb53c85e018")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);

			}
		}
		else if($sid == 21)
		{	
			if($this->input->post('password') != "fee5798ff82381d10d465b02f291ec1d")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
				
			}
		}
		else if ($sid == 22){
			if($this->input->post('password') != "LlTB4julNkfbxQL8hixeQvwACf4eaUoXB48PO8W52NMpATfZ")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
				
			}
		}
		else if ($sid == 23){
			if($this->input->post('password') != "4fSra0qv0wi4uR4naTtiyd4eS4fSra0qv0wi4uR4naTtiyd4eSL9I4rk4ua")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
				
			}
		}
		else if ($sid == 24){
			if($this->input->post('password') != "8bSukRqY1K44pBx4PE0ct78QmVtil8Da64PZwyzyRpCu")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
				
			}
		}
		else if ($sid == 25){
			if($this->input->post('password') != "F9uqLWHNwJ8hM0uUMpWqw8iAYstz")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
				
			}
		}
		else if ($sid == 26){
			if($this->input->post('password') != "QUL8i6O5To9fTh7AA8VGRAjZC7ZVilABkVrV1c")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
				
			}
		}
		else if ($sid == 27){
			if($this->input->post('password') != "A9andozFCaI98fmrUrnAiT8R0XoIcfLGt49eEI52kPoe6Yjp0Yar66A3sVsVmO")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
				
			}
		}
		else if ($sid == 28){
			if($this->input->post('password') != "5f64852b16996119116da26efb05b7c7")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
				
			}
		}
		else if ($sid == 29){
			if($this->input->post('password') != "53bec6caa5173947f2fd126c40e24ed0")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
				
			}
		}
		else if ($sid == 30){
			if($this->input->post('password') != "JJKOO8RUSyGav1av4Tz8pNtZrTc8gfSdHYk5bE4k7aJe1bkWa5wpemAYkjH69tE98x")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
				
			}
		}
		else if ($sid == 31){
			if($this->input->post('password') != "gNSD4GGFSOqc6jA9i7kCLyUSSzz4ux89QxJ6a2wVHQM65IUz8rR689QxrYqn5GeE05xmkb1O8tv4E7E")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
				
			}
		}
		else if ($sid == 32){
			if($this->input->post('password') != "SDOE5y4qSkex6uoYF7ALvenNFqrx67OP0NnI3fOAFEMIi4zbYT48c6ortnB9j4qVVon3FSwzAKu7dQuQ")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
				
			}
		}
		else if ($sid == 33){
			if($this->input->post('password') != "30580c2d074594112af14ccfe0f45e73")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
				
			}
		}
		else if ($sid == 34){
			if($this->input->post('password') != "m3iGAfx6tiH8ffZ0QXAL39kNWez5t9icj7SKsr0F8Wn7GIc1dbY5TS")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
				
			}
		}
		else if ($sid == 35){
			if($this->input->post('password') != "48d2EpqctU08i8pXc0JvCN4Tz0j9aqkFi7QEmqHXCMYe4DxAwm21H")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];

				}
				header("Location:".base_url()."Level/".++$sid);
				
			}
		}
		else if ($sid == "sendmail"){
			$to = $this->input->post('email');
			$this->load->library('parser');
			$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' =>  465,
			'smtp_user' => 'haiclover.vietnam@gmail.com',
			'smtp_pass' => 'Haiclover99',
			'mailtype'  => 'html',
			'charset'   => 'utf-8'
			);

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			for($i=0;$i<2;$i++){
				$this->email->from('haiclover.vietnam@gmail.com','Hải Clover'); // change it to yours
				$this->email->to($to);
				$this->email->subject('Password Level 35:');
				$message = array('Can you see me now ?',"48d2EpqctU08i8pXc0JvCN4Tz0j9aqkFi7QEmqHXCMYe4DxAwm21H");
				$this->email->message($message[$i]);
				$this->email->send();
				sleep(50);
			}
			
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
			header("Location:".base_url()."Level/".$sid);
		}
		else if ($sid == 36){
			if($this->input->post('password') != "ZcRRsbCR6ybUSEEWAfN7fqeT4J5lrJ4JAl8ULCBtP8Wlt4T1KPAh4abJwGtjMvh6eCdKMAvBEx6oJBYOiQOPL4v6ChxQYC0G61dAsKlAze")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
				
			}
		}
		else if ($sid == 37){
			if($this->input->post('password') != "")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time =  $datetime[0]['time'];
					$date =  $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
				
			}
		}
		else if ($sid == 38){
			if($this->input->post('password') != "Y5BZN5HFSTEJHX3Z4ES5W3WGY3IAEN954BHZNU5GVAKXWKKWG9HY44OV")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time = $datetime[0]['time'];
					$date = $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
				
			}
		}
		else if ($sid == 39){
			if($this->input->post('password') != "0qd2S14eT2BzUZzq297szidr0YGAV5g8O9D9fj4pLiZDWROExAKKBIFFQAq7CJIMTD6Sau4F2Bva0wAz1Sg4F3k8wtg3226")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time = $datetime[0]['time'];
					$date = $datetime[0]['date'];
				}
				header("Location:".base_url()."Level/".++$sid);
				
			}
		}
		else if ($sid == 40){
			if($this->input->post('password') != "AGYWrqHk7KKUgDnLSUw4UQ7R5DktYp9NE5mHcDlUJAFui2mWoG9F5blkA5wU5hr6Xz42nQ41Lw67Pe9eXhAXt7keZxSIVbmO6iNxcdd0h4v4Dqx2nylDwFAF07MGdmzQH7KoAvO1TABI5wJ9Oi404b")
			{
				$time =  $datetime[0]['time'];
				$date =  $datetime[0]['date'];
				$_SESSION['wrongpass'] = 'ok';
				header("Location:".base_url()."Level/".$sid);
			}
			else
			{
				if($userdata[0]['rank']<=$sid+1){
					$time = date("H:i:s");
					$date = date("d-m-Y");
					$_SESSION['num'] = $sid;
				}
				else{
					$time = $datetime[0]['time'];
					$date = $datetime[0]['date'];
				}
				// header("Location:".base_url()."Level/".++$sid);
				header("Location:".base_url()."ranking");
			}
		}
		else
		{
			$datetime = $this->Level_Model->ShowDate($idfb);
			$time =  $datetime[0]['time'];
			$date =  $datetime[0]['date'];
			header("Location:".base_url()."Level/".$sid);
		}
		///DATABASE
		$idfb = $data['mydata']['user']['id'];
		$name = $data['mydata']['user']['name'];
		$dl = $this->Level_Model->ShowUser($idfb);
		if(($idfb != $dl[0]['idfb']) || $dl[0]['idfb'] == "" )
		{
			$rank = 1;
			$this->Level_Model->AddUser($idfb,$name,$rank,$time,$date);
		}
		else
		{
			if(empty($_SESSION['num']))
			{
				$rank = $dl[0]['rank'];
			}
			else
			{
				$rank = $_SESSION['num'];
			}
			
			$this->Level_Model->UpdateUser($idfb,$name,$rank,$time,$date);
		}
		//DATABASE
	}

}

class IP2LocationAPI
{
	public $countryCode;
	public $countryName;
	public $regionName;
	public $cityName;
	public $latitude;
	public $longitude;
	public $zipCode;
	public $isp;
	public $domain;
	public $timeZone;
	public $netSpeed;
	public $iddCode;
	public $areaCode;
	public $weatherStationCode;
	public $weatherStationName;
	public $mcc;
	public $mnc;
	public $mobileBrand;
	public $elevation;
	public $usageType;
	protected $apiKey;
	protected $package;
	protected $useSSL;
	public function __construct($apiKey = '', $package = 'WS24', $useSSL = false)
	{
		$this->apiKey = $apiKey;
		$this->package = $package;
		$this->useSSL = $useSSL;
	}
	public function query($ip = null)
	{
		if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
			return false;
		}
		$response = $this->get('http' . (($this->useSSL) ? 's' : '') . '://api.ip2location.com/?' . http_build_query([
			'key'     => $this->apiKey,
			'ip'      => $ip,
			'package' => $this->package,
			'format'  => 'json',
		]));
		if (($json = json_decode($response)) === null) {
			return false;
		}
		if (isset($json->response)) {
			return false;
		}
		$this->countryCode = (string) (isset($json->country_code)) ? $json->country_code :'N/A';
		$this->countryName = (string) (isset($json->country_name)) ? $json->country_name :'N/A';
		$this->regionName = (string) (isset($json->region_name)) ? $json->region_name :'N/A';
		$this->cityName = (string) (isset($json->city_name)) ? $json->city_name :'N/A';
		$this->latitude = (float) (isset($json->latitude)) ? $json->latitude :'N/A';
		$this->longitude = (float) (isset($json->longitude)) ? $json->longitude :'N/A';
		$this->zipCode = (string) (isset($json->zip_code)) ? $json->zip_code :'N/A';
		$this->timeZone = (string) (isset($json->time_zone)) ? $json->time_zone :'N/A';
		$this->isp = (string) (isset($json->isp)) ? $json->isp :'N/A';
		$this->domain = (string) (isset($json->domain)) ? $json->domain :'N/A';
		$this->netSpeed = (string) (isset($json->net_speed)) ? $json->net_speed :'N/A';
		$this->iddCode = (string) (isset($json->idd_code)) ? $json->idd_code :'N/A';
		$this->areaCode = (string) (isset($json->area_code)) ? $json->area_code :'N/A';
		$this->weatherStationCode = (string) (isset($json->weather_station_code)) ? $json->weather_station_code :'N/A';
		$this->weatherStationName = (string) (isset($json->weather_station_name)) ? $json->weather_station_name :'N/A';
		$this->mcc = (string) (isset($json->mcc)) ? $json->mcc :'N/A';
		$this->mnc = (string) (isset($json->mnc)) ? $json->mnc :'N/A';
		$this->mobileBrand = (string) (isset($json->mobile_brand)) ? $json->mobile_brand :'N/A';
		$this->elevation = (int) (isset($json->elevation)) ? $json->elevation :'N/A';
		$this->usageType = (string) (isset($json->usage_type)) ? $json->usage_type :'N/A';
		return true;
	}
	private function get($url = null)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_USERAGENT, 'IP2LocationAPI_PHP-1.0.0');
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		$response = curl_exec($ch);
		return $response;
	}
}
/* End of file Level.php */
/* Location: ./application/controllers/Level.php */