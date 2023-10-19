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

					<form method="post">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Produk</th>
									<th>Gambar</th>
									<th>Ulasan</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($produkpembelian as $key => $value): ?>
									<?php 
									$id_pembelian = $value['id_pembelian'];
									$id_produk = $value['id_produk'];
									$dup = $pembelian->ambil_ulasan($id_pembelian,$id_produk);

									$readonly = !empty($dup["rating"]) ? "readonly" : "gakreadpnly";
									?>
									<tr>
										<td><?php echo $value['nama_produk']; ?></td>
										<td>
											<img src="foto_produk/<?php echo $value['foto_produk']; ?>" width="200">
										</td>
										<td>
											<div class="form-group">
												<input type="hidden" name="id_produk[]" value="<?php echo $value["id_produk"]; ?>">
												<div class='rating-stars'>
													<ul id='stars' idnya="<?php echo $value["id_produk"] ?>">
														<li class='star' title='Poor' data-value='1' idpnya="<?php echo $value["id_produk"] ?>">
															<i class='fa fa-star fa-fw'></i>
														</li>
														<li class='star' title='Fair' data-value='2' idpnya="<?php echo $value["id_produk"] ?>">
															<i class='fa fa-star fa-fw'></i>
														</li>
														<li class='star' title='Good' data-value='3' idpnya="<?php echo $value["id_produk"] ?>">
															<i class='fa fa-star fa-fw'></i>
														</li>
														<li class='star' title='Excellent' data-value='4' idpnya="<?php echo $value["id_produk"] ?>">
															<i class='fa fa-star fa-fw'></i>
														</li>
														<li class='star' title='WOW!!!' data-value='5' idpnya="<?php echo $value["id_produk"] ?>">
															<i class='fa fa-star fa-fw'></i>
														</li>
													</ul>
												</div>
												<input type="hidden" class="nilai-rating" idpnya="<?php echo $value["id_produk"] ?>" name="rating[]" value="<?php echo $dup['rating'] ?>" min="1" max="5" <?php echo $readonly ?>>
											</div>
											<div class="form-group">
												<textarea class="form-control" rows="2" name="isi_ulasan[]" <?php echo $readonly; ?>><?php echo $dup['isi'] ?></textarea>
											</div>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
						<button class="btn btn-primary" name="kirim">Kirim ulasan</button>
					</form>
				</div>
			</div>
		</div>
	</main>
	<?php 
	if(isset($_POST["kirim"]))
	{
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
		$pembelian->simpan_ulasan($_POST['id_produk'],$_POST['rating'],$_POST['isi_ulasan'],$id_pembelian);
		echo "<script>alert('terima kasih telah memberikan penilaian')</script>";
		echo "<script>location='member.php';</script>";
	}
	?> 


	<?php 
	include 'footer.php';
	?>

	<script src="assets/dist/js/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/owlcarousel/owl.carousel.min.js"></script>
	<script src="assets/dist/js/warungtrainit.js"></script>
	<script src="assets/dist/js/rating.js"></script>
</body>
</html>