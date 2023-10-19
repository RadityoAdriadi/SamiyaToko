<?php 
include 'config/class.php';
$id_kategori = $_GET['id'];
$dataproduk = $produk->tampil_produk_kategori($id_kategori);

$idkategori = $_GET['id'];
$namakategori = $kategori->ambil_kategori($idkategori);
?>
<!-- <pre>
<?php print_r($dataproduk); ?>
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
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title text-center"> Produk <?php echo $namakategori['nama_kategori']; ?></h3>
				</div>
				<div class="panel-body">
					<?php foreach ($dataproduk as $key => $value): ?>
						<div class="col-md-4">
							<div class="text-center">
								<div class="image-product img-responsive">
									<img src="foto_produk/crop_<?php echo $value['foto_produk']; ?>" width="200">
								</div>
								<h3 class="title-produk"><a href=""><?php echo $value['nama_produk']; ?></a></h3>
								<?php $produk->cek_rating($value["id_produk"]);?>
								<span class="price-product">Rp. <?php echo number_format($value['harga_produk']); ?></span>
								<a href="detailproduk.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-info">Detail</a>
								<a href="beliproduk.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-warning">Beli</a>
								<p>&nbsp;</p><br>
							</div>
						</div>
					<?php endforeach ?>
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