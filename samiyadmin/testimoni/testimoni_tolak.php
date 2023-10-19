<?php 
	$id_testimoni = $_GET['id'];
	$admin->testimoni_tolak($id_testimoni);
	echo "<script>location='index.php?halaman=detailtestimoni';</script>";
 ?>