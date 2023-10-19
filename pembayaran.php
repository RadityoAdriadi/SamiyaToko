<?php 
include 'config/class.php';
?>

<?php 
if (!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('anda, harus login');</script>";
	echo "<script>location='login.php';</script>";
}
 	//mendapatkan id_pembelian
 	// mendapatkan data berdasarkan id dari url
$id_pembelian = $_GET["id"];
$detail = $pembelian->ambil_pembelian($id_pembelian);

$id_pelanggan_ygbeli = $detail["id_pelanggan"];
$id_pelanggan_yglogin = $_SESSION["pelanggan"]["id_pelanggan"];
if ($id_pelanggan_yglogin !== $id_pelanggan_ygbeli) 
{
	echo "<script>alert('akses ditolak');</script>";
	echo "<script>location='index.php';</script>";
	exit();
}


//mendapatkan detail pembayarna
$detail_pembayaran = $pembelian->ambil_pembayaran($id_pembelian);
// echo "<pre>";
// print_r($detail_pembayaran);
// echo "</pre>";

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
	?>	
	<main class="content">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="panel panel-color">
						<div class="panel-body">
							<?php if (isset($_SESSION['pelanggan'])): ?>
								<table class="table table-responsive">
									<tr>
										<td>
											<img src="assets/img/default.png" class="img-circle" width="100">
										</td>
									</tr>
									<tr>
										<th>Nama</th>	
										<th>:</th>
										<td><?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?></td>
									</tr>
									<tr>
										<th>Alamat</th>
										<th>:</th>
										<td><?php echo $_SESSION['pelanggan']['alamat_pelanggan']; ?></td>
									</tr>
									<tr>
										<th>Provinsi</th>
										<th>:</th>
										<td><?php echo $_SESSION['pelanggan']['provinsi']; ?></td>
									</tr>
									<tr>
										<th>Kota/Kabupaten</th>
										<th>:</th>
										<td><?php echo $_SESSION['pelanggan']['kokab']; ?></td>
									</tr>
									<tr>
										<th>Nomor Telp</th>
										<th>:</th>
										<td><?php echo $_SESSION['pelanggan']['telp_pelanggan']; ?></td>
									</tr>
									<tr>
										<th>Email</th>
										<th>:</th>
										<td><?php echo $_SESSION['pelanggan']['email_pelanggan']; ?></td>
									</tr>
								</table>
							<?php endif ?>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<?php if (empty($detail_pembayaran)): ?>
					<div class="panel panel-color">
						<div class="panel-heading">
							<h3 class="panel-title">Konfirmasi Pembayaran</h3>
						</div>
						<div class="panel-body">
							<table class="table">
								<tr>
									<td>ID Pembelian</td>
									<td><?php echo $detail['id_pembelian']; ?></td>
								</tr>
								<tr>
									<td>Tanggal</td>
									<td><?php echo $detail['tanggal_pembelian']; ?></td>
								</tr>
								<tr>
									<td>Status</td>
									<td><?php echo $detail['status_pembelian']; ?></td>
								</tr>
								<tr>
									<td>total</td>
									<td>Rp. <?php echo number_format($detail['total_pembelian']); ?></td>
								</tr>
							</table>
						</div>

						<div class="panel-body">
							<form method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label>Nama</label>
									<input type="text" name="nama" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Bank</label>
									<input type="text" name="bank" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Tanggal Bayar</label>
									<input type="date" name="tglbayar" class="form-control" value="<?php echo date("Y-m-d") ?>" required>
								</div>
								<div class="form-group">
									<label>Jumlah</label>
									<input type="number" min="0" name="jumlah" class="form-control" value="<?php echo $detail['total_pembelian']; ?>" required>
								</div>
								<div class="form-group">
									<label>Bukti</label>
									<input type="file" name="bukti" class="form-control" required>
								</div>
								<button class="btn btn-primary" name="kirim">Kirim</button>
							</form>
							<?php if(isset($_POST['kirim'])) 
							{
								$pembelian->kirim_pembayaran($_POST['nama'],$_POST['bank'],$_POST['tglbayar'],$_POST['jumlah'],$_FILES['bukti'],$id_pembelian);
								echo "<script>alert('Terima kasih telah melakukan pembayaran');</script>";
								echo "<script>location='member.php';</script>";							
							}
							?>
						</div>
					</div>
					<?php endif ?>

					<?php if (!empty($detail_pembayaran)): ?>
						<div class="panel panel-color">
							<div class="panel-heading">
								<h3>Informasi Pembayaran</h3>
							</div>
							<div class="panel-body">
								<table class="table">
									<tr>
										<td>Nama</td>
										<td><?php echo $detail_pembayaran['nama']; ?></td>
									</tr>
									<tr>
										<td>Bank</td>
										<td><?php echo $detail_pembayaran['bank']; ?></td>
									</tr>
									<tr>
										<td>Tanggal Bayar</td>
										<td><?php echo $detail_pembayaran['tanggal_bayar']; ?></td>
									</tr>
									<tr>
										<td>Tanggal Konfirmasi</td>
										<td><?php echo $detail_pembayaran['tanggal_konfirmasi']; ?></td>
									</tr>
									<tr>
										<td>Jumlah</td>
										<td><?php echo $detail_pembayaran['jumlah']; ?></td>
									</tr>
									<tr>
										<td>Bukti</td>
										<td>
											<img src="bukti_pembayaran/<?php echo $detail_pembayaran['bukti']; ?>" width="100"> 
										</td>
									</tr>
								</table>
							</div>
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