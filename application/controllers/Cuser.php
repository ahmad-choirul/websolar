<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuser extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Muser');
		$this->load->model('Mlogin');
	}

	public function index()
	{
		$data['judul']= "Daftar User";
		$data['listuser'] = $this->Muser->get_all_user();
		$this->load->view('template/head',$data);
		$this->load->view('template/topbar');
		$this->load->view('template/sidebar');
		$this->load->view('daftar_user',$data);
		$this->load->view('template/js');
		$this->load->view('template/foot');
	}
	public function history_login()
	{
		$data['judul']= "history login";
		$data['daftarlogin'] = $this->Mlogin->get_historylogin();
		$this->load->view('template/head',$data);
		$this->load->view('template/topbar');
		$this->load->view('template/sidebar');
		$this->load->view('history_login',$data);
		$this->load->view('template/js');
		$this->load->view('template/foot');
	}
	public function inupdeluser()
	{
		$data['set'] = $this->input->post('set');
		$datapost['id'] = $this->input->post('id',true);
		$datapost['username'] = $this->input->post('username',true);
		$password = $this->input->post('password',true);
		$datapost['nama'] = $this->input->post('nama',true);

		if ($data['set']=='delete') {
			$this->Muser->deleteuser($datapost['id']);
		}
		if ($data['set']=='update') {
			if ($password=='') {
				$datapost['password'] = null;
			}else{
				$datapost['password'] = md5($password);
			}
			$this->Muser->updateuser($datapost);
		}
		if ($data['set']=='insert') {
			$datapost['level'] = 'user';
			$datapost['password'] = md5($password);
			$this->Muser->insertuser($datapost);
		}
		redirect('Cuser','refresh');
	}
}