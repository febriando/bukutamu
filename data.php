<?php

    // melakukan koneksi 
    $connect = mysqli_connect('localhost', 'root', '', 'bukutamu');
    
    //menghitung jumlah pesan dari tabel pesan
    $query= mysqli_query($connect, "Select Count(id_tamu) as jumlah From tamu");
    
    //menampilkan data
    $hasil = mysqli_fetch_array($query);

    //membuat data json
    echo json_encode(array('jumlah' => $hasil['jumlah']));
    
    ?>