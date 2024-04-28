<?php

session_start();
require "koneksi.php";

require_once("PHPMailer/PHPMailer.php");
require_once("PHPMailer/SMTP.php");
require_once("PHPMailer/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;

function redirectToIndex()
   {
   header("Location: ./isi_data.php");
   exit;
   }

   function sendMail($nama, $nik, $alamat, $n_hp, $pesan, $subject, $date)
   {
      echo "<h1>kjabsdkbasjkdbasdasdasdasd</h1>";
     include './configEmail.php';
   
     $mail = new PHPMailer();
     $mail->isSMTP();
     $mail->Host = "smtp.gmail.com";
     $mail->SMTPAuth = true;
     $mail->Username = $myemail;
     $mail->Password = $mypassword;
     $mail->Port = 587;
   
     $mail->setFrom($myemail, $nama);
     $mail->addReplyTo($pesan, $nama);
     $mail->addAddress($myemail);
   
     $mail->isHTML(true);
     $mail->Subject = $subject;
     $mail->Body = "<b>Nama:</b> {$nama}<br><b>NIK:</b> {$nik}<br><b>Alamat:</b> {$alamat}<br><b>No.HP:</b> {$n_hp}<br><br><b>Pesan:</b><br><br>
       {$pesan}<br><br><b>Date:</b> {$date}";
   
     if ($mail->send()) {
       $_SESSION["mail_success"] = true;
     } else {
       $_SESSION["mail_error"] = true;
     }
   
     redirectToIndex();
   }
   
   function start()
   {
     if (
       isset($_POST["nama"]) && !empty(trim($_POST["nama"]))
       && isset($_POST["pesan"]) && !empty(trim($_POST["pesan"]))
     ) {
   
       $nama = !empty($_POST["nama"]) ? $_POST["nama"] : "Not informed";
       $nik = $_POST['nik'];
       $alamat = $_POST['alamat'];
       $n_hp = $_POST['hp'];
       $pesan = trim(str_replace("\n", '<br />', $_POST["pesan"]));
       $subject = "Contact";
       $date = date("d/m/Y H:i");
   
       sendMail($nama, $nik, $alamat, $n_hp, $pesan, $subject, $date);
     } else {
       $_SESSION["mail_error"] = true;
       redirectToIndex();
     }
   }
   
   start();