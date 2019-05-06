<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csimulasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Msimulasi');
	}

	public function index()
	{
		$data['judul']= "Daftar simulasi";
		$data['listsimulasi'] = $this->Msimulasi->get_all_simulasi();
		$this->load->view('template/head',$data);
		$this->load->view('template/topbar');
		$this->load->view('template/sidebar');
		$this->load->view('daftar_simulasi',$data);
		$this->load->view('template/js');
		$this->load->view('template/foot');
	}
	public function inupdelsimulasi()
	{
		$data['set'] = $this->input->post('set');
		$datapost['id'] = $this->input->post('id',true);
		$datapost['nama'] = $this->input->post('nama',true);
		$datapost['watt'] = $this->input->post('watt',true);
		$datapost['lama'] = $this->input->post('lama',true);

		if ($data['set']=='delete') {
			$this->Msimulasi->deletesimulasi($datapost['id']);
		}
		if ($data['set']=='update') {
			$this->Msimulasi->updatesimulasi($datapost);
		}
		if ($data['set']=='insert') {
			$this->Msimulasi->insertsimulasi($datapost);
		}
		redirect('Csimulasi','refresh');
	}
}