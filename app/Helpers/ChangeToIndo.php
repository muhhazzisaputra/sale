<?php

function tglIndo($tgl, $tampilHari = true, $tampilWaktu = true) {
	$explodeTgl = explode(" ", $tgl);
    $setTgl     = $explodeTgl[0];
    $setWaktu   = $explodeTgl[1];

    $tampilHari = true;
    $nama_hari  = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
    $nama_bulan = array (
              1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
              "September", "Oktober", "November", "Desember");

    $tahun   = substr($setTgl,0,4);
    $bulan   = $nama_bulan[(int)substr($setTgl,5,2)];
    $tanggal = substr($setTgl,8,2);

    $text = "";
    if ($tampilHari) {
        $urutan_hari = date('w', mktime(0,0,0, substr($setTgl,5,2), $tanggal, $tahun));
        $hari        = $nama_hari[$urutan_hari];
        $text .= $hari.", ";
    }

    $waktu = "";
    if($tampilWaktu) {
    	$waktu = $setWaktu;
    }

    $text .= $tanggal." ".$bulan." ".$tahun." ".$waktu;

    return $text;
}