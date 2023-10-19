<h2>Tambah Pelanggan</h2>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" class="form-control">
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="Password" name="pass" class="form-control">
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" name="nama" class="form-control">
	</div>
	<div class="form-group">
		<label>Telphone</label>
		<input type="text" name="telp" class="form-control">
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<textarea name="alamat" class="form-control"></textarea>
	</div>
	<div class="form-group">
		<label>Foto</label>
		<input type="file" name="foto" class="form-control">
	</div>
	<button class="btn btn-primary" name="simpan">Simpan</button>
</form>

<?php 
	if(isset($_POST['simpan']))
	{
		$pelanggan->simpan_pelanggan($_POST['email'],$_POST['pass'],$_POST['nama'],$_POST['telp'],$_POST['alamat'],$_FILES['foto']);
		echo "<script>alert('data tersimpan');</script>";
		echo "<script>location='index.php?halaman=pelanggan';</script>";
	}
?>
