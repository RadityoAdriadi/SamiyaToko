<?php 
include 'config/class.php'; 
$datakeranjang = $pembelian->tampil_keranjang();
?>
<!-- <pre>
	<?php print_r($datakeranjang); ?>
</pre> -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>WARUNGTRAINIT</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/owlcarousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="assets/owlcarousel/assets/owl.theme.default.min.css">
	<link rel="stylesheet" type="text/css" href="assets/dist/css/style.css">
</head>
<body>
	<?php 
	include 'topbar.php';
	include 'navbar.php';
	?>	

	<main class="content">
		<div class="container">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title text-center">Keranjang</h3>
				</div>
				<div class="panel-body">
					<?php if(empty($datakeranjang)): ?>
						<div class="alert alert-info">Belum ada produk yang dipilih.</div>
						<?php else: ?>

							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Produk</th>
											<th>Qty</th>
											<th>Berat</th>
											<th>Harga</th>
											<th>Sub Berat</th>
											<th>Sub Harga</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $total=0; ?>
										<?php foreach ($datakeranjang as $key => $value): ?>
											<tr>
												<td><?php echo $key+1; ?></td>
												<td><?php echo $value['nama_produk']; ?></td>
												<td><?php echo $value['jumlah_beli']; ?></td>
												<td><?php echo $value['berat_produk']; ?></td>
												<td><?php echo $value['harga_produk']; ?></td>
												<td><?php echo $value['sub_berat']; ?></td>
												<td><?php echo $value['sub_harga']; ?></td>
												<td>
													<a href="hapuskeranjang.php?id=<?php echo $value['id_produk']; ?>" onclick="return confirm('apakah anda yakin ?')"><i class=" fa fa-trash"></i></a>
												</td>
												<?php $total+=$value["sub_harga"]; ?>
											</tr>
										<?php endforeach ?>
										<tr>
											<th colspan="6">Total</th>
											<th><?php echo $total; ?></th>
										</tr>
									</tbody>
								</table>
								<a href="produk.php?page=1" class="btn btn-default">Lanjut Belanja</a>
								<a href="checkout.php" class="btn btn-primary">Checkout</a>
							</div>
						<?php endif ?>
					</div>
				</div>
			</div>
		</main>
		<?php 
		include 'footer.php';
		?>

		<script src="assets/dist/js/jquery.min.js"></script>
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/owlcarousel/owl.carousel.min.js"></script>
		<script src="assets/dist/js/warungtrainit.js"></script>
	</body>
	</html>