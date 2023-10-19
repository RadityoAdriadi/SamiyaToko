 <?php 
 $id_ulasan = $_GET['id'];
 $ulasan = $admin->ulasan_status($id_ulasan);
 // echo "<pre>";
 // print_r($ulasan);
 // echo "</pre>";

 ?>
 <div class="col-md-6">
 	<img src="../foto_produk/crop_<?php echo $ulasan['foto_produk']; ?>" width="230">
 </div>
 <div class="col-md-6">
 	<div class="panel panel-primary">
 		<div class="panel-heading">
 		<h3><?php echo $ulasan["nama_produk"]; ?></h3>
 		</div>
 	</div>
 	<div class="panel-body">
 	<p><?php echo $ulasan["deskripsi"]; ?></p>
 	</div>
 </div>
 <table class="table table-responsive">
 	<thead>
 		<tr>
 			<th>isi ulasan</th>
 			<th>Rating</th>
 			<th>Status</th>
 		</tr>
 	</thead>
 	<tbody>
 		<tr>
 			<td><?php echo $ulasan['isi']; ?></td>
 			<td>
 				<?php  
 				for ($i=1; $i<=5; $i++)
 				{
 					$layak = $i <= $ulasan["rating"] ? "fa-yellow" : "";
 					echo "<i class='fa fa-star ".$layak."'></i>";
 				}
 				?>	
 			</td>
 			<td><?php echo $ulasan['status']; ?></td>
 		</tr>
 	</tbody>
 </table>
 <a href="index.php?halaman=terima_ulasan&id=<?php echo $id_ulasan?>" class="btn btn-success">Terima</a>
 <a href="index.php?halaman=tolak_ulasan&id=<?php echo $id_ulasan?>" class="btn btn-danger">Tolak</a>