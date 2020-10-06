	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Cfuzzy extends CI_Controller {
		private $hasiloutput = "";
	private $vnb = 10; //value negatif big
	    private $vnm = 6; //value negatif medium
	    private $vns = 2; //value negatif small
	    private $vz = 0; //value zero
	    private $vps = -2; //value positif small
	    private $vpm = -6; //value positif medium
	    private $vpb = -10; //value positif big

	    private $nba = -125; //batas atas negatif big
	    private $nbb = -1024; //batas bawah negatif big
	    private $nma = -50; //batas atas negatif medium
	    private $nmb = -275; //batas bawah negatif medium
	    private $nsa = 10; //batas atas negatif small
	    private $nsb = -125; //batas bawah negatif small
	    private $za = 50; //batas atas zero
	    private $zb = -50; //batas bawah zero
	   private $psa = 125; //batas atas positif small
	   private $psb = 10; //batas bawah positif small
	   private $pma = 275; //batas atas positif medium
	   private $pmb = 50; //batas bawah positif medium
	   private $pba = 1024; //batas atas positif big
	   private $pbb = 125; //batas bawah positif big
	   private $domnb = -275;
	   private $domnm = -125;
	   private $domns = -50;
	   private $domz = 0;
	   private $domps = 50;
	   private $dompm = 125;
	   private $dompb = 275;
	   private $statrangeE = array();
	   private $statrangeDE  = array();

	   private $alfae  = array();
	   private $alfade = array();

	   private $combine  = array();

	   private $range  = array();

	   public function __construct()
	   {
	   	parent::__construct();
	   	$this->load->model('Mhitungmanual');
	   }

	   public function index()
	   {
	   	$data['judul']= "Hitung Manual";
	   	$data['listtotal'] = $this->Mhitungmanual->get_all_data();
	   	$data['hasiloutput'] = $this->hasiloutput;
	   	$this->tampil('view_hitungfuzzy',$data);
	   }
	   public function inputerror()
	   {
	   	$error = $this->input->post('error');
	   	$errorsebelum = $this->Mhitungmanual->getlasterror();
	   	if ($errorsebelum =='kosong') {
	   		$deltaerror=$error;
	   	}else{
	   		$deltaerror = $error-$errorsebelum;
	   	}
	   	if ($error>=-10&&$error<=10) {
	   		$arrayinput = array('error' => $error,'deltaerror' => $deltaerror,'hasil' => '0');
	   	}else{
	   		$arrayinput = array('error' => $error,'deltaerror' => $deltaerror,'hasil' => $this->hitungfuzzy($error,$deltaerror));
	   	}	 
	   	$this->Mhitungmanual->inputdata($arrayinput);

	   	redirect('Chitungfuzzy','refresh');
	   }
	   public function hapusdata($id)
	   {
	   	$this->Mhitungmanual->hapusdata($id);
	   	redirect('Chitungfuzzy','refresh');
	   }
	   public function hitungfuzzy($error,$deltaerror)
	   {
	   	//NB
	   	$outfuzzy = 0;
	   	if ($error<-275) {
	   		$outfuzzy=-10;
	   	}elseif ($error>-275&&$error<-125) {
	   		$hitung=(-125-$error)/(-125-(-275));
	   	}
	   }
	   private function cekrange($value,$stat)
	   {
	   	$count = 0;
	   	if ($this->pba > $value && $value >$this->pbb) {
	   		$stat[$count] = "pb";
	   		$this->range[$count] = $this->dompb;
	   		$count++;
	   	}
	   	if ($this->pma > $value && $value >$this->pmb) {
	   		$stat[$count] = "pm";
	   		$this->range[$count] = $this->dompm;
	   		$count++;
	   	}
	   	if ($this->psa > $value && $value >$this->psb) {
	   		$stat[$count] = "ps";
	   		$this->range[$count] = $this->domps;
	   		$count++;
	   	}
	   	if ($this->za > $value && $value > $this->zb) {
	   		$stat[$count] = "ze";
	   		$this->range[$count] = $this->domz;

	   		$count++;
	   	}
	   	if ($this->nba > $value && $value > $this->nbb) {
	   		$stat[$count] = "nb";
	   		$this->range[$count] =$this->domnb;
	   		$count++;
	   	}
	   	if ($this->nma > $value && $value > $this->nmb) {
	   		$stat[$count] = "nm";
	   		$this->range[$count] = $this->domnm;
	   		$count++;
	   	}
	   	if ($this->nsa > $value && $value > $this->nsb) {
	   		$stat[$count] = "ns";
	   		$this->range[$count] = $this->domns;
	   		$count++;
	   	}
	   	return $stat;
	   }
	   private function controlrulebase($error,$deltaerror)
	   {
	   	$rang = array("nb","nm","ns","ze","ps","pm","pb");
	   	$nilairang = array(-10, -6, -2, 0, 2, 6, 10);
	   	$a = array("nb", "nm", "nm", "ns", "nm", "ns", "ze");
	   	$b = array("nm", "nm", "ns", "ns", "ns", "ze", "ps");
	   	$c = array("nm", "ns", "ns", "ns", "ze", "ps", "pm");
	   	$d = array("ns", "ns", "ns", "ze", "ps", "ps", "ps");
	   	$e = array("nm", "ns", "ze", "ps", "ps", "ps", "pm");
	   	$f = array("ns", "ze", "ps", "ps", "ps", "pm", "pm");
	   	$g = array("ze", "ps", "pm", "ps", "pm", "pm", "pb");
	   	$namarange = array($a, $b, $c, $d, $e, $f, $g);
	   	$ang1 = 0;
	   	$ang2 = 0;
	   	for ($i = 0; $i < sizeof($rang); $i++) {
	   		if ($error==$rang[$i]) {
	   			$ang1 = $i;
	   		}
	   		if ($deltaerror==$rang[$i]) {
	   			$ang2 = $i;
	   		}
	   	}
	   	$nilairulebase = 0;
	   	for ($i = 0; $i < sizeof($rang); $i++) {
	   		if ($namarange[$ang1][$ang2]==$rang[$i]) {
	   			$nilairulebase = $nilairang[$i];
	   		}
	   	}
	   	return $nilairulebase;
	   }
	}

	/* End of file Cviewchart.php */
	/* Location: ./application/controllers/Cviewchart.php */