<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cviewchart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function realtime(){
		$data['arraylog'] = $this->Madd->getdatalog();
		$data['judul']= "Tampilan Pertama";
		$this->tampil('chart_realtime',$data);
	}
	public function historierror(){
		$data['judul']= "data log error";
		$data['arraylog'] = $this->Madd->getdatalog();
		$this->tampil('tabel_histori',$data);
	}

	
	public function lihatsudutaktuator(){
		// $data['arraylog'] = $this->Madd->getdatalog();
		$data['judul']= "Tampilan Pertama";
		$this->tampil('chart_aktuator',$data);
	}
	public function chartpergerakantracker(){
		$data['arraylog'] = $this->Madd->getdatapergerakantracker();
		$this->load->view('viewchart/charttracker',$data);
	}

}

/* End of file Cviewchart.php */
/* Location: ./application/controllers/Cviewchart.php */