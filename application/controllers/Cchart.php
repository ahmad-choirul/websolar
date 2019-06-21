<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cchart extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Madd');
	}
	public function index()
	{
	}
	public function chartsensorldr()
	{
		$data['arraylog'] = $this->Madd->getdatalog();
		$this->load->view('viewchart/charterror',$data);
	}

	public function charterror()
	{
		$data['arraylog'] = $this->Madd->getdatalog();
		$this->load->view('viewchart/chartldr',$data);
	}
	public function charttabelerror()
	{
		$this->load->view('viewchart/charttabelerror');
	}
		public function ambildataratatotal()
	{	
		$angka=$this->Madd->ambiljsontotal();
		echo $angka;
		return $angka;
	}
}

/* End of file Cchart.php */
/* Location: ./application/controllers/Cchart.php */