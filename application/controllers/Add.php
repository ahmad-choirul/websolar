<?php

class Add extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Madd');
	}

	public function update()
	{
		$string = $this->input->get('data');
		$rataatas = $this->input->get('rataatas');
		$ratabawah = $this->input->get('ratabawah');
		$ratakiri = $this->input->get('ratakiri');
		$ratakanan = $this->input->get('ratakanan');
		$kd = $this->input->get('kd');
		$tol = $this->input->get('tol');
		$errorvert=abs($rataatas-$ratabawah);
		$errorhor=abs($ratakiri-$ratakanan);

		$data = array(
			'rataatas' => $rataatas,
			'ratabawah' => $ratabawah,
			'ratakiri' => $ratakiri,
			'ratakanan' => $ratakanan,
			'ratabawah' => $ratabawah,
			'kd' => $kd,
			'tol' =>$tol,
			'errorvert' => $errorvert,
			'errorhor' => $errorhor
		);
		$update = $this->Madd->update($data);
		$insert = $this->Madd->addlog($data);
	}
}

/* End of file Add.php */
/* Location: ./application/controllers/Add.php */