<?php 
	$idp = $_GET['id'];
	$pelanggan->hapus_pelanggan($idp);
	echo "<script>alert('data terhapus');</script>";
	echo "<script>location='index.php?halaman=pelanggan';</script>";
?>