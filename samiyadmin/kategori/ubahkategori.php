<?php 
	$idkategori = $_GET['id'];
	$hasil = $kategori->ambil_kategori($idkategori);

	echo "<pre>";
	print_r($hasil);
	echo "</pre>";
?>
<h3>Ubah Kategori</h3>
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Kategori</label>
		<input type="text" name="nama" class="form-control" value="<?php echo $hasil['nama_kategori']; ?>">
	</div>
	<button class="btn btn-primary" name="ubah">Update</button>
</form>
<?php
	if (isset($_POST['ubah'])) 
	{
		$kategori->ubah_kategori($_POST["nama"],$idkategori);
		echo "<script>alert('data berhasil dirubah');</script>";
		echo "<script>location='index.php?halaman=kategori';</script>";
	}
?>