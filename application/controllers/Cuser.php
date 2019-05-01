<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuser extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		
	}

	public function index()
	{
		$data['judul']= "Daftar User";
		$this->load->view('daftar_user',$data);
	}
}