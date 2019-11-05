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
			return $this->accessrules($method, $this, $params, array('index'
				,'ambildatasensor','datarealtime','lihatsudutaktuator','lihatsuduttracker','lihatsensor','ambildatatracker'));
		}else{
			redirect('Clogin','refresh');
		}
	}
	public function index(){
	}
	
	public function datarealtime(){
		// $data['arraylog'] = $this->Mapi->getdatalog();
		$data['judul']= "Beranda";
		$this->tampil('dashboard',$data);
	}	
	public function lihatsudutaktuator(){
		$data['judul']= "Chart aktuator";
		$data['arrayaktuator'] = $this->Mapi->getdatapergerakanaktuator();
		$this->tampil('chart_aktuator',$data);
	}
	public function lihatsuduttracker(){
		$data['judul']= "grafik Tracker";
		$data['arraylog'] = $this->Mapi->getdatapergerakantracker();
		$this->tampil('chart_tracker',$data);
	}
	public function lihatsensor(){
		$data['judul']= "grafik Sensor";
		$data['arraylog'] = $this->Mapi->getdatasensor();
		$this->tampil('chart_sensor',$data);
	}
	public function ambildatatracker(){	
		$angka=$this->Mapi->getdatapergerakantrackerjson();
		echo $angka;
		return $angka;
	}
	public function ambildatasensor(){	
		$datarealtime=$this->Mapi->getdatarealtimesensor();
		echo $datarealtime;
		return $datarealtime;
	}
}

/* End of file Cchart.php */
/* Location: ./application/controllers/Cchart.php */