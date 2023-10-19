<?php 
$id_testi = $_GET['id'];
$customer -> hapus_testimoni($id_testi);
echo "<script>alert('data berhasil dihapus');</script>";
echo "<script>location='index.php?halaman=testimoni';</script>";

?>