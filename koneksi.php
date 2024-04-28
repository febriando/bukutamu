<?php 

$koneksi = mysqli_connect("localhost","root","","bukutamu");
$conn = mysqli_connect("localhost","root","","bukutamu");

// Check connection
if (mysqli_connect_error()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>