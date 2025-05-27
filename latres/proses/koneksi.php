<?php
    $hostname = "localhost"; //server database
    $username = "root"; //username database
    $password = ""; //tidak boleh ada spasi karena bernilai kosong
    $database = "skillora"; //nama database yang dibuat


    
    $connect=new mysqli($hostname, $username, $password, $database);
    if ($connect->connect_error){ //Mengecek apakah koneksi berhasil atau tidak.
        die('maaf koneksi gagal: '. $connect->connect_error); //Menghentikan program jika koneksi gagal dan menampilkan pesan error.
    }
?>
