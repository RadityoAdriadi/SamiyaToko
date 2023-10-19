<?php $datakategori = $kategori->tampil_kategori();?>

<nav class="navbar navbar-default" id="main-nav"> 
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
        <li><a href="produk.php?page=1">PRODUK</a></li>
        <li><a href="testimoni.php">TESTIMONI</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kategori<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php foreach ($datakategori as $key => $value): ?>
              <li><a href="kategori.php?id=<?php echo $value['id_kategori'];?>"><?php echo $value["nama_kategori"]; ?></a></li>
            <?php endforeach ?>
          </ul>
        </li>
        <!-- <li><a href="#">BLOG</a></li> -->
        <?php if (!isset($_SESSION['pelanggan'])): ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Masuk<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href='login.php'>LOGIN</a></li>
              <li><a href='daftar.php'>DAFTAR</a></li>
            </ul>
          </li>
        <?php endif ?>
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
