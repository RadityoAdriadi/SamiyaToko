<h2>Tambah Kategori</h2>
<form method="post">
	<div class="form-group">
		<label>Nama Kategori</label>
		<input type="text" class="form-control" name="nama">
	</div>
	<button class="btn btn-primary" name="simpan">Simpan</button>
</form>
<?php 
if(isset($_POST['simpan']))
{
	$kategori->simpan_kategori($_POST["nama"]);

	echo "<script>alert('Data Tersimpan');</script>";
	echo "<script>location='index.php?halaman=kategori';</script>";
}

 ?>
