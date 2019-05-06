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
		$this->load->view('viewchart/charterror');
	}
	public function charterror()
	{
		$this->load->view('viewchart/chartldr');
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