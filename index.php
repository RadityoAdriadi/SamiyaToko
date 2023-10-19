<?php 
include 'config/class.php'; 
$batas = 4;
$posisi = 0;
$dataproduk = $produk->tampil_produk($batas,$posisi);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>SAMIYA TOKO</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/owlcarousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="assets/owlcarousel/assets/owl.theme.default.min.css">
	<link rel="stylesheet" type="text/css" href="assets/dist/css/style.css">
</head>
<body>
	<?php 
	include 'header.php';
	?>
	<main class="content">
		<div class="container">
			<div class="owl-carousel slider-utama owl-theme">
				<div>
					<img src="assets/img/sample.png">
					<div class="text">
						<h1>Tentang Kami</h1>
						<p>
							Di era fashion saat ini banyak produk-produk baru dengan karakteristik nya masing-masing untuk membedakan dari produk lainnya, Samiya adalah merek produk tas dengan bahan dasar dari
							kulit yang diambil langsung dari pengrajin kulit yang berada di kota Yogyakarta.. 
						</p>
					</div>
				</div>
				<div>
					<img src="assets/img/sample3.png">
					<div class="text">
						<h1>Tentang Kami</h1>
						<p>
						 	Proses pembuatanya melibatkan penjahit-penjahit yang sudah berpengalaman dalam membuat tas. proses pengerjaan nya sangat teliti untuk mendapatkan hasil yang rapi sehingga produk kami memiliki kualitas yang sangat baik. 
						</p>
					</div>
				</div>
			</div>
		</div>
		
		<h1 class="text-center">SAMIYA Produk</h1>
		<div class="container">
			<div class="row">
				<div class="container">
					<?php foreach ($dataproduk as $key => $value): ?>
						<div class="col-md-3">
							<div class="panel panel-success">
								<div class="panel-body">
									<div class="text-center">
										<div class="image-product">
											<img src="foto_produk/crop_<?php echo $value['foto_produk']; ?>" width="200px">
										</div>
										<h3 class="title-produk"><a href="detailproduk.php?id=<?php echo $value['id_produk'] ?>"><?php echo $value['nama_produk']; ?></a></h3>
										<?php $produk->cek_rating($value["id_produk"]);?>
										<span class="price-product">Rp. <?php echo number_format($value['harga_produk']) ; ?></span>
										<a href="detailproduk.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-info">Detail</a>
										<a href="beliproduk.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-warning">Beli</a>
									</div>
								</div>
							</div>
						</div>
						<?php if(($key+1)%4==0){echo "<div class='clearfix'></div>";} ?>
					<?php endforeach ?>
					<span class="text-center"><h5><a href="produk.php?page=1">Tampilkan Lebih Banyak</a></h5></span>
				</div>
			</div>
		</div>
	</main>
	
	<section id="kategori">
		<div class="container">
			<h1 class="text-center">Kategori Produk</h1>
			<div class="row">
				<div class="container">
					<div class="col-md-6">
						<a href="kategori.php?id=8">
							<img src="assets/img/men.png">
						</a>
					</div>
					<div class="col-md-6">
						<a href="kategori.php?id=7">
							<img src="assets/img/women.png">
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="step">
		<div class="container">
			<h1 class="text-center">cara beli</h1>
		</div>
		<div class="image">
			<img src="assets/img/stepi.png">
		</div>
	</section>

<!-- 	<section>
		awal slider blog
		<div class="container">
			<h1>Blog kami</h1>
			<div class="container">
				<div class="owl-carousel slider-blog owl-theme">
					<div class="box-tools" id="letaknavblog"></div>
					<div class="panel panel-default">
						<div class="panel-heading post-thumb">
							<img src="assets/img/blog/1.jpg">
						</div>
						<div class="panel-body post-body">
							<h3 class="post-title">
								<a href="#">Lorem Ipsum</a>
							</h3>
							<p class="blog-conten">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat.
							</p>
							<span><a href="#">Lanjutkan membaca...</a></span>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading post-thumb">
							<img src="assets/img/blog/2.jpg">
						</div>
						<div class="panel-body post-body">
							<h3 class="post-title">
								<a href="#">Lorem Ipsum</a>
							</h3>
							<p class="blog-conten">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat.
							</p>
							<span><a href="#">Lanjutkan membaca...</a></span>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading post-thumb">
							<img src="assets/img/blog/1.jpg">
						</div>
						<div class="panel-body post-body">
							<h3 class="post-title">
								<a href="#">Lorem Ipsum</a>
							</h3>
							<p class="blog-conten">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat.
							</p>
							<span><a href="#">Lanjutkan membaca...</a></span>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading post-thumb">
							<img src="assets/img/blog/2.jpg">
						</div>
						<div class="panel-body post-body">
							<h3 class="post-title">
								<a href="#">Lorem Ipsum</a>
							</h3>
							<p class="blog-conten">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat.
							</p>
							<span><a href="#">Lanjutkan membaca...</a></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		akhir slider blog
	</div>
</section> -->
<?php 
include 'footer.php';
?>

<script src="assets/dist/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/owlcarousel/owl.carousel.min.js"></script>
<script src="assets/dist/js/warungtrainit.js"></script>
<script type="text/javascript">
	window.onscroll = function() {myFunction()};

	var navbar = document.getElementById("main-nav");
	var sticky = navbar.offsetTop;

	function myFunction() {
		if (window.pageYOffset >= sticky) {
			navbar.classList.add("sticky")
		} else {
			navbar.classList.remove("sticky");
		}
	};
	$(document).ready(function(){

	})
</script>
</body>
</html>