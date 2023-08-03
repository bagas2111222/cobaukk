<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan config database
include 'koneksi.php';
 
// menangkap data yang dikirim dari form login
$user = $_POST['user'];
$pass = $_POST['pass'];
 
 
// menyeleksi data user dengan user dan pass yang sesuai
$login = mysqli_query($koneksi,"select * from login where user='$user' and pass='$pass'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah user dan pass di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	// cek jika user login sebagai admin
	if($data['role']=="admin"){
 
		// buat session login dan user
		$_SESSION['user'] = $user;
		$_SESSION['role'] = "admin";
		// alihkan ke halaman dashboard admin
		header("location:halaman_admin.php");
 
	// cek jika user login sebagai pegawai
	}else if($data['role']=="kasir"){
		// buat session login dan user
		$_SESSION['user'] = $user;
		$_SESSION['role'] = "kasir";
		// alihkan ke halaman dashboard pegawai
		header("location:halaman_pegawai.php");
 
	// cek jika user login sebagai pengurus
	}else if($data['role']=="pengurus"){
		// buat session login dan user
		$_SESSION['user'] = $user;
		$_SESSION['role'] = "pengurus";
		// alihkan ke halaman dashboard pengurus
		header("location:halaman_pengurus.php");
 
	}else{
 
		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
	}	
}else{
	header("location:index.php?pesan=gagal");
}
 
?>