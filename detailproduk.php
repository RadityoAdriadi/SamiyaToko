<?php
include 'config/class.php';
if(!isset($_GET['id']) or empty($_GET['id']))
{
	echo "<script>alert('silahkan pilih produk');</script>";
	echo "<script>location='index.php';</script>";
}

$id_produk = $_GET['id'];
$detpro = $produk->ambil_produk($id_produk);

$ulasan = $pembelian->tampil_ulasan($id_produk);
// print_r($ulasan);
// $banyak_data = count($ulasan);
// $jumlah_rating = 0;
// foreach ($ulasan as $key => $value) 
// {
// 	$jumlah_rating+=$value["rating"];
// }
// $total_rating = $jumlah_rating/$banyak_data;


$fotogaleri = $produk->ambilfoto($id_produk);
// echo "<pre>";
// print_r($fotogaleri);
// echo "</pre>";

if(empty($detpro))
{
	echo "<script>alert('silahkan pilih produk');</script>";
	echo "<script>location='index.php';</script>";
}

$id_kategori = $detpro["id_kategori"];
$batas = 3;
$posisi = 0;
$produkterkait = $produk->tampil_produk_kategori($id_kategori,$batas,$posisi);

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
				<div class="panel panel-info">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="column">
										<img src="foto_produk/crop_<?php echo $detpro['foto_produk']?>" onclick="myFunction(this);" width="85">
									</div>
									<?php foreach ($fotogaleri as $key => $value): ?>
										<div class="column">
											<img src="galeri_produk/crop_<?php echo $value['foto_geleri_produk'];?>" onclick="myFunction(this);" width="85">
										</div>
									<?php endforeach ?>
								</div>
								<div class="container">
									<span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
									<img id="expandedImg" style="width:25%">
									<div id="imgtext"></div>
								</div>
							</div>
							<div class="col-md-6">
								<h3 class="nama"><?php echo $detpro['nama_produk']; ?></h3>
								<h3 class="harga">Rp. <?php echo number_format($detpro['harga_produk']);?>,-</h3>
								<div class="totrate">
									<?php $produk->cek_rating($detpro["id_produk"]);?>
								</div>
								<form method="post">
									<div class="form-group">
										<div class="col-md-3">
											<div class="input-group">
												<input type="number" class="form-control" min="0" name="jumlah" placeholder="0">
											</div>
										</div>
										<div class="col-md-3">
											<div class="input-group-btn">
												<button class="btn btn-warning" name="beli">Beli</button>
											</div>
										</div>
									</div>
								</form>
								<div class="panel panel-info">
									<div class="panel-body">
										<div>
											<ul class="nav nav-tabs" role="tablist">
												<li role="presentation" class="active">
													<a href="#deskripsi" aria-controls="deskripsi" role="tab" data-toggle="tab">Deskripsi</a>
												</li>
												<li role="presentation">
													<a href="#ulasan" aria-controls="ulasan" role="tab" data-toggle="tab">Ulasan</a>
												</li>
											</ul>
											<div class="tab-content">
												<div role="tabpanel" class="tab-pane active" id="deskripsi">
													<?php echo $detpro['deskripsi'];  ?>
												</div>
												<div role="tabpanel" class="tab-pane" id="ulasan">
													<?php foreach ($ulasan as $key => $value): ?>
														<h5><?php echo $value["nama_pelanggan"]; ?></h5>

														<?php 
														for ($i=1; $i <= 5; $i++) 
														{ 
															$layak = $i <= $value["rating"] ? "fa-yellow" : "";
															echo "<i class='fa fa-star ".$layak."'></i>";

														}
														?>

														<p><?php echo $value["isi"]; ?></p>
														<hr>
													<?php endforeach ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php 
								if (isset($_POST['beli'])) 
								{
									$pembelian->simpan_keranjang($id_produk,$_POST['jumlah']);
									echo "<script>alert('produk terpilih');</script>";
									echo "<script>location='keranjang.php';</script>";
								}
								?>
							</div>
						</div>
						<br>
					</div>
				</div>
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="text-center"> Produk Terkait </h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<?php foreach ($produkterkait as $key => $value): ?>
								<div class="col-md-4">
									<div class="text-center">
										<div class="image-product img-responsive">
											<img src="foto_produk/crop_<?php echo $value['foto_produk']; ?>" width="200">
										</div>
										<h3 class="title-produk"><a href=""><?php echo $value['nama_produk']; ?></a></h3>
										<span class="price-product">Rp. <?php echo number_format($value['harga_produk']); ?></span>
										<a href="detailproduk.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-info">Detail</a>
										<a href="beliproduk.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-warning">Beli</a>
									</div>
								</div>
								<?php if(($key+1)%3==0){echo "<div class='clearfix'></div>";} ?>
							<?php endforeach ?>
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
	<script>
		function myFunction(imgs) 
		{ 
		  // Get the expanded image
		  var expandImg = document.getElementById("expandedImg");
		  // Get the image text
		  var imgText = document.getElementById("imgtext");
		  // Use the same src in the expanded image as the image being clicked on from the grid
		  expandImg.src = imgs.src;
		  // Use the value of the alt attribute of the clickable image as text inside the expanded image
		  imgText.innerHTML = imgs.alt;
		  // Show the container element (hidden with CSS)
		  expandImg.parentElement.style.display = "block";
		}

	</script>
</body>
</html>