<?php 
include 'koneksi.php';
$nama = $_POST['nama'];
$nik = $_POST['nik'];
$alamat = $_POST['alamat'];
$hp = $_POST['hp'];
$pesan = $_POST['pesan'];

$img = $_POST['img'];
if (strpos($img, 'data:image/png;base64') === 0) {
       
      $img = str_replace('data:image/png;base64,', '', $img);
      $img = str_replace(' ', '+', $img);
      $data = base64_decode($img);
      $file = 'upload/'.date("YmdHis").'.png';
	   $img_name=date("YmdHis").'.png';
      date_default_timezone_set('Asia/Jakarta');
	   $time=date('Y-m-d H:i:s');
   
      if (file_put_contents($file, $data)) {
         echo "The canvas was saved as $file.";
		 $sql="INSERT INTO tamu (nama,nik,alamat,hp,pesan,image,time)VALUES('$nama','$nik','$alamat','$hp','$pesan','$img_name','$time')";
		 if (mysqli_query($koneksi,$sql)) {
            echo "New record created successfully";
              } else {
             echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
         }
      } else {
         echo 'The canvas could not be saved.';
      }   
     
   }

?>