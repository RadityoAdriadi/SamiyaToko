<?php 
	include 'config/class.php';
	$id_produk = $_GET['id'];
	$pembelian->hapus_keranjang($id_produk);
	echo "<script>location='keranjang.php';</script>";
 ?>