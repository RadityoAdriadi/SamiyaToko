<?php 
include 'config/class.php';
?>

<?php 
if (!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('anda, sudah login');</script>";
	echo "<script>location='index.php';</script>";
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
	?>	
	<main class="content">
		<div class="container">
			<div class="box">
				<div class="box-header"></div>
				<div class="box-body">
					<h2>Nota Pembelian</h2>
					<hr> 

					<?php 
					$id_pembelian = $_GET["id"];
// echo "$id_pembelian";

					$produkpembelian = $pembelian->tampil_produk_pembelian($id_pembelian);
// echo "<pre>";
// print_r($produkpembelian);
// echo "</pre>";
					$detail = $pembelian->ambil_pembelian($id_pembelian);
// echo "<pre>";
// print_r($detail);
// echo "</pre>";
					$id_pelanggan_ygbeli = $detail["id_pelanggan"];
					$id_pelanggan_yglogin = $_SESSION["pelanggan"]["id_pelanggan"];
					if ($id_pelanggan_yglogin !== $id_pelanggan_ygbeli) 
					{
						echo "<script>alert('akses ditolak');</script>";
						echo "<script>location='index.php';</script>";
					}
					?>

					<div class="row">
						<div class="col-md-4">
							<h3>Pembelian</h3>
							<p>No: <?php echo $detail['id_pembelian'];?></p>
							<p>Tanggal: <?php echo $detail['tanggal_pembelian']; ?></p>
							<p>Status: <span class="btn btn-danger btn-xs"><?php echo $detail['status_pembelian']; ?></span></p>
						</div>
						<div class="col-md-4">
							<h3>Pelanggan</h3>
							<p>Pelanggan: <?php echo $detail['nama_pelanggan']; ?> </p>
							<p>Telepon: <?php echo $detail['telp_pelanggan']; ?> </p>
							<p>Email: <?php echo $detail['email_pelanggan']; ?> </p>
							<p>Alamat: <?php echo $detail['alamat_pelanggan']; ?> </p>
						</div>
						<div class="col-md-4">
							<h3>Pengiriman</h3>
							<p>
								<?php echo $detail['tipe']; ?>
								<?php echo $detail['distrik']; ?>
								<?php echo $detail['provinsi']; ?>
								<?php echo $detail['kodepos_pengiriman']; ?>
							</p>
							<p>Nama Penerima: <?php echo $detail['nama_penerima']; ?></p>
							<p>Telepon Penerima: <?php echo $detail['telp_penerima']; ?></p>
							<p>Alamat Penerima: <?php echo $detail['alamat_penerima']; ?></p>
							<p>
								Pengiriman: <?php echo $detail['ekspedisi_pengiriman']; ?> <?php echo $detail['paket_pengiriman']; ?>, 
							</p>
							<p>Estimasi Pengiriman: <?php echo $detail['lama_pengiriman']; ?> Hari.</p>
						</div>
					</div>
					<hr>

					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Produk</th>
								<th>Berat</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th>Sub berat</th>
								<th>Sub Harga</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($produkpembelian as $key => $value): ?>
								<tr>
									<td><?php echo $key+1; ?></td>
									<td>
										<img src="foto_produk/<?php echo $value['foto_produk']; ?>" width="200">
									</td>
									<td><?php echo $value['berat_produk']; ?></td>
									<td>Rp. <?php echo number_format($value['harga_produk']);?></td>
									<td><?php echo $value['jumlah_produk']; ?></td>
									<td><?php echo $value['subberat_produk']; ?></td>
									<td>Rp. <?php echo number_format($value['subharga_produk']); ?></td>
								</tr>
							<?php endforeach ?>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="6">Total Belanja</th>
								<th>Rp.<?php echo number_format($detail['total_belanja']); ?></th>
							</tr>
							<tr>
								<th colspan="6">Total Ongkos Kirim</th>
								<th>Rp.<?php echo number_format($detail['total_ongkir']); ?></th>
							</tr>
							<tr>
								<th colspan="6">Total Pembelian</th>
								<th>Rp.<?php echo number_format($detail['total_pembelian']); ?></th>
							</tr>
						</tfoot>
					</table>


				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<div class="well">
								<?php 
								$isi = $pengaturan->ambil_isi_pengaturan("rekening_perusahaan");
								$isi = str_replace("{total_pembelian}", number_format($detail['total_pembelian']), $isi);
								echo $isi;

								?>
							</div>
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