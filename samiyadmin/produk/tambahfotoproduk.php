<?php
$idproduk = $_GET["id"];
$dataproduk = $produk->ambil_produk($idproduk);
// echo "<pre>";
// print_r($dataproduk);
// echo "</pre>";
?>
<h3 class="text-center">Tambah Galeri Produk</h3>
<div class="panel panel-info">
	<div class="panel-body">
		<form method="post" enctype="multipart/form-data" class="form-horizontal">
			<div class="form-group">
				<label class="col-md-2 control-label">Nama Produk :</label>
				<div class="col-md-8">
					<input type="text" name="nama_produk" value="<?php echo $dataproduk["nama_produk"]; ?>" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Foto Produk :</label>
				<div class="col-md-8">
					<input type="file" name="foto_produk">
				</div>
			</div>
			<div class="col-md-8 col-md-offset-2">
				<button class="btn btn-primary" name="simpan">Simpan</button>
			</div>
		</form>

		<?php
			if (isset($_POST["simpan"]))
			{
				$produk->tambahfoto($_POST["nama_produk"],$_FILES["foto_produk"],$idproduk);
				echo "<script>alert('Berhasil Tersimpan');</script>";
				echo "<script>location='index.php?halaman=galeriproduk';</script>";
			}

		?>
	</div>
</div>