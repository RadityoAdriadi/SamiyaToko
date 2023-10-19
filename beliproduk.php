<?php 
include 'config/class.php';
$id_produk = $_GET['id'];
$jml = 1;

$pembelian->simpan_keranjang($id_produk,$jml);
echo "<script>location='keranjang.php';</script>";
?>