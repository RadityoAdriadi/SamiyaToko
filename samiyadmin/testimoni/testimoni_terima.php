<?php
	$id_testimoni = $_GET['id'];
	$admin->testimoni_terima($id_testimoni);
	echo "<script>location='index.php?halaman=testimoni';</script>";

?>