<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Level_Model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
	}
	public function AddUser($idfb,$name,$rank,$time,$date)
	{
		$object = array(
			'idfb'=>$idfb,
			'name'=>$name,
			'rank'=>$rank,
			'time'=>$time,
			'date'=>$date
		);
		$this->db->insert('user', $object);
		return $this->db->insert_id();
	}
	public function UpdateUser($idfb,$name,$rank,$time,$date)
	{
		$object = array(
			'idfb'=>$idfb,
			'name'=>$name,
			'rank'=>$rank,
			'time'=>$time,
			'date'=>$date
		);
		$this->db->where('idfb', $idfb);
		$this->db->update('user', $object);
	}
	public function ShowUser($idfb)
	{
		$this->db->select('*');
		$this->db->where('idfb', $idfb);
		$dl = $this->db->get('user');
		$dl = $dl->result_array();
		return $dl;
	}
	public function ShowAll()
	{
		$this->db->select('*');
		$this->db->order_by("rank desc,date asc,time asc");
		$dl = $this->db->get('user',100);
		$dl = $dl->result_array();
		return $dl;
	}
	public function ShowDate($idfb)
	{
		$this->db->select('time,date');
		$this->db->where('idfb', $idfb);
		$dl = $this->db->get('user');
		$dl = $dl->result_array();
		return $dl;
	}

}

/* End of file Level.php */
/* Location: ./application/models/Level.php */