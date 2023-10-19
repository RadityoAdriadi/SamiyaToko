<?php 
include '../config/class.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Administrator</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/kadallogin.css">
</head>
<body>
	<section class="login-page">
		<form method="post">
			<div class="box">
				<div class="form-head">
					<h3>Login</h3>
				</div>
				<div class="form-body">
					<input type="text" name="em" placeholder="username">
					<input type="password" name="pas" placeholder="password">
				</div>
				<div class="form-footer">
					<button  name="login" type="submit">Log in</button>
				</div>
			</div>
		</form>
		<?php 
		if (isset($_POST['login']))
		{
			$hasil = $admin->login_admin($_POST['em'],$_POST['pas']);
			if($hasil=="sukses")
			{
				// echo "<div class='alert alert-info'>Login Berhasil</div>";
				// echo "<meta http-equiv='refresh' content='1;url=index.php'>";
				echo "<script>alert('Login Berhasil')</script>"; 
				echo "<script>location='index.php';</script>"; 
			}
			else
			{
				// echo "<div class='alert alert-danger'>Login Gagal</div>";
				// echo "<meta http-equiv='refresh' content='1;url=login.php'>";
				echo "<script>alert('Login Gagal')</script>"; 
				echo "<script>location='login.php';</script>"; 
			}
		}
		?>
	</section>
</body>
</html>
