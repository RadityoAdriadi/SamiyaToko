<?php $datakategori = $kategori->tampil_kategori();?>

<!-- awal sidebar kategori -->
<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-bars"></i> Kategori</h3>
	</div>
	<div class="list-group">
		<?php foreach ($datakategori as $key => $value): ?>
			<a href="kategori.php?id=<?php echo $value['id_kategori'];?>" class="list-group-item"><?php echo $value["nama_kategori"]; ?></a>
		<?php endforeach ?>
	</div>
</div>
<!-- akhir sidebar kategori -->

<!-- awal sidebar terlaris -->
<div class="box">
	<div class="box-header">
		<h3 class="box-tittle">Terlaris</h3>
		<div class="box-tools" id="letaknavterlaris"></div>
	</div>
	<div class="box-body">
		<div class="owl-carousel owl-theme slider-terlaris">
			<div>
				<div class="imager-product">
					<img src="assets/img/produk/p10.jpg">
				</div>
				<h3 class="tittle-produk"> Nama Produk 10</h3>
				<span class="price-product">Rp.100.000</span>
				<a href="" class="btn btn-color">Detail</a>
				<a href="" class="btn btn-primary">Beli</a>
			</div>
			<div>
				<div class="imager-product">
					<img src="assets/img/produk/p19.jpg">
				</div>
				<h3 class="tittle-produk"> Nama Produk 9</h3>
				<span class="price-product">Rp.100.000</span>
				<a href="" class="btn btn-color">Detail</a>
				<a href="" class="btn btn-primary">Beli</a>
			</div>
			<div>
				<div class="imager-product">
					<img src="assets/img/produk/p8.jpg">
				</div>
				<h3 class="tittle-produk"> Nama Produk 8</h3>
				<span class="price-product">Rp.100.000</span>
				<a href="" class="btn btn-color">Detail</a>
				<a href="" class="btn btn-primary">Beli</a>
			</div>
		</div>
	</div>
</div>
<!-- akhir sidebar terlaris -->


<!-- awal sidebar testimoni -->
<div class="box">
	<div class="box-header">
		<h3 class="box-tittle">Testimoni</h3>
	</div>
	<div class="box-body">
		<div class="owl-carousel owl-theme slider-testimoni">
			<div class="text-center">
				<img src="assets/img/testimoni/arif.jpg" class="img-circle testimoni-image">
				<h4 class="testimoni-tittle"> Arif Nur Rohman</h4>
				<p class="testimoni-content">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. 
				</p>
			</div>
			<div class="text-center">
				<img src="assets/img/testimoni/asri.png" class="img-circle testimoni-image">
				<h4 class="testimoni-tittle"> Asri Fajar</h4>
				<p class="testimoni-content">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. 
				</p>
			</div>
			<div class="text-center">
				<img src="assets/img/testimoni/rizqa.jpg" class="img-circle testimoni-image">
				<h4 class="testimoni-tittle"> Rizqa Luviana</h4>
				<p class="testimoni-content">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. 
				</p>
			</div>
		</div>
	</div>
</div>
<!-- akhir sidebar testimoni -->

