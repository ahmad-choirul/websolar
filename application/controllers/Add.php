<?php

class Add extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Madd');
	}

	public function update($string)
	{
		list($rataatas, $ratabawah, $ratakiri, $ratakanan, $kd, $tol) = explode(":", $string);
		$errorvert=abs($rataatas-$ratabawah);
		$errorhor=abs($ratakiri-$ratakanan);

		$data = array(
			'rataatas' => $rataatas,
			'ratabawah' => $ratabawah,
			'ratakiri' => $ratakiri,
			'ratakanan' => $ratakanan,
			'ratabawah' => $ratabawah,
			'kd' => $kd,
			'tol' => $tol,	
			'errorvert' => $errorvert,
			'errorhor' => $errorhor
		);
		$update = $this->Madd->update($data);
	}
	public function addlog($value='')
	{
		# code...
	}
}

/* End of file Add.php */
/* Location: ./application/controllers/Add.php */