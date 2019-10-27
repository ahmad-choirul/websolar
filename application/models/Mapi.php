<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapi extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getcurrenttracker()
	{
		$query = $this->db->query("SELECT * FROM `tabellogposisi` ORDER by waktu desc limit 1");
		return $query->result_array()[0];
	}

public function getdatasetpoint()
	{
		$datasetpoint = $this->db->query("SELECT * FROM `tabellogposisi` ORDER by waktu desc limit 1");
		return $datasetpoint->result_array()[0];
	}

}

/* End of file Mapi.php */
/* Location: ./application/models/Mapi.php */