<?php 
$datapelanggan = $pelanggan->tampil_pelanggan();
?>

<!-- <pre><?php print_r($datapelanggan); ?></pre> -->
<h3 class="text-center">Data Pelanggan</h3>
<div class="panel panel-info">
	<div class="panel-body">
		<table class="table table-responsive table-striped data">
			<thead>
				<tr>
					<th>No</th>
					<th>Email</th>
					<th>Nama</th>
					<th>Telepon</th>
					<th>Alamat</th>
					<th>Foto</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($datapelanggan as $key => $value): ?>
					<tr>
						<td><?php echo $key +1; ?></td>
						<td><?php echo $value['email_pelanggan']; ?></td>
						<td><?php echo $value['nama_pelanggan']; ?></td>
						<td><?php echo $value['telp_pelanggan']; ?></td>
						<td><?php echo $value['alamat_pelanggan']; ?></td>
						<td><?php echo $value['foto_pelanggan']; ?></td>
						<td>
							<a href="index.php?halaman=ubahpelanggan&id=<?php echo $value['id_pelanggan']; ?>" class="btn btn-warning btn-sm" title="Edit" ><i class="fas fa-edit"></i></a> 
							<a href="index.php?halaman=hapuspelanggan&id=<?php echo $value['id_pelanggan']; ?>" class="btn btn-danger btn-sm" title="Hapus" ><i class="fas fa-trash"></i></a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<a href="index.php?halaman=tambahpelanggan" class="btn btn-primary">Tambah Pelanggan</a>
	</div>
</div>