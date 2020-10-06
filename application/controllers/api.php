<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mapi');
	}

	public function lihatsetpoint()
	{
		$data['datasetpoint'] = $this->Mapi->getcurrenttracker();
		$this->tampil('view_setpoint',$data);
		// return $datasetpoint;
	}

	public function getsetpoint($dataapi)
	{
		$string = $dataapi;//string yang didapat dari aktuator
		$hasil = explode("X", $string);//dipecah menjadi beberapa bagian delimiter menggunakan X
		$no_aktuator = $hasil[4];
		$sudut_azimuth = $hasil[2];
		$sudut_elevasi = $hasil[3];
		$elevasi = $hasil[0];
		$azimuth = $hasil[1];

		$datalogaktuator = array(
			'no_aktuator' => $no_aktuator,
			'elevasi' => $elevasi,
			'azimuth' =>$azimuth,
			'sudut_elevasi' => $sudut_elevasi,
			'sudut_azimuth' =>$sudut_azimuth
		);
		$insert = $this->Mapi->datalogaktuator($datalogaktuator);//tambah log tracker
		$get= $this->Mapi->getcurrenttracker();
		$setpoint = array( 
			'elevasi' => $get['elevasi'], 
			'azimuth' => $get['azimuth'],
			'sudut_elevasi' => $get['sudut_elevasi'], 
			'sudut_azimuth' => $get['sudut_azimuth']);
		echo implode("X", $setpoint);
		return $setpoint;
	}

	public function update($dataapi)
	{
			$string = $dataapi;//string yang didapat dari tracker
			$hasil = explode("X", $string);//dipecah menjadi beberapa bagian delimiter menggunakan X
			$rataatas = $hasil[0];
			$ratabawah = $hasil[1];
			$ratakiri = $hasil[2];
			$ratakanan = $hasil[3];
			$sudut_azimuth = $hasil[4];
			$sudut_elevasi = $hasil[5];
			$elevasi = $hasil[6];
			$azimuth = $hasil[7];
			
			$errorvert=abs($rataatas-$ratabawah);
			$errorhor=abs($ratakiri-$ratakanan);

			$data = array(
				'rataatas' => $rataatas,
				'ratabawah' => $ratabawah,
				'ratakiri' => $ratakiri,
				'ratakanan' => $ratakanan,
				'ratabawah' => $ratabawah,
				'errorvert' => $errorvert,
				'errorhor' => $errorhor,
				'elevasi' => $elevasi,
				'azimuth' =>$azimuth,
				'sudut_elevasi' => $sudut_elevasi,
				'sudut_azimuth' =>$sudut_azimuth,
				'waktu' =>null
			);
			$datalogtracker = array(
				'elevasi' => $elevasi,
				'azimuth' =>$azimuth,
				'sudut_elevasi' => $sudut_elevasi,
				'sudut_azimuth' =>$sudut_azimuth
			);
			$datalogsensor = array(
				'rataatas' => $rataatas,
				'ratabawah' => $ratabawah,
				'ratakiri' => $ratakiri,
				'ratakanan' => $ratakanan,
				'ratabawah' => $ratabawah,
				'errorvert' => $errorvert,
				'errorhor' => $errorhor,
				'waktu' =>null
			);
			$update = $this->Mapi->update($data);//update grafik realtime
			$insert = $this->Mapi->addlogtracker($datalogtracker);//tambah log tracker
			$insert = $this->Mapi->addlogsensor($datalogsensor);//tambah log sensor
		}
	}

	/* End of file  */
/* Location: ./application/controllers/ */