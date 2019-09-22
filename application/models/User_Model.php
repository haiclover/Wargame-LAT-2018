<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function AddUser($ten,$ipluu,$vitri)
	{
		$object = array(
			'ten'=>$ten,
			'ip'=>$ipluu,
			'vitri'=>$vitri
		);
		$this->db->insert('location', $object);
	}
	public function GetUser($ten)
	{
		$this->db->select('*');
		$this->db->where('ten', $ten);
		$data = $this->db->get('location');
		$data = $data->result_array();
		return $data;
	}
	public function UpdateUser($ten,$ipluu,$vitri)
	{
		$object = array(
			'ten'=>$ten,
			'ip'=>$ipluu,
			'vitri'=>$vitri
		);
		$this->db->where('ten', $ten);
		$this->db->update('location', $object);
	}

}

/* End of file User_Model.php */
/* Location: ./application/models/User_Model.php */