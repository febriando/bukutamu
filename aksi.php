<?php 
include 'koneksi.php';
require_once("PHPMailer/PHPMailer.php");
require_once("PHPMailer/SMTP.php");
require_once("PHPMailer/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;

$nama = $_POST['nama'];
$nik = $_POST['nik'];
$alamat = $_POST['alamat'];
$hp = $_POST['hp'];
$pesan = $_POST['pesan'];
	   $img_name=date("YmdHis").'.png';
	   $time=date('Y-m-d H:i:s');

		 $sql="INSERT INTO tamu (nama,nik,alamat,hp,pesan,image,time)VALUES('$nama','$nik','$alamat','$hp','$pesan','$img_name','$time')";
		 if (mysqli_query($conn,$sql)) {
            echo "New record created successfully";
              } else {
             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
         }

// File upload
if ($_FILES['images']) {
   $errors = [];

   // Loop through each file
   foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
       $file_name = $_FILES['images']['name'][$key];
       $file_size = $_FILES['images']['size'][$key];
       $file_tmp = $_FILES['images']['tmp_name'][$key];
       $file_type = $_FILES['images']['type'][$key];

       // Check if file is uploaded without errors
       if ($file_size > 0) {
           $file_data = addslashes(file_get_contents($file_tmp)); // Get the file content
           $sql = "INSERT INTO images (file_name, file_data) VALUES ('$file_name', '$file_data')";
           if ($conn->query($sql) !== TRUE) {
               $errors[] = "Error uploading file: " . $conn->error;
           }
       } else {
           $errors[] = "Error uploading file: " . $_FILES['images']['error'][$key];
       }
   }

   // Display errors, if any
   if (!empty($errors)) {
       foreach ($errors as $error) {
           echo $error . "<br>";
       }
   } else {
       echo "Files uploaded successfully.";
   }
}
   
   function redirectToIndex()
   {
   header("Location: ./isi_data.php");
   exit;
   }

   function sendMail($nama, $nik, $alamat, $n_hp, $pesan, $subject, $date)
   {
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
     $mail->AddEmbeddedImage("rocks.png", "my-attach", "rocks.png");
     $mail->Body = "<b>Nama:</b> {$nama}<br><b>NIK:</b> {$nik}<br><b>Alamat:</b> {$alamat}<br><b>No.HP:</b> {$n_hp}<br><br><b>Pesan:</b><br><br>
       {$pesan}<br><br><b>Date:</b> {$date}";

    $uploadedImages = [];
    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        $target_file = sys_get_temp_dir() . '/' . basename($_FILES["images"]["name"][$key]);
        move_uploaded_file($_FILES["images"]["tmp_name"][$key], $target_file);
        $uploadedImages[] = $target_file;
    }

    foreach ($uploadedImages as $image) {
        $mail->addAttachment($image);
    }
   
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
   
?>