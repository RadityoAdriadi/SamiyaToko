<?php 
include 'config/class.php';

if(!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('anda, belum login');</script>";
	echo "<script>location='login.php';</script>";
}
?>


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

	$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];


	$datpel = $pembelian->tampil_pembelian_pelanggan($id_pelanggan);
	
	$pelanggan = $pelanggan->ambil_pelanggan($id_pelanggan);
	// echo "<pre>";
	// print_r($pelanggan);
	// echo "</pre>";

	?>	

	<main class="content">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="panel panel-warning">
						
						<div class="panel-heading">
							<h3 class="panel-title text-center">Riwayat Transaksi</h3>
						</div>
						<div class="panel-body">
							<table class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Tanggal</th>
										<th>Total</th>
										<th>Status</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($datpel as $key => $value): ?>
										<tr>
											<td><?php echo $key+1; ?></td>
											<td><?php echo $value['tanggal_pembelian']; ?></td>
											<td><?php echo $value['total_pembelian']; ?></td>
											<td><?php echo $value['status_pembelian']; ?></td>
											<td>
												<a href="detail.php?id=<?php echo $value["id_pembelian"] ?>" class="btn btn-info btn-sm">Detail</a>
												<a href="pembayaran.php?id=<?php echo $value["id_pembelian"] ?>" class="btn btn-success btn-sm">Pembayaran</a>
												<a href="ulasan.php?id=<?php echo $value['id_pembelian'] ?>" class="btn btn-primary btn-sm">Ulasan</a>
											</td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
						
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-color">
						<div class="panel-heading">
							<h3 class="panel-title">Informasi Akun</h3>
						</div>
						<div class="panel-body">
							<?php if (isset($_SESSION['pelanggan'])): ?>
								<table class="table table-responsive">
									<tr>
										<td>
											<img src="assets/img/default.png" width="100">
										</td>
									</tr>
									<tr>
										<th>Nama</th>	
										<th>:</th>
										<td><?php echo $pelanggan['nama_pelanggan']; ?></td>
									</tr>
									<tr>
										<th>Alamat</th>
										<th>:</th>
										<td><?php echo $pelanggan['alamat_pelanggan']; ?></td>
									</tr>
									<tr>
										<th>Provinsi</th>
										<th>:</th>
										<td><?php echo $pelanggan['provinsi']; ?></td>
									</tr>
									<tr>
										<th>Kota/Kabupaten</th>
										<th>:</th>
										<td>
											<?php echo $pelanggan['tipe_kota']; ?>
											<?php echo $pelanggan['kokab']; ?>
										</td>
									</tr>
									<tr>
										<th>Nomor Telp</th>
										<th>:</th>
										<td><?php echo $pelanggan['telp_pelanggan']; ?></td>
									</tr>
									<tr>
										<th>Email</th>
										<th>:</th>
										<td><?php echo $pelanggan['email_pelanggan']; ?></td>
									</tr>
								</table>
							<?php endif ?>
							<a class="btn btn-warning center-block" href="lengkapiakun.php">Perbarui Informasi Akun</a>
						</div>
					</div>
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

