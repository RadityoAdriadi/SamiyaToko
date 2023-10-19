<!--  Awal Topbar -->
<div class="topbar">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-6">
				<div class="contact">
					<ul>
						<li><i class="fas fa-phone"></i> 0877-0817-0491</li>
						<li><i class="fa fa-envelope"></i> rdt@blabla.com</li>
						<li><i class="fa fa-map-marker"></i> Bantul, Yogyakarta</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Akhir top bar -->
<!-- Awal Header -->
<header class="header">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="logo">
					<img src="assets/img/logo.png" alt="" class="img-responsive">	
				</div>
			</div>
			<div class="col-md-6">
				<div class="search">
					<form method="GET" action="produk.php">
						<div class="form-group">
							<div class="input-group" >
								<input type="text" class="form-control" placeholder="Cari berdasarkan nama ...." name="cari">
								<span class="input-group-btn">
									<button class="btn btn-color">
										<i class="fa fa-search"></i>
									</button>
								</span>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-3">
				<div class="keranjang">
					<div class="btn-group">
						<a href="" class="btn btn-color">
							<i class="fa fa-shopping-bag"></i>
						</a>
						<a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Keranjang <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="">Produk 1</a></li>
							<li><a href="">Produk 2</a></li>
							<li><a href="">Produk 3</a></li>
							<li class="divider"></li>
							<li><a href="">lihat keranjang</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<!-- akhir header -->
<!-- awal nav -->
<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-targets=".naff">
				<span class="sr-only"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">SAMIYA TOKO</a>
		</div>
		<div class="navbar-collapse collapse naff">
			<ul class="nav navbar-nav">
				<li><a href="produk.php">PRODUK</a></li>
				<li><a href="#">BLOG</a></li>
				<?php if (isset($_SESSION['pelanggan'])): ?>
					<li><a href="keranjang.php">KERANJANG</a></li>
					<!-- <li><a href="checkout.php">CHECK OUT</a></li> -->
					<li><a href="member.php">MEMBER</a></li>
				<?php endif ?>
			</ul>
			<form method="GET" action="pencarian.php" class="navbar-form navbar-right">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Cari berdasarkan nama..." name="cari">
				</div>
				<button type="submit" class="btn btn-success">CARI</button>
			</form>
		</div>
	</div>
</nav>
<!-- akhir nav -->