<?php 
	$datakategori = $kategori->tampil_kategori();
	// echo "<pre>";
	// print_r($datakategori);
	// echo "</pre>";
 ?>
 <h2>Tambah Produk</h2>
 <form method="post" enctype="multipart/form-data">
 	<div class="form-group">
 		<label>Kategori</label>
 		<select class="form-control" name="kategori">
 			<option value="">-Pilih Kategori-</option>
 			<?php foreach ($datakategori as $key => $value): ?>
 			<option value="<?php echo $value['id_kategori']; ?>"><?php echo $value['nama_kategori']; ?></option>
 			<?php endforeach ?>
 		</select>
 	</div>
 	<div class="form-group">
 		<label>Nama Produk</label>
 		<input type="text" name="nama" class="form-control">
 	</div>
 	<div class="form-group">
 		<label>Harga Produk</label>
 		<input type="number" name="harga" class="form-control">
 	</div>
 	<div class="form-group">
 		<label>Berat Produk</label>
 		<input type="number" name="berat" class="form-control">
 	</div>
 	<div class="form-group">
 		<label>Deskripsi</label>
 		<textarea class="form-control ckeditor" name="deskripsi"></textarea>
 	</div>
 	<div class="form-group">
 		<label>Stok Produk</label>
 		<input type="number" name="stok" class="form-control">
 	</div>
 	<div class="form-group">
 		<label>Foto Produk</label>
 		<input type="file" name="foto" class="form-control">
 	</div>
 	<button class="btn btn-primary" name="simpan">Simpan</button>
 </form>

 <?php  
if (isset($_POST['simpan']))
{
	$produk->simpan_produk($_POST['kategori'],$_POST['nama'],$_POST['harga'],$_POST['berat'],$_POST['deskripsi'],$_POST['stok'],$_FILES['foto']);
	echo "<script>alert('Data Tersimpan')</script>"; 
	echo "<script>location='index.php?halaman=produk';</script>"; 
}
 ?>
