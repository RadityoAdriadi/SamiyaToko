<?php 
include 'config/class.php'; 

$datakeranjang = $pembelian->tampil_keranjang();
if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan']))
{
	echo "<script>alert('Anda Harus Login');location='login.php';</script>";
}


echo"<pre>";
print_r($_SESSION);
echo"</pre>";
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
				<div class="col-md-6 col-md-push-6">
					<div class="box">
						<div class="box-header">
							<h3 class="box-tittle"> Checkout </h3>
						</div>
						<div class="box-body">
							<?php if(empty($datakeranjang)): ?>
								<div class="alert alert-info">Belum ada produk yang dipilih.</div>
								<?php else: ?>

									<div class="table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>No</th>
													<th>Produk</th>
													<th>Qty</th>
													<th>Berat</th>
													<th>Harga</th>
													<th>Sub Berat</th>
													<th>Sub Harga</th>
												</tr>
											</thead>
											<tbody>
												<?php $total=0; ?>
												<?php $totalberat=0; ?>
												<?php foreach ($datakeranjang as $key => $value): ?>
													<tr>
														<td><?php echo $key+1; ?></td>
														<td><?php echo $value['nama_produk']; ?></td>
														<td><?php echo $value['jumlah_beli']; ?></td>
														<td><?php echo $value['berat_produk']; ?> Gram</td>
														<td>Rp.<?php echo number_format($value['harga_produk']); ?></td>
														<td><?php echo $value['sub_berat']; ?> Gram</td>
														<td>Rp.<?php echo number_format($value['sub_harga']); ?></td>
														<?php $total+=$value["sub_harga"]; ?>
														<?php $totalberat+=$value["sub_berat"] ?>
													</tr>
												<?php endforeach ?>
												<tr>
													<th colspan="6">Total Belanja</th>
													<th>Rp.<?php echo number_format($total); ?></th>
												</tr>
												<tr>
													<th colspan="6">Total Ongkir</th>
													<th id="total_ongkir"></th>
												</tr>
												<tr>
													<th colspan="6">Total Bayar</th>
													<th id="total_bayar"></th>
												</tr>
											</tbody>
										</table>
									</div>
								<?php endif ?>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-md-pull-6">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">Pengiriman</h3>
							</div>
							<div class="box-body">
								<form method="POST">
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
												<label>Kota</label>
												<select name="kota" class="form-control">
												</select>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Kurir</label>
												<select name="kurir" class="form-control"></select>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Ongkir</label>
												<select name="ongkir" class="form-control">
												</select>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Nama Penerima</label>
												<input type="text" class="form-control" name="nama_penerima" value="<?php echo $_SESSION['pelanggan']['nama_pelanggan'] ?>">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Telpon Penerima</label>
												<input type="text" class="form-control" name="telpon_penerima" value="<?php echo $_SESSION['pelanggan']['telp_pelanggan'] ?>">
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label>Alamat Lengkap</label>
												<textarea class="form-control" name="alamat_lengkap"><?php echo $_SESSION['pelanggan']['alamat_pelanggan'] ?></textarea>
											</div>
										</div>

									</div>
									<input type="hidden" name="total_belanja" value="<?php echo $total; ?>">
									<input type="hidden" name="total_berat" value="<?php echo $totalberat; ?>">
									<input type="hidden" name="provinsi">
									<input type="hidden" name="tipe">
									<input type="hidden" name="kabkot">
									<input type="hidden" name="kodepos">
									<input type="hidden" name="kurir">
									<input type="hidden" name="paket">
									<input type="hidden" name="biaya">
									<input type="hidden" name="etd">
									<input type="hidden" name="total_bayar" >
									
									<button class="btn btn-primary" name="checkout">Selesaikan</button>
									<?php 
										if(isset($_POST['checkout']))
										{
											$ouput = $pembelian->simpan_pembelian($_POST['nama_penerima'],$_POST['telpon_penerima'],$_POST['alamat_lengkap'],$_POST['total_belanja'],$_POST['total_berat'],$_POST['provinsi'],$_POST['tipe'],$_POST['kabkot'],$_POST['kodepos'],$_POST['kurir'],$_POST['paket'],$_POST['biaya'],$_POST['etd'],$_POST['total_bayar']);

											if ($ouput=="gagal")
											{

											echo "<script>alert('gagal, produk telah habis')</script>";
											echo "<script>location='keranjang.php';</script>";
											}
											else
											{
											echo "<script>alert('Terimakasih, silahkan melakukan pembayaran')</script>";
											echo "<script>location='detail.php?id=$ouput';</script>";
											}
										}
									?>
								</form>
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
		<script type="text/javascript">
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
					var namaprovinsi = $("option:selected").attr("nama");
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
					var kodepos = $("option:selected",this).attr("kodepos");
					$("input[name=kabkot]").val(nama);
					$("input[name=tipe]").val(tipe);
					$("input[name=kodepos]").val(kodepos);
				})
			});
			$(document).ready(function(){
				$.ajax({
					url: 'dataekspedisi.php',
					success:function(hasil)
					{
						$("select[name=kurir]").html(hasil);
					}
				})
			});
			$(document).ready(function(){
				$("select[name=kurir]").on("change",function(){
					var nama = $("option:selected",this).attr("nama");
					$("input[name=kurir]").val(nama);
				})
			});
			$(document).ready(function(){
				$("select[name=kurir]").on("change",function(){
					var id_kota = $("select[name=kota]").val();
					var berat = $("input[name=total_berat]").val();
					var kurir = $("select[name=kurir]").val();

					console.log(id_kota);
					console.log(berat);
					console.log(kurir);
					$.ajax({
						url: 'dataongkir.php',
						type:'post',
						data: 'id_kota='+id_kota+'&berat='+berat+'&kurir='+kurir,
						success:function(hasil)
						{
							$("select[name=ongkir]").html(hasil);
						}
					})
				})
			});
			$(document).ready(function(){
				$("select[name=ongkir]").on("change",function(){
					var nama = $("option:selected",this).attr("nama");
					var biaya = $("option:selected",this).attr("biaya");
					var lama = $("option:selected",this).attr("lama");

					$("input[name=paket]").val(nama);
					$("input[name=biaya]").val(biaya);
					$("input[name=etd]").val(lama);
					$("#total_ongkir").html("Rp."+biaya);

					//total_belanja ditambah dengan biaya ongkir
					var total_belanja = $("input[name=total_belanja]").val();
					var total_ongkir = $("input[name=biaya]").val();

					//menjuhlahkan biaya ongkir dengan total belanja
					var total_bayar = parseInt(total_belanja)+parseInt(biaya);
					$("#total_bayar").html("Rp."+total_bayar);

					//menaruh ke inputan total bayar
					$("input[name=total_bayar]").val(total_bayar);
				})
			})
		</script>
	</body>
	</html>