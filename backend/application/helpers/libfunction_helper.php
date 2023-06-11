<?php 

function theme()
{
	$url = base_url("sbadmin2");
	return $url;
}

function themes()
{
	$url = base_url("themes/crush-it");
	return $url;
}

function level($level)
{
	if($level == 1) { $label = "Admin"; }
	if($level == 2) { $label = "Staff"; }
	if($level == 3) { $label = "Customer"; }
	return $label;
}

function statusaktif($level)
{
	if($level == 1) { $label = "Aktif"; }
	else { $label = "Tidak Aktif"; }
	return $label;
}

function statuspembelian($int)
{
	if($int == 1) { $label = "<span class='badge badge-primary'>Pembelian Baru</span>"; }
	if($int == 2) { $label = "<span class='badge badge-success'>Pembayaran Valid</span>"; }
	return $label;
}

function statuspenjualan($int)
{
	if($int == 1) { $label = "<span class='badge badge-primary'>Penjualan Baru</span>"; }
	if($int == 2) { $label = "<span class='badge badge-success'>Penjualan Valid</span>"; }
	return $label;
}

function tgl($tgl)
{
	$tgl = explode("-", $tgl); //awalnya 2020-06-20
	return "$tgl[2]/$tgl[1]/$tgl[0]"; //jadi 20/06/2020
}

function bulan($tgl)
{
	$tgl = explode("-", $tgl); //awalnya 2020-06-20
	
	if($tgl[1] == "01" ) {$bln="Januari"; }
	if($tgl[1] == "02" ) {$bln="Februari"; }
	if($tgl[1] == "03" ) {$bln="Maret"; }
	if($tgl[1] == "04" ) {$bln="April"; }
	if($tgl[1] == "05" ) {$bln="Mei"; }
	if($tgl[1] == "06" ) {$bln="Juni"; }
	if($tgl[1] == "07" ) {$bln="Juli"; }
	if($tgl[1] == "08" ) {$bln="Agustus"; }
	if($tgl[1] == "09" ) {$bln="September"; }
	if($tgl[1] == "10" ) {$bln="Oktober"; }
	if($tgl[1] == "11" ) {$bln="November"; }
	if($tgl[1] == "12" ) {$bln="Desember"; }

	return "$bln $tgl[0]"; //jadi 20/06/2020
}


function nominal($int)
{
	return number_format($int,0,",",".");
}
function ongkir($string)
{
	$alamat=strtolower($string);
	if (strpos ($alamat,"jakarta")==true) 
	{
		$ongkir=20000;
	} else {
		$ongkir=40000;
	}
	return $ongkir;
}

?>


