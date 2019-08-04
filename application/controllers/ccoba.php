<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chitung extends CI_Controller {
$output = "";
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mhitungmanual');

		$vnb = 10; //value negatif big
    $vnm = 6; //value negatif medium
    $vns = 2; //value negatif small
    $vz = 0; //value zero
    $vps = -2; //value positif small
    $vpm = -6; //value positif medium
    $vpb = -10; //value positif big

    $nba = -125; //batas atas negatif big
    $nbb = -1024; //batas bawah negatif big
    $nma = -10; //batas atas negatif medium
    $nmb = -275; //batas bawah negatif medium
    $nsa = 0; //batas atas negatif small
    $nsb = -125; //batas bawah negatif small
    $za = 10; //batas atas zero
    $zb = -10; //batas bawah zero
    $psa = 125; //batas atas positif small
    $psb = 0; //batas bawah positif small
    $pma = 275; //batas atas positif medium
    $pmb = 10; //batas bawah positif medium
    $pba = 1024; //batas atas positif big
    $pbb = 125; //batas bawah positif big
    $domnb = -275;
    $domnm = -125;
    $domns = -10;
    $domz = 0;
    $domps = 10;
    $dompm = 125;
    $dompb = 275;

	}

	public function index()
	{
		$data['judul']= "Hitung Manual";
		$data['listtotal'] = $this->Mhitungmanual->get_all_data();
		$data['output'] = $this->$output;
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
        $hasilakhir=$this->hitungfuzzy($error,$deltaerror);
		$arrayinput = array('error' => $error,'deltaerror' => $deltaerror,'hasil' => $hasilakhir );
		$this->Mhitungmanual->inputdata($arrayinput);
		redirect('Chitung','refresh');
	}
	public function hapusdata($id)
	{
		$this->Mhitungmanual->hapusdata($id);
		redirect('Chitung','refresh');
	}
	public function hitungfuzzy($error,$deltaerror);
	{
		$statrangeE=$this->cekrange($error,$statrangeE);
		$output = "";
		if ($statrangeE[1] != null) {
			$output.=("CE = " + $error);
			$output.=("\n");
			$output.=($statrangeE[0] + " = ");
			$alfae[0] = (double) abs(($error - $range[1])) / abs(($range[0] - $range[1]));
			$output.=($alfae[0]);
			$output.=("  " + $statrangeE[1] + " = ");
			$alfae[1] = (double) abs($error - $range[0]) / abs($range[0] - $range[1]);
			$output.=(($alfae[1]);
				$output.=("\n");
			} else {
				$output.=("CE = " + $error);
				$output.=("\n");
				$output.=($statrangeE[0] + " = ");
				$alfae[0] = (double) abs(($deltaerror - $range[1])) / abs(($range[0] - $range[1]));
				$output.=(1);
				$output.=("\n");
				$output.=("==========================");
				$output.=("\n");
			}
			$statrangeDE = $this->cekrange($deltaerror, $statrangeDE);
			if ($statrangeDE[1] != null) {
				$output.=("DE = " + $deltaerror);
				$output.=("\n");
				$output.=($statrangeDE[0] + " = ");
				$alfade[0] = (double) abs(($deltaerror - $range[1])) / abs(($range[0] - $range[1]));
				$output.=(($alfade[0]));
				$output.=("  " + $statrangeDE[1] + " = ");
				$alfade[1] = (double) abs($deltaerror - $range[0]) / abs($range[0] - $range[1]);
				$output.=(($alfade[1]));
				$output.=("\n");
				$output.=("==========================");
				$output.=("\n");
			} else {
				$output.=("DE = " + $deltaerror);
				$output.=("\n");
				$output.=($statrangeDE[0] + " = ");
				$alfade[0] = (double) abs(($deltaerror - $range[1])) / abs(($range[0] - $range[1]));
				$output.=((1));
				$output.=("\n");
				$output.=("==========================");
				$output.=("\n");
			}
			$totalkalicombine = 0;
			if ($statrangeE[1] != null) {
            if ($statrangeDE[1] != null) {//e=2 de=2
            	$count = 0;
            	for ($i = 0; $i < 2; $i++) {
            		for ($j = 0; $j < 2; $j++) {
            			$combine[$count++] = max($alfae[$i], $alfade[$j]);
            			$output.=("\n");
            			$output.=($statrangeE[$i] + " U " + $statrangeDE[$j] + " = ");
            			$output.=(($alfae[$i]) + " U " + ($alfade[$j]) + " = ");
            			$output.=(($combine[$count - 1]) + "");
            			$totalkalicombine += ($combine[$count - 1] * ($this->controlrulebase($statrangeE[$i], $statrangeDE[$j])));
            			$output.=("\n");
            		}
            	}
            	$output.=("==========================");
            	$output.=("\n");

            } else {//e=2 de=1
            	System.out.println("e=2 dan de=1");
            	for ($j = 0; $j < 2; $j++) {
            		$combine[$j] = max($alfae[$j], $alfade[0]);
            		$output.=("\n");
            		$output.=($statrangeE[$j] + " U " + $statrangeDE[0] + " = ");
            		$output.=(($alfae[$j]) + " U " + ($alfade[0]) + " = ");
            		$output.=(($combine[$j]) + "");
            		$totalkalicombine += ($combine[$j] * ($this->controlrulebase($statrangeE[$j], $statrangeDE[0])));
            		$output.=("\n");
            	}
            	$output.=("==========================");
            	$output.=("\n");

            }
        } else {//e=1 de=2
            if ($deltaerror == 0) {//awal perhitungan saat de =0 
            	$totalkalicombine = 0;
            } else {
            	for ($j = 0; j < 2; j++) {
            		$combine[$j] = max($alfae[0], $alfade[$j]);
            		$output.=("\n");
            		$output.=($statrangeE[0] + " U " + $statrangeDE[$j] + " = ");
            		$output.=(($alfae[0]) + " U " + ($alfade[$j]) + " = ");
            		$output.=(($combine[$j]) + "");
            		$totalkalicombine += ($combine[$j] * ($this->controlrulebase($statrangeE[0], $statrangeDE[$j])));
            		$output.=("\n");
            	}
            	$output.=("==========================");
            	$output.=("\n");
            }
        }
        $totaljumlahcombine = 0;
        for ($i = 0; i < sizeof($combine); i++) {
        	$totaljumlahcombine += $combine[$i];
        }
        $output.=("$totalkalicombine");
        $output.=(($totalkalicombine) + "");
        $output.=("\n");
        $output.=("totalcombine");
        $output.=(($totaljumlahcombine) + "");
        $output.=("\n");
        $output.=("nilai akhir");
        $hasilakhir=$totalkalicombine / $totaljumlahcombine;
        $output.=(($hasilakhir) + "");
        $output.=("\n");
        $output.=("==========================");
        $statrangeE[0] = null;
        $statrangeE[1] = null;
        $statrangeE[0] = null;
        $statrangeE[1] = null;
        return $hasilakhir;
    }

    public function cekrange($value,$stat)
    {
    	$count = 0;
    	if ($pba > $value && $value > $pbb) {
    		$stat[$count] = "pb";
    		$$range[$count] = $dompb;
    		$count++;
    	}
    	if ($pma > $value && $value > $pmb) {
    		$stat[$count] = "pm";
    		$$range[$count] = $dompm;
    		$count++;
    	}
    	if ($psa > $value && $value > $psb) {
    		$stat[$count] = "ps";
    		$$range[$count] = $domps;
    		$count++;
    	}
    	if ($za > $value && $value > $zb) {
    		$stat[$count] = "ze";
    		$$range[$count] = $domz;

    		$count++;
    	}
    	if ($nba > $value && $value > $$nbb) {
    		$stat[$count] = "nb";
    		$$range[$count] = $domnb;
    		$count++;
    	}
    	if ($nma > $value && $value > $nmb) {
    		$stat[$count] = "nm";
    		$$range[$count] = $domnm;
    		$count++;
    	}
    	if ($nsa > $value && $value > $nsb) {
    		$stat[$count] = "ns";
    		$$range[$count] = $domns;
    		$count++;
    	}
    	return $stat;
    }
    public function controlrulebase($error,$deltaerror)
    {
    	
    	$rang = ("nb", "nm", "ns", "ze", "ps", "pm", "pb");
    	$nilairang = {-10, -6, -2, 0, 2, 6, 10);
	$a = ("nb", "nb", "nb", "nb", "nm", "ns", "ze");
	$b = ("nb", "nb", "nm", "nm", "ns", "ze", "ps");
	$c = ("nb", "nm", "ns", "ns", "ze", "ps", "pm");
	$d = ("nb", "nm", "ns", "ze", "ps", "pm", "pb");
	$e = ("nm", "ns", "ze", "ps", "ps", "pb", "pb");
	$f = ("ns", "ze", "ps", "pm", "pb", "pb", "pb");
	$g = ("ze", "ps", "pm", "pb", "pb", "pb", "pb");
	$namarange = {$a, $b, $c, $d, $e, $f, $g};
	$ang1 = 0, $ang2 = 0;
	for ($i = 0; $i < sizeof($rang); $i++) {
		if ($error==$rang[$i]) {
			$ang1 = $i;
		}
		if ($deltaerror==$rang[$i]) {
			$ang2 = $i;
		}
	}
	$nilairulebase = 0;
	for ($i = 0; $i < sizeof($rang); i++) {
		if ($namarange[$ang1][$ang2]==$rang[$i]) {
			$nilairulebase = $nilairang[$i];
		}
	}
	return $nilairulebase;
}
}

/* End of file Cviewchart.php */
/* Location: ./application/controllers/Cviewchart.php */