<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chitungpid extends CI_Controller {
	private $ts = 0.05;
	private $kp = 0.9;
	private $Ti = 0.3;
	private $Td = 1;
	private $hasiloutput="";
	private	$setpoint = 70.07;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mhitungmanual');
	}

	public function index()
	{
		$data['judul']= "Hitung Manual";
		$data['feedback'] = $this->input->post('feedback', TRUE);
		$data['listtotal'] = $this->Mhitungmanual->get_all_datapid();
		$data['hasiloutput'] = $this->hasiloutput;
		$data['setpoint'] = $this->setpoint;
		$this->tampil('view_hitungpid',$data);
	}
	public function inputerror()
	{
		$feedback = $this->input->post('feedback');
		$errorsebelum = $this->Mhitungmanual->getlasterrorpid($this->setpoint);
		$arrayinput = array('feedback' => $feedback,'errorsebelum' => $errorsebelum,'hasil' => $this->hitungpid($feedback,$errorsebelum) );
		$this->Mhitungmanual->inputdatapid($arrayinput);
		redirect('Chitungpid','refresh');
	}
	public function hapusdata($id)
	{
		$this->Mhitungmanual->hapusdatapid($id);
		redirect('Chitungpid','refresh');
	}
	public function hitungpid($feedback,$errorsebelum)
	{
		$error = $this->setpoint-$feedback;
		$this->hasiloutput.=("ts = ". $this->ts);
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("kp = ". $this->kp);
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("Ti = ". $this->Ti);
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("Td = ". $this->Td);
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("setpoint = ". $this->setpoint);
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("feedback = ". $feedback);
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("error = ". $error);
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("=============");
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("/Menghitung error Integral");
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("=============");
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("errorI = (((error + errorsebelum)/2)*ts)+errorsebelum");
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=('errorI = ((('.$error.' + '.$errorsebelum.')/2)*'.$this->ts.')+'.$errorsebelum);
		$errorI = ((($error + $errorsebelum)/2)*$this->ts)+$errorsebelum;
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("errorI = ". $errorI);
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("=============");
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("//Menghitung error Diferensial");
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("=============");
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("errorD = (error - errorsebelum)*ts");
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=('errorD = ('.$error.' - '.$errorsebelum.')/2)*'.$this->ts);
		$errorD =  (($error - $errorsebelum)/2)*$this->ts;
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("errorD = ". $errorD);
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("=============");
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("/// Kendali PID");
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("=============");
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("outP = Kp*error;");
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=('outP = ('.$this->kp.' * '.$error.')');
		$this->hasiloutput.=("\n");
		$outP =  $this->kp * $error;
		$this->hasiloutput.=("outP = ". $outP);
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("----------------");
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("outI =  (Kp/Ti)*errorI;");
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=('outI = ('.$this->kp.' / '.$this->Ti.')*'.$errorI);
		$this->hasiloutput.=("\n");
		$outI =  ($this->kp / $this->Ti)* $errorI;
		$this->hasiloutput.=("outI = ". $outI);
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("----------------");
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("outD = (Kp*Td)*errorD;");
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=('outD = ('.$this->kp.' * '.$this->Td.')*'.$errorD);
		$this->hasiloutput.=("\n");
		$outD =  ($this->kp *$this->Td)*$errorD;
		$this->hasiloutput.=("outD = ". $outD);
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("=============");
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("/// Output PID");
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("=============");
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=("outPID = outP + outI + outD;");
		$this->hasiloutput.=("\n");
		$this->hasiloutput.=('outPID = ('.$outP.' + '.$outI.'+'.$outD);
		$this->hasiloutput.=("\n");
		$outPID = $outP + $outI+$outD;
		$this->hasiloutput.=("outPID = ". $outPID);
		$this->hasiloutput.=("\n");
		$presentase = ($outPID/729) *100; 
		$this->hasiloutput.=("outPID presentase = ". $presentase." %");
		$this->hasiloutput.=("\n");
		$this->index();
		return $outPID;
	}
}

/* End of file Chitungpid.php */
/* Location: ./application/controllers/Chitungpid.php */