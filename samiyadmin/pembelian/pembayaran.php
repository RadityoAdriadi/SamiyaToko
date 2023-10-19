<?php 
$id_pembelian = $_GET["id"];
$detailbayar = $pembelian->ambil_pembayaran($id_pembelian);

$detailbeli = $pembelian->ambil_pembelian($id_pembelian);

	// echo "<pre>";
	// print_r($detailbayar);
	// echo "</pre>";
?>

		<div class="panel-info">
			<div class="panel-heading text-center"><h3>Halaman Pembayaran</h3></div>
			<div class="panel-body">
				<table class="table">
					<tr>
						<td>Nama:</td>
						<td><?php echo $detailbayar['nama']; ?></td>
					</tr>
					<tr>
						<td>Bank:</td>
						<td><?php echo $detailbayar['bank']; ?></td>
					</tr>
					<tr>
						<td>Jumlah:</td>
						<td>Rp. <?php echo number_format($detailbayar['jumlah']); ?></td>
					</tr>
					<tr>
						<td>Tanggal Bayar:</td>
						<td><?php echo tanggal_indo($detailbayar['tanggal_bayar']); ?></td>
					</tr>
					<tr>
						<td>Tanggal Konfirmasi:</td>
						<td><?php echo tanggal_indo($detailbayar['tanggal_konfirmasi']); ?></td>
					</tr>
				</table>
				<div class="col-md-6">
					<img src="../bukti_pembayaran/<?php echo $detailbayar['bukti'] ?>" class="img-responsive">
				</div>
			</div>
		</div>
		
		<div class="well">
			<p>
				<i class="fa fa-alert"></i>Ubah status ke <strong>Lunas</strong> jika sudah menerima pembayaran.
			</p>
		</div>
		<form method="post">
			<div class="form-group">
				<label>Status Pembelian</label>
				<select class="form-control" name="status">
					<option value="">--Pilih Status--</option>
					<option value="pending" <?php if($detailbeli['status_pembelian']=="pending"){echo "selected";} ?>  >Pending</option>
					<option value="sudah bayar" <?php if($detailbeli['status_pembelian']=="sudah bayar"){echo "selected";} ?>  >Sudah Bayar</option>
					<option value="lunas" <?php if($detailbeli['status_pembelian']=="lunas"){echo "selected";} ?>  >Lunas</option>
					<option value="kirim" <?php if($detailbeli['status_pembelian']=="kirim"){echo "selected";} ?>  >Kirim</option>
				</select>
			</div>
			<button class="btn btn-primary" name="ubah"> Ubah Status</button>
		</form>
	



<?php 
if(isset($_POST['ubah']))
{
	$pembelian->ubah_status_pembelian($_POST['status'],$id_pembelian);

	echo "<script>alert('Berhasil Dirubah');</script>";
	echo "<script>location='index.php?halaman=pembayaran&id=$id_pembelian';</script>";}
	?>
