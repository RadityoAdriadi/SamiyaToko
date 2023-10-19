<h2>Ubah Pelanggan</h2>
<?php 
$idp = $_GET['id'];
$datpel = $pelanggan->ambil_pelanggan($idp);
?>

<pre><?php print_r($datpel); ?></pre>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" class="form-control" value="<?php echo $datpel['email_pelanggan']; ?>">
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="Password" name="pass" class="form-control" value="<?php echo $datpel['password']; ?>">
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" name="nama" class="form-control" value="<?php echo $datpel['nama_pelanggan']; ?>">
	</div>
	<div class="form-group">
		<label>Telphone</label>
		<input type="text" name="telp" class="form-control" value="<?php echo $datpel['telp_pelanggan']; ?>">
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<textarea name="alamat" class="form-control"><?php echo $datpel['alamat_pelanggan']; ?></textarea>
	</div>
	<div class="form-group">
		<img src="../foto_pelanggan/<?php echo $datpel['foto_pelanggan']; ?>" width="300">
	</div>
	<div class="form-group">
		<label>Foto</label>
		<input type="file" name="foto" class="form-control"?>
	</div>
	<button class="btn btn-primary" name="simpan">Simpan</button>
</form>
<?php 
	if(isset($_POST['simpan']))
	{
		$pelanggan->ubah_pelanggan($_POST['email'],$_POST['pass'],$_POST['nama'],$_POST['telp'],$_POST['alamat'],$_FILES['foto'],$_GET['id']);
		echo "<script>alert('data berhasil diubah');</script>";
		echo "<script>location='index.php?halaman=pelanggan';</script>";
	}
 ?>