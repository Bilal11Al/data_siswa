<?php
$host="localhost";
$user="root";
$pass="1234";
$db="data_siswa";

$koneksi = mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){
    die("koneksi gagal".  mysqli_connect_error());
}else{
    // echo "koneksi berhasil";
}