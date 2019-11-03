<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cchart extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mapi');
	}

		private function accessrules($m, $t, $p, $f){
		if (in_array($m, $f)) {
			return call_user_func_array(array($t, $m), $p);
		}else{
			redirect('Clogin','refresh');
		}
	}

	public function _remap($method, $params){
		$level = $this->session->userdata('level');
		if($level=='admin'||$level=='user'){
			return $this->accessrules($method, $this, $params, array('index','charterror','charterror','char
				','ambildatasensor','datarealtime','historisensor','lihatsudutaktuator','lihatsuduttracker','chartpergerakantracker','chartpergerakanaktuator','lihatsensor','ambildatatracker'));
		}else{
			redirect('Clogin','refresh');
		}
	}
	public function index(){
	}

	public function charterror(){
		$data['arraylog'] = $this->Mapi->get_datalogsensor();
		$this->load->view('viewchart/chartldr',$data);
	}
	public function charttabelerror(){
		$this->load->view('viewchart/charttabelerror');
	}
	public function ambildatasensor(){	
		$datarealtime=$this->Mapi->getdatarealtimesensor();
		echo $datarealtime;
		return $datarealtime;
	}
	
	public function datarealtime(){
		// $data['arraylog'] = $this->Mapi->getdatalog();
		$data['judul']= "Beranda";
		$this->tampil('chart_realtime',$data);
	}
	public function historisensor(){
		$data['judul']= "data log error";
		$data['arraylog'] = $this->Mapi->getdatalog();
		$this->tampil('tabel_histori',$data);
	}

	public function lihatsudutaktuator(){
		$data['judul']= "Chart aktuator";
		$data['arrayaktuator'] = $this->Mapi->getdatapergerakanaktuator();
		$this->tampil('chart_aktuator',$data);
	}
	public function lihatsuduttracker(){
		$data['judul']= "grafik Tracker";
		$this->tampil('chart_tracker',$data);
	}
	public function chartpergerakantracker(){
		$data['arraylog'] = $this->Mapi->getdatapergerakantracker();
		$this->load->view('viewchart/charttracker',$data);
	}
	public function chartpergerakanaktuator(){
		$data['arraylog'] = $this->Mapi->getdatapergerakanaktuator();
		$this->load->view('viewchart/charttracker',$data);
	}
	public function lihatsensor(){
		$data['arraysensor'] = $this->Mapi->getdatasensor();
		$this->tampil('chart_sensor',$data);
	}
	public function ambildatatracker(){	
		$angka=$this->Mapi->getdatapergerakantrackerjson();
		echo $angka;
		return $angka;
	}
}

/* End of file Cchart.php */
/* Location: ./application/controllers/Cchart.php */