<?php  
$idkategori = $_GET['id'];
$kategori->hapus_kategori($idkategori);

echo "<script>alert('data berhasil dihapus');</script>";
echo "<script>location='index.php?halaman=kategori';</script>";
 ?>