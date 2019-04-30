<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cchart extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Madd');
	}
	public function index()
	{
		$object['controller']=$this; 
		$this->load->view('chart',$object);
	}
	public function ambildatarataatas()
	{	
		$angka=$this->Madd->ambiljsonatas();
		echo $angka;
		return $angka;
	}
	public function ambildataratabawah()
	{	
		$angka=$this->Madd->ambiljsonbawah();
		echo $angka;
		return $angka;
	}
		public function ambildataratakiri()
	{	
		$angka=$this->Madd->ambiljsonkiri();
		echo $angka;
		return $angka;
	}
		public function ambildataratakanan()
	{	
		$angka=$this->Madd->ambiljsonkanan();
		echo $angka;
		return $angka;
	}
}

/* End of file Cchart.php */
/* Location: ./application/controllers/Cchart.php */