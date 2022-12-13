<?php


require 'functions.php'; // ini berfungsi sebagai untuk mengkoneksikan file koneksi data base ke index.php

// UNTUK MENGAMBIL DATA DARI TABLE / QUERY DATA tb_barang

$barang = query("SELECT * FROM barangmasuk  ");

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

<link rel="stylesheet" href="css/styles.css" />
    <title>Halaman Admin</title>
</head>
<body>
<div id="page-content-wrapper">
<nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
    <div class="d-flex align-items-center">
        <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
        <h2 class="fs-2 m-0"> <i class="fas fa-share me-2"></i>Barang Masuk Gudang Baru</a></h2>

    </div>
</nav>


    <table class="table bg-white rounded shadow-sm  table-hover">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Kode</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Lantai</th>
            <th scope="col">Tanggal</th>

            <th scope="col">foto</th>
        </tr>
        </thead>';
      
      
        $i = 1;
       foreach ($barang as $cek){
        $html .= '<tr> 
        
        <td>' . $i++ .'</td>

        <td>'. $cek["kode"]  .'</td>
        <td>'. $cek["nama"]  .'</td>
        <td>'. $cek["jumlah"]  .'</td>
        <td>'. $cek["lantai"]  .'</td>
        <td>'. $cek["tgl"]  .'</td>
        <td><img src="img/'. $cek["foto"]  .'" width="20"></td>
        </tr>';

       }
     
   $html  .= ' </table>
   
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output();


