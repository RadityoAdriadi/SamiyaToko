<?php  
	include 'config/class.php';
	if (!isset($_GET["cari"]) or empty($_GET['cari'])) 
	{
		echo "<script>alert('masukan produk yang dicari');</script>";
	    echo "<script>location='index.php';</script>";
	}
	if(isset($_GET['cari']))
	{
		$dataproduk = $produk->cari_produk($_GET['cari']);
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
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div class="box">
					<div class="box-header">
						<h3 class="box-tittle"> Pencarian Produk <?php echo $_GET['cari']; ?> </h3>
					</div>
					<div class="box-body">
						<?php if(empty($dataproduk)): ?>
							<div class="alert alert-info">
								tidak ditemukan produk <?php echo $_GET['cari'] ?>
							</div>
						<?php endif ?>
						<?php if(!empty($dataproduk)): ?>
							<div class="alert alert-info">
								Ditemukan <?php echo count($dataproduk) ?> produk <?php echo $_GET['cari']; ?>
							</div>
						<?php endif ?>
						<div class="row">
							<?php foreach ($dataproduk as $key => $value): ?>
							<div class="col-md-4">
								<div class="text-center">
									<div class="image-product img-responsive">
										<img src="foto_produk/<?php echo $value['foto_produk']; ?>" class="img-responsive">
									</div>
									<h3 class="title-produk"><a href=""><?php echo $value['nama_produk']; ?></a></h3>
									<span class="price-product">Rp. <?php echo number_format($value['harga_produk']); ?></span>
									<a href="detailproduk.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-color">Detail</a>
									<a href="beliproduk.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-primary">Beli</a>
								</div>
							</div>
							<?php endforeach ?>
						</div>
					</div>
				</div>
		</div>
			<div class="col-md-3 col-md-pull-9">
				<?php include 'sidebar.php'; ?>
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