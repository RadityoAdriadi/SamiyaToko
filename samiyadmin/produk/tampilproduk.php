<?php 
$dataproduk = $produk->tampil_produk();
	// echo "<pre>";
	// print_r($dataproduk);
	// echo "</pre>";
?>
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="text-center">Data Produk</h3>
	</div>
	<div class="panel-body">
		<table class="table table-responsive data"> 
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Produk</th>
					<th>Nama Kategori</th>
					<th>Harga Produk</th>
					<th>Berat Produk</th>
					<th>Stok</th>
					<th>Foto Produk</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($dataproduk as $key => $value): ?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td><?php echo $value['nama_produk']; ?></td>
						<td><?php echo $value['nama_kategori']; ?></td>
						<td><?php echo $value['harga_produk']; ?></td>
						<td><?php echo $value['berat_produk']; ?></td>
						<td><?php echo $value['stok_produk']; ?></td>
						<td>
							<img src="../foto_produk/crop_<?php echo $value['foto_produk'];?>" width="100">
						</td>
						<td>
							<a href="index.php?halaman=hapusproduk&id=<?php echo $value['id_produk']; ?>" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></a>
							<a href="index.php?halaman=ubahproduk&id=<?php echo $value['id_produk']; ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
							<a href="index.php?halaman=tambahfotoproduk&id=<?php echo $value['id_produk']; ?>" class="btn btn-info btn-sm" title="Tambah Foto"><i class="fas fa-plus"></i></a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah produk</a>
	</div>
</div>