<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mhitungmanual extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function get_all_data()
	{
		return $this->db->get('tbl_hitungmanual')->result();
	}
	public function getlasterror()
	{
		$hasil='kosong';
		$query = $this->db->query("SELECT * FROM `tbl_hitungmanual` ORDER by id desc limit 1");
		$row = $query->row_array();
		if (isset($row))
		{
			$hasil = $row['error'];
		}
		return $hasil;
	}
	public function inputdata($arrayinput)
	{
		$this->db->insert('tbl_hitungmanual', $arrayinput);
	}
	public function hapusdata($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_hitungmanual');
	}

	public function get_all_datapid()
	{
		return $this->db->get('tbl_hitungmanualpid')->result();
	}
	public function getlasterrorpid()
	{
		$hasil='kosong';
		$query = $this->db->query("SELECT * FROM `tbl_hitungmanualpid` ORDER by id desc limit 1");
		$row = $query->row_array();
		if (isset($row))
		{
			$hasil = $row['feedback'];
		}
		return $hasil;
	}
	public function inputdatapid($arrayinput)
	{
		$this->db->insert('tbl_hitungmanualpid', $arrayinput);
	}
	public function hapusdatapid($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_hitungmanualpid');
	}
}

/* End of file  */
/* Location: ./application/models/ */