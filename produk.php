<?php 
include 'config/class.php';
$batas = 6;
if (!isset($_GET['page']) or empty($_GET['page'])) 
{
	$page=1;
}
else
{
	$page = $_GET['page'];
}
$posisi = ($page-1)*$batas;
$dataproduk = $produk->tampil_produk_paging($posisi,$batas);


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
			<div class="panel panel-success">
				<div class="panel-heading text-center">
					<h3 class="panel-title"> Produk </h3>
				</div>
				<div class="panel-body">
					<?php foreach ($dataproduk as $key => $value): ?>
						<div class="col-md-4">
							<div class="text-center">
								<div class="image-product img-responsive">
									<img src="foto_produk/crop_<?php echo $value['foto_produk']; ?>"  width="200">
								</div>
								<h3 class="title-produk"><a href=""><?php echo $value['nama_produk']; ?></a></h3>
								<?php $produk->cek_rating($value["id_produk"]);?>
								<span class="price-product">Rp. <?php echo number_format($value['harga_produk']); ?></span>
								<a href="detailproduk.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-info">Detail</a>
								<a href="beliproduk.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-warning">Beli</a>
							</div>
						</div>
					<?php endforeach ?>
				</div>
				<div class="panel-body text-center">
					<ul class="pagination">
						<?php  
						$dataproduk = $produk->tampil_produk();
						$totalproduk = count($dataproduk);
						$totalhalaman = ceil($totalproduk/$batas);
						for ($i=1; $i <=$totalhalaman; $i++)
						{
							$aktif = $i==$_GET["page"]?"active":"";
							echo "<li class='$aktif'><a href='produk.php?page=$i'>".$i."</li>" ;
						}
						?>
					</ul>
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