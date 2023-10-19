<?php  
$datatestimoni = $customer->ambil_testimoni();
// echo "<pre>";
// print_r($datatestimoni);
// echo "</pre>";

 ?>
<div class="panel panel-info">
	<div class="panel-heading"><h3 class="text-center">Halaman testimoni</h3></div>
	<div class="panel-body">
		<table class="table table-responsive data">
			<thead>
				<tr>
					<th>Nama</th>
					<th>Isi Testimoni</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($datatestimoni as $key => $value): ?>
				<tr>
					<td><?php echo $value['nama_pelanggan']; ?></td>
					<td><?php echo $value['isi']; ?></td>
					<td><?php echo $value['status']; ?></td>
					<td>
						<a href="index.php?halaman=hapustestimoni&id=<?php echo $value['id_testimoni'];?>" type="button" title="Hapus" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
						<a href="index.php?halaman=detailtestimoni&id=<?php echo $value['id_testimoni'];?>" title="detail" class="btn btn-info btn-sm"><i class="fas fa-search"></i></a>
					</td>
				</tr>
			    <?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>