<?php

// session start

session_start();

// hilangkan session yang sudah di set


unset($_SESSION['id']);
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['nama_pengguna']);

session_destroy();

echo"<script>
    alert('Anda telah keluar dari halaman Administrator!')
    document.location = 'login.php';
    </script>";