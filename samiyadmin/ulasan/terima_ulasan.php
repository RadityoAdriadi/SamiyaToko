<?php 
	$id_ulasan = $_GET["id"];
	$admin->terima_ulasan($id_ulasan);
	echo "<script>location='index.php?halaman=ulasan';</script>";

 ?>