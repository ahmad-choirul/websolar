<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msimulasi extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function get_all_simulasi()
	{
		return $this->db->get('tbl_simulasi')->result();
	}
public function deletesimulasi($id)
	{
		$this->db->delete('tbl_simulasi', array('id' => $id)); 
	}
	public function updatesimulasi($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('tbl_simulasi', $data);
	}
	public function insertsimulasi($data)
	{
		$this->db->insert('tbl_simulasi', $data);
	}
}

/* End of file Msimulasi.php */
/* Location: ./application/models/Msimulasi.php */