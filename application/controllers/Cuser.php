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
			if ($this->Muser->deleteuser($datapost['id'])){
				$this->session->set_flashdata('succesinsert','berhasil insert data');
			}
		}else{
			$this->session->set_flashdata('failinsert', 'password anda kosong');
		}

		if ($data['set']=='update') {
			if ($password=='') {
				$datapost['password'] = null;
			}else{
				$datapost['password'] = md5($password);
			}
			if ($this->Muser->updateuser($datapost)){
				$this->session->set_flashdata('succesinsert','berhasil update data');
			}else{
				$this->session->set_flashdata('failinsert', 'gagal update data');
			}
		}
		if ($data['set']=='insert') {
			if ($password!='') {
				$datapost['level'] = 'user';
				$datapost['password'] = md5($password);
				$this->Muser->insertuser($datapost);
				$this->session->set_flashdata('succesinsert','berhasil insert data');
			}elseif(strlen($datapost['password'])<6){
				$this->session->set_flashdata('failinsert', 'password anda terlalu pendek');
			}else{
				$this->session->set_flashdata('failinsert', 'password anda kosong');
			}
		}
		redirect('Cuser','refresh');

	}
	public function profile()
	{
		$id = $this->session->userdata('id');
		$data = $this->Muser->getdataakun($id);
		$this->tampil('profile',$data);
	}
	public function updateprofil()
	{
		$data['id'] = $this->input->post('id',true);
		$data['username'] = $this->input->post('username',true);
		$password = $this->input->post('password',true);
		if ($password=='') {
			$data['password'] = null;

		}else{
			$data['password'] = md5($password);
		}
		if ($this->Muser->updateuser($data)) {
			$this->session->set_flashdata('succesinsert','berhasil update data');
		}else{
			$this->session->set_flashdata('failinsert', 'gagal update data');
		}
		redirect('Cuser/Profile','refresh');
	}
}