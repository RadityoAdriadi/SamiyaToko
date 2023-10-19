<?php 
include '../config/class.php';

if(!isset($_SESSION['admin']))
{
	echo "<script>alert('anda harus login');</script>";
	echo "<script>location='login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Administrator</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="css/kadal.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/sendiri.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">
  
</head>
<body>
	<section>
		<div id="wrapper">
			<nav class="navbar navbar-default">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".sidebar-collapse" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">SAMIYA TOKO</a>
				</div>
			</nav>
			<nav class="navbar-default navbar-side">
				<div class="sidebar-collapse">
					<div class="user">
						<img src="img/icon.png">
						<h3><?php if(isset($_SESSION['admin'])) 
						{
							echo $_SESSION['admin']['nama_lengkap'];
						}
						?>  
					</h3>
					<P>ADMINISTRATOR</P>
				</div>
				<div class="sidebar-collapse">
					<div class="panel panel-color">
						<div class="panel-heading">
							Nama Karyawan
						</div>
						<div class="panel-body">
							<ul class="nav" id="main-menu">
								<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
								<li><a href="index.php?halaman=kategori"><i class="fa fa-tags"></i> Kategori</a></li>
								<li><a href="index.php?halaman=produk"><i class="fas fa-pencil-alt"></i> Produk</a></li>
								<li><a href="index.php?halaman=pelanggan"><i class="fas fa-user"></i> Pelanggan</a></li>
								<li><a href="index.php?halaman=pembelian"><i class="fas fa-cube"></i> Pembelian</a></li>
								<li><a href="index.php?halaman=pengaturan"><i class="fas fa-cog"></i> Pengaturan</a></li>
								<li><a href="index.php?halaman=logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
							</ul>
						</div>
					</div>
				</div>
			</nav>
			<div id="page-wrapper">
				<div id="page-inner">
					<?php 
					if(!isset($_GET['halaman']))
					{
						include 'home.php';
					}
					else
					{
						if($_GET['halaman']=="kategori")
						{
							include 'kategori/tampilkategori.php';
						}
						elseif($_GET['halaman']=="tambahkategori") 
						{
							include 'kategori/tambahkategori.php';
						}
						elseif ($_GET['halaman']=="hapuskategori") 
						{
							include 'kategori/hapuskategori.php';
						}
						elseif ($_GET['halaman']=="ubahkategori") 
						{
							include 'kategori/ubahkategori.php';
						}
						elseif($_GET['halaman']=="produk") 
						{
							include 'produk/tampilproduk.php';
						}
						elseif ($_GET['halaman']=="tambahproduk") 
						{
							include 'produk/tambahproduk.php';
						}
						elseif ($_GET['halaman']=="ubahproduk") 
						{
							include 'produk/ubahproduk.php';
						}
						elseif ($_GET['halaman']=="hapusproduk") 
						{
							include 'produk/hapusproduk.php';
						}
						elseif($_GET['halaman']=="pelanggan") 
						{
							include 'pelanggan/tampilpelanggan.php';
						}
						elseif ($_GET['halaman']=="tambahpelanggan") 
						{
							include 'pelanggan/tambahpelanggan.php'; 
						}
						elseif ($_GET['halaman']=="ubahpelanggan") 
						{
							include 'pelanggan/ubahpelanggan.php';
						}
						elseif ($_GET['halaman']=="hapuspelanggan") 
						{
							include 'pelanggan/hapuspelanggan.php';
						}
						elseif ($_GET['halaman']=="pembelian")
						{
							include 'pembelian/tampilpembelian.php';
						}
						elseif ($_GET['halaman']=="nota") 
						{
							include 'pembelian/nota.php';
						}
						elseif ($_GET['halaman']=="pembayaran") 
						{
							include 'pembelian/pembayaran.php';
						}
						elseif ($_GET['halaman']=="pengaturan")
						{
							include 'pengaturan/tampilpengaturan.php';
						}
						elseif ($_GET['halaman']=="ubahpengaturan") 
						{
							include 'pengaturan/ubahpengaturan.php';
						}
						elseif ($_GET['halaman']=="logout") 
						{
							include 'logout.php';
						}
					}
					?>
				</div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/solo.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/sendiri.js"></script>
		<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
		<script>
			$(document).ready(function() {
				$('#tabel').DataTable();
			} );
		</script>
		<script src="ckeditor/ckeditor.js"></script>
	</section>
</body>
</html>