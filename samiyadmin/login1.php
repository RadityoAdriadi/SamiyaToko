<?php 
	include '../config/class.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Administrator</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
		<div class="container" style="padding-top: 150px">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="panel-title">Login Admin</div>
						</div>
						<div class="panel-body">
							<form method="post">
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" name="em">
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" class="form-control" name="pas">
								</div>
								<button class="btn btn-primary" name="login">Login</button>
							</form>
							<?php 
								if (isset($_POST['login']))
								{
									$hasil = $admin->login_admin($_POST['em'],$_POST['pas']);
									if($hasil=="sukses")
									{
										echo "<div class='alert alert-info'>Login Berhasil</div>";
										echo "<meta http-equiv='refresh' content='1;url=index.php'>";
									}
									else
									{
										echo "<div class='alert alert-danger'>Login Gagal</div>";
										echo "<meta http-equiv='refresh' content='1;url=login.php'>";
									}
								}
							 ?>
						</div>
					</div>
				</div>
			</div>
		</div>
</body>
</html>
 