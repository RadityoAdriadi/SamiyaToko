<?php 
$datapembelian = $pembelian->tampil_pembelian();
?>
<!-- <pre><?php print_r($datapembelian); ?></pre> -->
<div class="panel panel-info">
	<div class="panel-heading"><h3 class="text-center">Data Pembelian</h3></div>
	<div class="panel-body">
		<table class="table table-responsive table-hover table-striped data">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal</th>
					<th>Pelanggan</th>
					<th>Status</th>
					<th>Total Pembelian</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($datapembelian as $key => $value): ?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td><?php echo $value['tanggal_pembelian']; ?></td>
						<td><?php echo $value['nama_pelanggan']; ?></td>
						<td><?php echo $value['status_pembelian']; ?></td>
						<td>Rp. <?php echo number_format($value['total_pembelian']) ; ?></td>
						<td>
							<a href="index.php?halaman=nota&id=<?php echo $value["id_pembelian"];?>" class="btn btn-info btn-sm">Nota</a>
							<a href="index.php?halaman=pembayaran&id=<?php echo $value["id_pembelian"];?>" class="btn btn-success btn-sm">Pembayaran</a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
