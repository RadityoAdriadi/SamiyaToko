<?php 
	include 'config/class.php';
	session_destroy();

	echo "<script>alert('Anda Keluar');</script>";
	echo "<script>location='index.php';</script>";
?>