<?php 
include 'config/class.php';

$testimoni = $customer->simpan_testimoni_status();
// echo "<pre>";
// print_r($testimoni);
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

			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title text-center">Testimoni</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<?php foreach ($testimoni as $key => $value): ?>
							<div class="col-md-4">
								<div class="text-center">
									<img src="assets/img/default.png" class="img-circle testimoni-image">
									<h4 class="testimoni-tittle"><?php echo $value['nama_pelanggan']; ?></h4>
									<p class="testimoni-content">
										<?php echo $value['isi']; ?>
									</p>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
			<div class="panel panel-info">
				<div class="panel-heading text-center">
					<h3 class="panel-title">Tulis Testimoni</h3>
				</div>
				<div class="panel-body">
					<?php if (!isset($_SESSION['pelanggan'])): ?>
						<div class="alert alert-danger">Anda Harus Login</div>
						<?php else: ?>
							<form method="post" class="form-group">
								<label>Nama</label>
								<input type="" name="nama" 
								value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>" class="form-control">
								<br>
								<textarea class="form-control" name="isi"></textarea>
								<br>
								<button class="btn btn-warning" name="kirim">kirim</button>
							</form>
							<?php 
							if(isset($_POST['kirim']))
							{
								$customer->simpan_testimoni($_SESSION['pelanggan']['id_pelanggan'],$_POST['nama'],$_POST['isi']);
								echo "<script>alert('Terkirim');</script>";
								echo "<script>location='testimoni.php';</script>";
							}
							?>
						<?php endif ?>

					</div>
				</div>

			</div>
		</main>
		<?php 
		include 'footer.php';
		?>
		<style type="text/css">
			.panel-info
			{
				margin-top: 0px;
			}
		</style>

		<script src="assets/dist/js/jquery.min.js"></script>
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/owlcarousel/owl.carousel.min.js"></script>
		<script src="assets/dist/js/warungtrainit.js"></script>
	</body>
	</html>