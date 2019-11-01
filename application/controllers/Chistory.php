<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chistory extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mapi');
	}

	public function index()
	{
		
	}
	public function history_sensor()
	{
		$data['judul']= "history sensor";
		$data['daftar'] = $this->Mapi->get_historysensor();
		$this->load->view('template/head',$data);
		$this->load->view('template/topbar');
		$this->load->view('template/sidebar');
		$this->load->view('history_sensor',$data);
		$this->load->view('template/js');
		$this->load->view('template/foot');
	}
	public function history_tracker()
	{
		$data['judul']= "history tracker";
		$data['daftar'] = $this->Mapi->get_historytracker();
		$this->load->view('template/head',$data);
		$this->load->view('template/topbar');
		$this->load->view('template/sidebar');
		$this->load->view('view_history_tracker',$data);
		$this->load->view('template/js');
		$this->load->view('template/foot');
	}
	public function history_aktuator()
	{
		$data['judul']= "history aktuator";
		$data['no_aktuator']=$this->input->post('no_aktuator', TRUE);
		$data['daftaraktuator'] = $this->Mapi->get_listaktuator();
		$data['daftar'] = $this->Mapi->get_historyaktuator($data['no_aktuator']);
		$this->load->view('template/head',$data);
		$this->load->view('template/topbar');
		$this->load->view('template/sidebar');
		$this->load->view('view_history_aktuator',$data);
		$this->load->view('template/js');
		$this->load->view('template/foot');
	}
}

/* End of file  */
/* Location: ./application/controllers/ */