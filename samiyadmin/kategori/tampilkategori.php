<?php 
$datakategori = $kategori->tampil_kategori();

// echo "<pre>";
// print_r($datakategori);
// echo "</pre>";
?>
<div class="panel panel-info">
	<div class="panel-heading"><h3 class="text-center">Data Kategori</h3></div>
	<div class="panel-body">
		<table class="table table-responsive data">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($datakategori as $key => $value): ?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td><?php echo $value['nama_kategori']; ?></td>
						<td>
							<a href="index.php?halaman=hapuskategori&id=<?php echo $value['id_kategori']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
							<a href="index.php?halaman=ubahkategori&id=<?php echo $value['id_kategori']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<a href="index.php?halaman=tambahkategori" class="btn btn-primary">Tambah Kategori</a>
	</div>
</div>