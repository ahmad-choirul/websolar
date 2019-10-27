<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mapi');
	}

	public function index()
	{
		
	}
		public function lihatsetpoint()
	{
		$datasetpoint= $this->Mapi->getdatasetpoint();
		return $datasetpoint;
	}


	public function getsetpoint()
	{
		$get= $this->Mapi->getcurrenttracker();
		$setpoint = array('pitch' => $get['pitch'], 
			'roll' => $get['roll'], 
			'elevasi' => $get['elevasi'], 
			'azimuth' => $get['azimuth'] );
		$setpoint = json_encode($setpoint);
		echo $setpoint;
		return $setpoint;
	}

}

/* End of file  */
/* Location: ./application/controllers/ */