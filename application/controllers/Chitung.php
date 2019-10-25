	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Chitung extends CI_Controller {
		public $hasiloutput = "";
	public $vnb = 10; //value negatif big
	    public $vnm = 6; //value negatif medium
	    public $vns = 2; //value negatif small
	    public $vz = 0; //value zero
	    public $vps = -2; //value positif small
	    public $vpm = -6; //value positif medium
	    public $vpb = -10; //value positif big

	    public $nba = -125; //batas atas negatif big
	    public $nbb = -1024; //batas bawah negatif big
	    public $nma = -50; //batas atas negatif medium
	    public $nmb = -275; //batas bawah negatif medium
	    public $nsa = 10; //batas atas negatif small
	    public $nsb = -125; //batas bawah negatif small
	    public $za = 50; //batas atas zero
	    public $zb = -50; //batas bawah zero
	   public $psa = 125; //batas atas positif small
	   public $psb = 10; //batas bawah positif small
	   public $pma = 275; //batas atas positif medium
	   public $pmb = 50; //batas bawah positif medium
	   public $pba = 1024; //batas atas positif big
	   public $pbb = 125; //batas bawah positif big
	   public $domnb = -275;
	   public $domnm = -125;
	   public $domns = -50;
	   public $domz = 0;
	   public $domps = 50;
	   public $dompm = 125;
	   public $dompb = 275;
	   public $statrangeE = array();
	   public $statrangeDE  = array();

	   public $alfae  = array();
	   public $alfade = array();

	   public $combine  = array();

	   public $range  = array();

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
	   	$this->tampil('view_hitung',$data);
	   }
	   public function inputerror()
	   {
	   	$error = $this->input->post('error');
	   	$errorsebelum = $this->Mhitungmanual->getlasterror();
	   	if ($errorsebelum =='kosong') {
	   		$deltaerror=$error;
	   	}else{
	   		$deltaerror = $errorsebelum-$error;
	   	}
	   	if ($error>=-10&&$error<=10) {
	   		$arrayinput = array('error' => $error,'deltaerror' => $deltaerror,'hasil' => '0');
	   	}else{
	   		$arrayinput = array('error' => $error,'deltaerror' => $deltaerror,'hasil' => $this->hitungfuzzy($error,$deltaerror));
	   	}	 
	   	$this->Mhitungmanual->inputdata($arrayinput);

	   	redirect('Chitung','refresh');
	   }
	   public function hapusdata($id)
	   {
	   	$this->Mhitungmanual->hapusdata($id);
	   	redirect('Chitung','refresh');
	   }
	   public function hitungfuzzy($error,$deltaerror)
	   {
	   	$this->statrangeE=$this->cekrange($error,$this->statrangeE);
	   	$hasiloutput = "";
	   	if ($this->statrangeE[1] != null) { //pengecekan apakah errornya masuk di satu atau dua himpunan (misal diatas 125 pasti Negatif Medium) yagn ini dua hipunan
	   		$this->hasiloutput.=("CE = ". $error);
	   		$this->hasiloutput.=("\n");
	   		$this->hasiloutput.=($this->statrangeE[0] ." = ");
	   		$this->alfae[0] = (double) abs(($error - $this->range[1])) / abs(($this->range[0] - $this->range[1]));
	   		$this->hasiloutput.=($this->alfae[0]);
	   		$this->hasiloutput.=("  ". $this->statrangeE[1] ." = ");
	   		$this->alfae[1] = (double) abs($error - $this->range[0]) / abs($this->range[0] - $this->range[1]);
	   		$this->hasiloutput.=($this->alfae[1]);
	   		$this->hasiloutput.=("\n");
	   	} else {
	   		$this->hasiloutput.=("CE = ". $error);
	   		$this->hasiloutput.=("\n");
	   		$this->hasiloutput.=($this->statrangeE[0] ." = ");
	   		$this->alfae[0] = (double) abs(($deltaerror - $this->range[1])) / abs(($this->range[0] - $this->range[1]));
	   		$this->hasiloutput.=(1);
	   		$this->hasiloutput.=("\n");
	   		$this->hasiloutput.=("==========================");
	   		$this->hasiloutput.=("\n");
	   	}
	   	$this->statrangeDE = $this->cekrange($deltaerror, $this->statrangeDE);
	   	if ($this->statrangeDE[1] != null) {
	   		$this->hasiloutput.=("DE = ". $deltaerror);
	   		$this->hasiloutput.=("\n");
	   		$this->hasiloutput.=($this->statrangeDE[0] ." = ");
	   		$this->alfade[0] = (double) abs(($deltaerror - $this->range[1])) / abs(($this->range[0] - $this->range[1]));
	   		$this->hasiloutput.=(($this->alfade[0]));
	   		$this->hasiloutput.=("  ". $this->statrangeDE[1] ." = ");
	   		$this->alfade[1] = (double) abs($deltaerror - $this->range[0]) / abs($this->range[0] - $this->range[1]);
	   		$this->hasiloutput.=(($this->alfade[1]));
	   		$this->hasiloutput.=("\n");
	   		$this->hasiloutput.=("==========================");
	   		$this->hasiloutput.=("\n");
	   	} else {
	   		$this->hasiloutput.=("DE = ". $deltaerror);
	   		$this->hasiloutput.=("\n");
	   		$this->hasiloutput.=($this->statrangeDE[0] ." = ");
	   		$this->alfade[0] = (double) abs(($deltaerror - $this->range[1])) / abs(($this->range[0] - $this->range[1]));
	   		$this->hasiloutput.=((1));
	   		$this->hasiloutput.=("\n");
	   		$this->hasiloutput.=("==========================");
	   		$this->hasiloutput.=("\n");
	   	}
	   	$totalkalicombine = 0;
	   	if ($this->statrangeE[1] != null) {
	            if ($this->statrangeDE[1] != null) {//e=2 de=2
	            	$count = 0;
	            	for ($i = 0; $i < 2; $i++) {
	            		for ($j = 0; $j < 2; $j++) {
	            			$this->combine[$count++] = max($this->alfae[$i], $this->alfade[$j]);
	            			$this->hasiloutput.=("\n");
	            			$this->hasiloutput.=($this->statrangeE[$i] ." U ". $this->statrangeDE[$j] ." = ");
	            			$this->hasiloutput.=(($this->alfae[$i]) ." U ". ($this->alfade[$j]) ." = ");
	            			$this->hasiloutput.=(($this->combine[$count - 1]) ."");
	            			$totalkalicombine += ($this->combine[$count - 1] * ($this->controlrulebase($this->statrangeE[$i], $this->statrangeDE[$j])));
	            			$this->hasiloutput.=("\n");
	            		}
	            	}
	            	$this->hasiloutput.=("==========================");
	            	$this->hasiloutput.=("\n");

	            } else {//e=2 de=1
	            	// System.out.println("e=2 dan de=1");
	            	for ($j = 0; $j < 2; $j++) {
	            		$this->combine[$j] = max($this->alfae[$j], $this->alfade[0]);
	            		$this->hasiloutput.=("\n");
	            		$this->hasiloutput.=($this->statrangeE[$j] ." U ". $this->statrangeDE[0] ." = ");
	            		$this->hasiloutput.=(($this->alfae[$j]) ." U ". ($this->alfade[0]) ." = ");
	            		$this->hasiloutput.=(($this->combine[$j]) ."");
	            		$totalkalicombine += ($this->combine[$j] * ($this->controlrulebase($this->statrangeE[$j], $this->statrangeDE[0])));
	            		$this->hasiloutput.=("\n");
	            	}
	            	$this->hasiloutput.=("==========================");
	            	$this->hasiloutput.=("\n");
	            }
	           
	        } else {//e=1 de=2
	            if ($deltaerror == 0) {//awal perhitungan saat de =0 
	            	$totalkalicombine = 0;
	            } else {
	            	for ($j = 0; $j < 2; $j++) {
	            		$this->combine[$j] = max($this->alfae[0], $this->alfade[$j]);
	            		$this->hasiloutput.=("\n");
	            		$this->hasiloutput.=($this->statrangeE[0] ." U ". $this->statrangeDE[$j] ." = ");
	            		$this->hasiloutput.=(($this->alfae[0]) ." U ". ($this->alfade[$j]) ." = ");
	            		$this->hasiloutput.=(($this->combine[$j]) ."");
	            		$totalkalicombine += ($this->combine[$j] * ($this->controlrulebase($this->statrangeE[0], $this->statrangeDE[$j])));
	            		$this->hasiloutput.=("\n");
	            	}
	            	$this->hasiloutput.=("==========================");
	            	$this->hasiloutput.=("\n");
	            }
	        }
	        $totaljumlahcombine = 0;
	        $this->hasiloutput.=("combine lihat");

	        for ($i = 0; $i < sizeof($this->combine); $i++) {
	        $this->hasiloutput.=($this->combine[$i]);
	        $this->hasiloutput.=("\n");

	        	$totaljumlahcombine += $this->combine[$i];
	        }
	        $this->hasiloutput.=("$totalkalicombine");
	        $this->hasiloutput.=(($totalkalicombine) ."");
	        $this->hasiloutput.=("\n");
	        $this->hasiloutput.=("totalcombine");
	        $this->hasiloutput.=(($totaljumlahcombine) ."");
	        $this->hasiloutput.=("\n");
	        $this->hasiloutput.=("nilai akhir");
	        $this->hasiloutput.=(($totalkalicombine / $totaljumlahcombine) ."");
	        $this->hasiloutput.=("\n");
	        $this->hasiloutput.=("==========================");
	        $this->statrangeE[0] = null;
	        $this->statrangeE[1] = null;
	        $this->statrangeE[0] = null;
	        $this->statrangeE[1] = null;
	        $this->index();
	        $hasiltotal =$totalkalicombine / $totaljumlahcombine;
	        if ($error<0) {
	        	$hasiltotal*-1;
	        }
	        return $hasiltotal;
	    }
	    public function cekrange($value,$stat)
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
	    public function controlrulebase($error,$deltaerror)
	    {
	    	$rang = array("nb","nm","ns","ze","ps","pm","pb");
	    	$nilairang = array(-10, -6, -2, 0, 2, 6, 10);
	    	$a = array("nb", "nb", "nb", "nb", "nm", "ns", "ze");
	    	$b = array("nb", "nb", "nm", "nm", "ns", "ze", "ps");
	    	$c = array("nb", "nm", "ns", "ns", "ze", "ps", "pm");
	    	$d = array("nb", "nm", "ns", "ze", "ps", "pm", "pb");
	    	$e = array("nm", "ns", "ze", "ps", "ps", "pb", "pb");
	    	$f = array("ns", "ze", "ps", "pm", "pb", "pb", "pb");
	    	$g = array("ze", "ps", "pm", "pb", "pb", "pb", "pb");
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