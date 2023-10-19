<?php 
$id_pembelian = $_GET["id"];
// echo "$id_pembelian";

$produkpembelian = $pembelian->tampil_produk_pembelian($id_pembelian);
// echo "<pre>";
// print_r($produkpembelian);
// echo "</pre>";
$detail = $pembelian->ambil_pembelian($id_pembelian);
// echo "<pre>";
// print_r($detail);
// echo "</pre>";
?>

<div class="panel-info">
	<div class="panel-heading"><h3>Nota Pembelian</h3></div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-4">
				<h3>Pembelian</h3>
				<p>No: <?php echo $detail['id_pembelian'];?></p>
				<p>Tanggal: <?php echo $detail['tanggal_pembelian']; ?></p>
				<p>Status: <span class="btn btn-danger btn-xs"><?php echo $detail['status_pembelian']; ?></span></p>
			</div>
			<div class="col-md-4">
				<h3>Pelanggan</h3>
				<p>Pelanggan: <?php echo $detail['nama_pelanggan']; ?> </p>
				<p>Telepon: <?php echo $detail['telp_pelanggan']; ?> </p>
				<p>Email: <?php echo $detail['email_pelanggan']; ?> </p>
				<p>Alamat: <?php echo $detail['alamat_pelanggan']; ?> </p>
			</div>
			<div class="col-md-4">
				<h3>Pengiriman</h3>
				<p>
					<?php echo $detail['tipe']; ?>
					<?php echo $detail['distrik']; ?>
					<?php echo $detail['provinsi']; ?>
					<?php echo $detail['kodepos_pengiriman']; ?>
				</p>
				<p>Nama Penerima: <?php echo $detail['nama_penerima']; ?></p>
				<p>Telepon Penerima: <?php echo $detail['telp_penerima']; ?></p>
				<p>Alamat Penerima: <?php echo $detail['alamat_penerima']; ?></p>
				<p>
					Pengiriman: <?php echo $detail['ekspedisi_pengiriman']; ?> <?php echo $detail['paket_pengiriman']; ?>, 
				</p>
				<p>Estimasi Pengiriman: <?php echo $detail['lama_pengiriman']; ?> Hari.</p>
			</div>
		</div>
	</div>
</div>
<hr>

<table class="table table-bordered table-hover table-striped">
	<thead>
		<tr>
			<th>No</th>
			<th>Produk</th>
			<th>Berat</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Sub berat</th>
			<th>Sub Harga</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($produkpembelian as $key => $value): ?>
			<tr>
				<td><?php echo $key+1; ?></td>
				<td><?php echo $value['nama_produk']; ?></td>
				<td><?php echo $value['berat_produk']; ?></td>
				<td>Rp. <?php echo number_format($value['harga_produk']);?></td>
				<td><?php echo $value['jumlah_produk']; ?></td>
				<td><?php echo $value['subberat_produk']; ?></td>
				<td>Rp. <?php echo number_format($value['subharga_produk']); ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="6">Total Belanja</th>
			<th>Rp.<?php echo number_format($detail['total_belanja']); ?></th>
		</tr>
		<tr>
			<th colspan="6">Total Ongkos Kirim</th>
			<th>Rp.<?php echo number_format($detail['total_ongkir']); ?></th>
		</tr>
		<tr>
			<th colspan="6">Total Pembelian</th>
			<th>Rp.<?php echo number_format($detail['total_pembelian']); ?></th>
		</tr>
	</tfoot>
</table>

