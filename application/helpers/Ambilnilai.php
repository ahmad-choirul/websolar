<?php 
define('BASEPATH') or exit('no direct script access allowed');

function ambildata()
{
	$x['data']=$this->Mapi->ambil();
	return $x;
}

