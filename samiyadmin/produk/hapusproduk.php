<?php 
	$id_produk = $_GET['id'];
	$dataproduk = $produk->ambil_produk($id_produk);
	$foto = $dataproduk["foto_produk"];
	unlink("../foto_produk/$foto");
	unlink("../foto_produk/crop_".$foto);

	$produk->hapus_produk($id_produk);
	echo "<script>alert('produk terhapus');</script>";
	echo "<script>location='index.php?halaman=produk';</script>";
?>