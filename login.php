<?php 
	include 'config/class.php';
 ?>

 <?php 
 	if (isset($_SESSION["pelanggan"]))
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
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<div class="panel-title">Login</div>
					</div>
					<div class="panel-body">
						<form method="post">
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="email" class="form-control">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="pass" class="form-control">
							</div>
							<button class="btn btn-info" name="login">Login</button>
				         </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<?php 
	if (isset($_POST['login'])) 
	{
		$hasil = $pelanggan->login_pelanggan($_POST['email'],$_POST['pass']);
		if ($hasil=="sukses")
		{
			echo "<script>alert('berhasil login');</script>";
			echo "<script>location='index.php';</script>";
		}
		else if($hasil=="gagal")
		{
			echo "<script>alert('gagal login');</script>";
			echo "<script>location='login.php';</script>";
		}
	}
?>

<?php 
	include 'footer.php';
 ?>

<script src="assets/dist/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/owlcarousel/owl.carousel.min.js"></script>
<script src="assets/dist/js/warungtrainit.js"></script>
</body>
</html>