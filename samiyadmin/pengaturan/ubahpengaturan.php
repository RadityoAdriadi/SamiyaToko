<?php 
	$id_pengaturan = $_GET['id'];
	$detail = $pengaturan->ambil_pengaturan($id_pengaturan);

	// echo "<pre>";
	// print_r($detail);
	// echo "</pre>";
 ?>
<h2>Ubah Pengaturan</h2>
<hr>

<form method="post">
	<div class="form-group">
		<label>Kolom</label>
		<input type="text" name="kolom" class="form-control" value="<?php echo $detail['kolom'];?>" readonly>
	</div>
	<div class="form-group">
		<label>Isi</label>
		<textarea class="form-control" rows="3" name="isi"><?php echo $detail['isi']; ?></textarea>
	</div>
	<button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php 
if(isset($_POST["ubah"]))
{
	$pengaturan->ubah_pengaturan($_POST["isi"],$id_pengaturan);
	echo "<script>alert('pengaturan berhasil dirubah');</script>";
	echo "<script>location='index.php?halaman=pengaturan';</script>";
}
?>
