<?php 
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'config/db.php';
 
// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
 
// menyeleksi data admin dengan username dan password yang sesuai
$sql = "select * from tb_user where username='$username' and password=MD5('$password')";
 
// menghitung jumlah data yang ditemukan
$result = $conn->query($sql);
$row = $result->fetch_assoc();
 
if($row > 0){
	$_SESSION['username'] = $row['username'];
	$_SESSION['status'] = "login";
    header("location:index.php");
    // echo "berhasil";
}else{
    // echo "gagal";
	header("location:login.php?pesan=gagal");
}
?>