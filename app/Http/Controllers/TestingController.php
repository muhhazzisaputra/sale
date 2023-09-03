<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DNS1D;

class TestingController extends Controller
{
    
    public function index($type) {
        // $auth = auth()->user()->name;
        // dd($auth);
        // $tgl        = '2023-05-18 09:20:34';

        // $explodeTgl = explode(" ", $tgl);
        // $setTgl     = $explodeTgl[0];
        // $setWaktu   = $explodeTgl[1];

        // $tampilHari = true;
        // $nama_hari  = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
        // $nama_bulan = array (
        //           1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
        //           "September", "Oktober", "November", "Desember");

        // $tahun   = substr($setTgl,0,4);
        // $bulan   = $nama_bulan[(int)substr($setTgl,5,2)];
        // $tanggal = substr($setTgl,8,2);

        // $text = "";
        // if ($tampilHari) {
        //     $urutan_hari = date('w', mktime(0,0,0, substr($setTgl,5,2), $tanggal, $tahun));
        //     $hari        = $nama_hari[$urutan_hari];
        //     $text .= $hari.", ";
        // }

        // $text .= $tanggal ." ". $bulan ." ". $tahun;

        // echo $text;

        // $today = date('Ymd');
        // $date  = substr($today, 6);
        // $month = substr($today, 4, 2);
        // echo $date.$month;

        // echo auth()->user()->user_code;


        // $pdf = app('dompdf.wrapper')->loadView('test/print_pdf');

        // if ($type == 'stream') {
        //     return $pdf->stream('invoice.pdf');
        // }

        // if ($type == 'download') {
        //     return $pdf->download('invoice.pdf');
        // }

        // $data = [
        //     'title' => 'Welcome',
        //     'data'  => date('m/d/Y')
        // ];

        // $pdf = PDF::loadView('test/print_pdf', $data);

        // return $pdf->download('tes_pdf.pdf');
        
    }

    public function modal_load() {
        echo DNS1D::getBarcodeHTML('2907000289465', 'EAN13');

        // return view('test/modal_load');
    }

}
