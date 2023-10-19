<h2>Ubah Probuk</h2>
<?php 
	$id_produk = $_GET['id'];
	$detail = $produk->ambil_produk($id_produk);
	$data_kategori = $kategori->tampil_kategori();
 ?>

 <form method="post" enctype="multipart/form-data">
 	<div class="form-group">
 		<label>Kategori</label>
 		<select class="form-control" name="kategori">
 			<option value="">-Pilih Kategori-</option>
 			<?php foreach ($data_kategori as $key => $value): ?>
 				<option value="<?php echo $value['id_kategori'] ?>" <?php 
 				if($value['id_kategori']==$detail['id_kategori']) {
 					echo "selected";}?>><?php echo $value['nama_kategori'] ?> </option>
 			<?php endforeach ?>
 		</select>
 	</div>
 	<div class="form-group">
 		<label>Nama Produk</label>
 		<input type="text" class="form-control" name="nama" value="<?php echo $detail['nama_produk']; ?>">
 	</div>
 	<div class="form-group">
 		<label>Harga Produk</label>
 		<input type="number" class="form-control" name="harga" value="<?php echo $detail['harga_produk']; ?>">
 	</div>
 	<div class="form-group">
 		<label>Berat Produk</label>
 		<input type="number" class="form-control" name="berat" value="<?php echo $detail['berat_produk']; ?>">
 	</div>
 	<div class="form-group">
 		<label>Deskripsi</label>
 		<textarea class="form-control ckeditor" name="deskripsi"><?php echo $detail['deskripsi']; ?></textarea>
 	</div>
 	<div class="form-group">
 		<img src="../foto_produk/<?php echo $detail['foto_produk']; ?>" width="200" >
 	</div>
 	<div class="form-group">
 		<input type="file"  name="foto" value="<?php echo $detail['foto_produk']; ?>">
 	</div>
 	<button class="btn btn-primary" name="ubah">Update</button>
 </form>

 <?php 
 if(isset($_POST['ubah']))
 {
 	$produk->ubah_produk($_POST['kategori'],$_POST['nama'],$_POST['harga'],$_POST['berat'],$_POST['deskripsi'],$_FILES["foto"],$_GET['id']);
 	echo "<script>alert('data berhasil diubah');</script>";
	echo "<script>location='index.php?halaman=produk';</script>";
 } 
 ?>