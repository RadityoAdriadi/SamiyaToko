<?php 
$datapengaturan = $pengaturan->tampil_pengaturan();
 // echo "<pre>";
 // print_r($datapengaturan);
 // echo "</pre>";
?>
<div class="panel-info">
	<div class="panel-heading"><h3 class="text-center">Pengaturan</h3></div>
	<div class="panel-body">
		<table class="table table-responsive table-hover table-striped data">
			<thead>
				<tr>
					<th>No</th>
					<th>Kolom</th>
					<th>Isi</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($datapengaturan as $key => $value): ?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td><?php echo $value['kolom']; ?></td>
						<td><?php echo $value['isi']; ?></td>
						<td>
							<a href="index.php?halaman=ubahpengaturan&id=<?php echo $value['id_pengaturan']; ?>" title="ubah" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>