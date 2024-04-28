<?php

session_start();

if(empty($_SESSION['username']) or empty($_SESSION['password']) or empty($_SESSION['nama_pengguna'])){
    echo"<script>
    alert('Anda harus login terlebih dahulu!')
    document.location = 'login.php';
    </script>";
}
// Tentukan title dinamis berdasarkan halaman yang sedang dibuka
$page_title = ""; // Judul default

// Cek halaman mana yang sedang dibuka
$uri = $_SERVER['REQUEST_URI'];
if (strpos($uri, 'index.php') !== false) {
    $page_title = "Dashboard | Penerimaan Tamu PT NUSIRA";
} elseif (strpos($uri, 'statistik.php') !== false) {
    $page_title = "Statistik Data Pengunjung | Penerimaan Tamu PT NUSIRA";
} elseif (strpos($uri, 'rekapitulasi.php') !== false) {
    $page_title = "Rekapitulasi Data Pengunjung | Penerimaan Tamu PT NUSIRA";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title><?= $page_title; ?></title>
    <link rel="icon" href="assets/img/logo_kmt.png" type="image/x-icon"> 

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet" />
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/popper.min.js"></script>
	<script type="text/javascript" src="js/webcam.min.js"></script>
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- css tambahan  -->
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    <!-- <script type="text/javascript" src="js/bootstrap.min.js"></script> -->
    <style>
         #time {
            float: right;
        }
    </style>
  </head>

  <body id="page-top">