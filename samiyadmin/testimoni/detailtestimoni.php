<?php 
	$id_testimoni = $_GET['id'];
	$testimoni = $admin -> testimoni_status($id_testimoni);
	echo "<pre>";
	print_r($testimoni);
	echo "</pre>";
 ?>
 <table class="table table-responsive">
 		<tr>
 			<th>Status</th>
 			<td><?php echo $testimoni['status']; ?></td>
 		</tr>
 		<tr>
 			<th>Isi</th>
 			<td><?php echo $testimoni['isi']; ?></td>
 		</tr>
 </table>
 <a href="index.php?halaman=testimoni_terima&id=<?php echo $id_testimoni?>" class="btn btn-success">Terima</a>
 <a href="index.php?halaman=testimoni_tolak&id=<?php echo $id_testimoni?>" class="btn btn-danger">Tolak</a>