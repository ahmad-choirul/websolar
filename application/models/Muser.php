<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Muser extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function get_all_user()
	{
		return $this->db->get('admin')->result();
	}
public function deleteuser($id)
	{
		$this->db->delete('admin', array('id' => $id)); 
	}
	public function updateuser($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('admin', $data);
	}
	public function insertuser($data)
	{
		$this->db->insert('admin', $data);
	}
}

/* End of file Muser.php */
/* Location: ./application/models/Muser.php */