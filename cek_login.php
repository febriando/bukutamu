<?php

session_start();

include "koneksi.php";

@$pass = md5($_POST['password']);
@$username = mysqli_escape_string($koneksi, $_POST['username']);
@$password = mysqli_escape_string($koneksi, $pass);

$login = mysqli_query($koneksi, "SELECT *  FROM user where username = '$username' and password = '$password' and status ='administrator' ");

$data = mysqli_fetch_array($login);

// jika username dan password sesuai

if($data){
    $_SESSION['id'] =  $data['id'];
    $_SESSION['username'] =  $data['username'];
    $_SESSION['password'] =  $data['password'];
    $_SESSION['nama_pengguna'] =  $data['nama_pengguna'];

    // direct ke halaman admin
    header('location:index.php');

}else{
    echo"<script>
    alert('Login gagal, pastikan username dan password sesuai!')
    document.location = 'login.php';
    </script>";
}