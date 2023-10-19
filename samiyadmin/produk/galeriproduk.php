<?php 
	$galeriproduk = $produk->tampil_galeri();
	// echo "<pre>";
	// print_r($galeriproduk);
	// echo "</pre>";

?>

<h3 class="text-center">Galeri Produk</h3>
<table class="table table-responsive table-bordered table-hover" width="70%"> 
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Foto Produk</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($galeriproduk as $key => $value): ?>
		<tr>
			<th><?php echo $key+1 ?></th>
			<td><?php echo $value['nama_produk']; ?></td>
			<td>
				<img src="../galeri_produk/crop_<?php echo $value['foto_geleri_produk'];?>" width="100">
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>	
</table>