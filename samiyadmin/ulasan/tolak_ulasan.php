<?php
	$id_ulasan = $_GET["id"];
	$admin->tolak_ulasan($id_ulasan);
	echo "<script>location='index.php?halaman=ulasan';</script>";

?>