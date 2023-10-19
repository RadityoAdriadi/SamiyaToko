<?php 
include 'config/class.php'; 
$dataprovinsi = $customer->ambil_provinsi();
$datakota = $customer->ambil_kota();
// echo "<pre>";
// print_r($_SESSION);
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
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-info">
						<div class="panel-heading">
							<div class="panel-title text-center">informasi Akun</div>
						</div>
						<div class="panel-body">
							<form method="post">
								<div class="form-group">
									<label>Email</label>
									<input type="email" name="email" class="form-control" value="<?php echo $_SESSION['pelanggan']['email_pelanggan']?>">
								</div>
								<div class="form-group">
									<label>Nama Lengkap</label>
									<input type="text" name="nama" class="form-control" value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']?>">
								</div>
								<div class="form-group">
									<label>Telpon</label>
									<input type="text" name="telp" class="form-control" value="<?php echo $_SESSION['pelanggan']['telp_pelanggan']?>">
								</div>
								<div class="form-group">
									<label>Jenis Kelamin</label>
									<select class="form-control" name="kelamin">
										<option>-Jenis Kelamin-</option>
										<option>Laki-Laki</option>
										<option>Perempuan</option>
									</select>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Provinsi</label>
											<select name="provinsi" class="form-control">
												<option value="">--Pilih Provinsi--</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Kota/Kabupaten</label>
											<select name="kota" class="form-control">
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Alamat Lengkap</label>
									<textarea class="form-control" name="alamat"></textarea>
								</div><p>&nbsp;</p><br>
								<input type="text" name="provinsi">
								<input type="text" name="tipe">
								<input type="text" name="kabkot">
								<button class="btn btn-warning" name="update">Simpan</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<?php 
	if (isset($_POST['update'])) 
	{
		$hasil = $customer->update_pelanggan($_POST['email'],$_POST['nama'],$_POST['kelamin'],$_POST['telp'],$_POST['alamat'],$_POST['provinsi'],$_POST['tipe'],$_POST['kabkot'],$_SESSION['pelanggan']['id_pelanggan']);
		echo "<script>alert('Berhasil!!');</script>";
		echo "<script>location='member.php';</script>";
	}
	?>

	<?php 
	include 'footer.php';
	?>

	<script src="assets/dist/js/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/owlcarousel/owl.carousel.min.js"></script>
	<script src="assets/dist/js/warungtrainit.js"></script>
	<script>
		$(document).ready(function(){
			$.ajax({
				type: 'POST',
				url: 'dataprovinsi.php',
				success:function(hasil)
				{
					$("select[name=provinsi]").append(hasil);
				}
			})
		});

		$(document).ready(function(){
			$("select[name=provinsi]").on("change", function(){
				var id_provinsi = $(this).val();
				var namaprovinsi = $("option:selected",this).attr("nama");
				$("input[name=provinsi]").val(namaprovinsi);
				$.ajax({
					type:'POST',
					url:'datakota.php',
					data:'idprovinsi='+id_provinsi,
					success: function(hasil)
					{
						$("select[name=kota]").html(hasil);
					}
				})
			})
		});

		$(document).ready(function(){
			$("select[name=kota]").on("change", function(){
				var nama = $("option:selected",this).attr("nama");
				var tipe = $("option:selected",this).attr("type");
				$("input[name=tipe]").val(tipe);
				$("input[name=kabkot]").val(nama);
			})
		});
	</script>
</body>
</html>