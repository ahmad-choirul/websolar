<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mapi');
	}

	public function lihatsetpoint()
	{
		$data['datasetpoint'] = $this->Mapi->getcurrenttracker();
		$this->tampil('view_setpoint',$data);
		// return $datasetpoint;
	}

	public function getsetpoint()
	{
		$get= $this->Mapi->getcurrenttracker();
		$setpoint = array('sudut_elevasi' => $get['sudut_elevasi'], 
			'sudut_azimuth' => $get['sudut_azimuth'], 
			'elevasi' => $get['elevasi'], 
			'azimuth' => $get['azimuth'] );
		// $setpoint = json_encode($setpoint);
		// echo $setpoint;
		echo implode(".", $setpoint);
		return $setpoint;
	}

	public function update()
	{
		$string = $this->input->get('data');
		$rataatas = $this->input->get('rataatas');
		$ratabawah = $this->input->get('ratabawah');
		$ratakiri = $this->input->get('ratakiri');
		$ratakanan = $this->input->get('ratakanan');
		$elevasi = $this->input->get('elevasi');
		$azimuth = $this->input->get('azimuth');
		$sudut_azimuth = $this->input->get('sudut_azimuth');
		$sudut_elevasi = $this->input->get('sudut_elevasi');
		$errorvert=abs($rataatas-$ratabawah);
		$errorhor=abs($ratakiri-$ratakanan);

		$data = array(
			'rataatas' => $rataatas,
			'ratabawah' => $ratabawah,
			'ratakiri' => $ratakiri,
			'ratakanan' => $ratakanan,
			'ratabawah' => $ratabawah,
			'errorvert' => $errorvert,
			'errorhor' => $errorhor,
			'elevasi' => $elevasi,
			'azimuth' =>$azimuth,
			'sudut_elevasi' => $sudut_elevasi,
			'sudut_azimuth' =>$sudut_azimuth,
			'waktu' =>null
		);
		$datalog = array(
			'elevasi' => $elevasi,
			'azimuth' =>$azimuth,
			'sudut_elevasi' => $sudut_elevasi,
			'sudut_azimuth' =>$sudut_azimuth
		);
		$update = $this->Mapi->update($data);//update grafik realtim
		$insert = $this->Mapi->addlog($datalog);//add log tracker
	}
}

/* End of file  */
/* Location: ./application/controllers/ */