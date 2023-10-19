<?php 
// require_once('phpmailer/classes/class.phpmailer.php');
// require_once('phpmailer/classes/class.smtp.php');

session_start();
date_default_timezone_set("Asia/Jakarta");
$mysqli = new mysqli("localhost","root","","samiyatoko");

function crop($max_width, $max_height, $source_file, $dst_dir, $quality = 80)
{
	$imgsize = getimagesize($source_file);
	$width = $imgsize[0];
	$height = $imgsize[1];
	$mime = $imgsize['mime'];

	switch($mime)
	{
		case 'image/gif':
		$image_create = "imagecreatefromgif";
		$image = "imagegif";
		break;

		case 'image/png':
		$image_create = "imagecreatefrompng";
		$image = "imagepng";
		$quality = 7;
		break;

		case 'image/jpeg':
		$image_create = "imagecreatefromjpeg";
		$image = "imagejpeg";
		$quality = 80;
		break;

		default:
		return false;
		break;
	}

	$dst_img = imagecreatetruecolor($max_width, $max_height);
	$src_img = $image_create($source_file);

	$width_new = $height * $max_width / $max_height;
	$height_new = $width * $max_height / $max_width;
    //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
	if($width_new > $width){
        //cut point by height
		$h_point = (($height - $height_new) / 2);
        //copy image
		imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
	}else{
        //cut point by width
		$w_point = (($width - $width_new) / 2);
		imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
	}

	$image($dst_img, $dst_dir, $quality);

	if($dst_img)imagedestroy($dst_img);
	if($src_img)imagedestroy($src_img);
}
function tanggal_indo($input="",$delimeter="-")
{
	if (empty($input)) 
	{
		return "";
	}
	else
	{
		if ($delimeter=="-") 
		{
			$input_date = explode("-", $input);
		}
		elseif ($delimeter=="/")
		{
			$input_date = explode("/", $input);
		}
		$tahun = $input_date[0];
		$bulan = $input_date[1];
		$tanggal = $input_date[2];

		$array_bulan["1"] = "Januari";
		$array_bulan["01"] = "Januari";
		$array_bulan["2"] = "Februari";
		$array_bulan["02"] = "Februari";
		$array_bulan["3"] = "Maret";
		$array_bulan["03"] = "Maret";
		$array_bulan["4"] = "April";
		$array_bulan["04"] = "April";
		$array_bulan["5"] = "Mei";
		$array_bulan["05"] = "Mei";
		$array_bulan["6"] = "Juni";
		$array_bulan["06"] = "Juni";
		$array_bulan["7"] = "Juli";
		$array_bulan["07"] = "Juli";
		$array_bulan["8"] = "Agustus";
		$array_bulan["08"] = "Agustus";
		$array_bulan["9"] = "September";
		$array_bulan["09"] = "September";
		$array_bulan["10"] = "Oktober";
		$array_bulan["11"] = "November";
		$array_bulan["12"] = "Desember";

		return $tanggal.$delimeter.$array_bulan[$bulan].$delimeter.$tahun;
	}
}
function diantara_tanggal($tglmulai,$tglselesai)
{
	$tglselesai = date('Y-m-d',strtotime($tglselesai. '+ 1 days'));

	$periode = new DatePeriod(new DateTime($tglmulai),new DateInterval('P1D'),new DateTime($tglselesai));

	$semuatanggal = array();
	foreach ($periode as $key => $tiapperiode) 
	{
		$semuatanggal[] = $tiapperiode->format("Y-m-d");
	}
	return $semuatanggal;
}

class pelanggan 
{
	public $koneksi;
	function __construct($mysqli)
	{
		$this->koneksi = $mysqli;
	}
	function tampil_pelanggan() 
	{
		$ambildata = $this->koneksi->query("SELECT * FROM pelanggan");
		while($pecahdata = $ambildata->fetch_assoc())
		{
			$semuadata[] = $pecahdata;
		}
		return $semuadata;
	}
	function simpan_pelanggan($email,$pass,$nama,$telp,$alamat,$foto)
	{
		$namafoto = $foto['name'];
		$lokasifoto = $foto['tmp_name'];
		$waktu = date("YmdHis");
		$namafoto = $waktu.$namafoto;
		move_uploaded_file($lokasifoto, "../foto_pelanggan/$namafoto");

		$pass = sha1($pass);
		$this->koneksi->query("INSERT INTO pelanggan
			(email_pelanggan,password,nama_pelanggan,telp_pelanggan,alamat_pelanggan,foto_pelanggan) 
			VALUES('$email','$pass','$nama','$telp','$alamat','$namafoto')");
	}
	function login_pelanggan($email,$pass)
	{
		$pass = sha1($pass);
		$ambil = $this->koneksi->query("SELECT * FROM pelanggan 
			WHERE email_pelanggan='$email' AND password='$pass' ");

		$ygcocok = $ambil->num_rows;

		if($ygcocok==1)
		{
			$pelogin = $ambil->fetch_assoc();
			$_SESSION["pelanggan"]=$pelogin;
			return "sukses";
		}
		else
		{
			return "gagal";
		}

	}
	function hapus_pelanggan($idp)
	{
		$datapelanggan = $this->ambil_pelanggan($idp);
		$fotoygmaudihapus = $datapelanggan['foto_pelanggan'];
		if(file_exists("../foto_pelanggan/$fotoygmaudihapus"))
		{
			unlink("../foto_pelanggan/$fotoygmaudihapus");
		}
		$this->koneksi->query("DELETE FROM pelanggan 
			WHERE id_pelanggan='$idp'");
	}
	function ambil_pelanggan($idp)
	{
		$ambil = $this->koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$idp' ");
		$pecahdata = $ambil->fetch_assoc();
		return $pecahdata;
	}
	function ubah_pelanggan($email,$pass,$nama,$telp,$alamat,$foto,$id)
	{
		$namafoto = $foto['name'];
		$lokasifoto = $foto['tmp_name'];
		if(!empty($lokasifoto))
		{
			$datapelanggan = $this->ambil_pelanggan($id);
			$fotoygmaudihapus = $datapelanggan['foto_pelanggan'];
			if(file_exists("../foto_pelanggan/$fotoygmaudihapus"))
			{
				unlink("../foto_pelanggan/$fotoygmaudihapus");
			}
			move_uploaded_file($lokasifoto, "../foto_pelanggan/$namafoto");
			$this->koneksi->query("UPDATE pelanggan 
				SET email_pelanggan='$email',password='$pass',nama_pelanggan='$nama',telp_pelanggan='$telp',
				alamat_pelanggan='$alamat',foto_pelanggan='$namafoto' WHERE id_pelanggan='$id'");
		}
		else
		{
			$this->koneksi->query("UPDATE pelanggan 
				SET email_pelanggan='$email',password='$pass',nama_pelanggan='$nama',telp_pelanggan='$telp',
				alamat_pelanggan='$alamat' WHERE id_pelanggan='$id'");
		}
	}

}
class admin
{
	public $koneksi;
	function __construct($mysqli)
	{
		$this->koneksi = $mysqli;
	}
	function login_admin($em,$pas)
	{
		$pass = sha1($pas);
		$ambil = $this->koneksi->query("SELECT * FROM admin WHERE email='$em' AND password='$pass' ");
		$ygcocok = $ambil->num_rows;
		if($ygcocok==1)
		{
			$akun = $ambil->fetch_assoc();
			$_SESSION["admin"]=$akun;
			return "sukses";

		}
		else
		{
			return "gagal";
		}
	}
	function testimoni_status($id_testimoni)
	{
		$ambil = $this->koneksi->query("SELECT * FROM testimoni WHERE id_testimoni='$id_testimoni'");
		$pecah = $ambil->fetch_assoc();
		return $pecah;
	}
	function testimoni_terima($id_testimoni)
	{
		$status="Allowed";
		$this->koneksi->query("UPDATE testimoni SET status='$status' WHERE id_testimoni='$id_testimoni' ");
	}
	function testimoni_tolak($id_testimoni)
	{
		$status="Not Allowed";
		$this->koneksi->query("UPDATE testimoni SET status='$status' WHERE id_testimoni='$id_testimoni' ");
	}
	function tampil_ulasan_produk()
	{
		$semuadata = array();
		$ambil = $this->koneksi->query("SELECT * FROM ulasan u
			LEFT JOIN produk pd on u.id_produk=pd.id_produk 
			LEFT JOIN pembelian pm on u.id_pembelian=pm.id_pembelian
			LEFT JOIN pelanggan pl on pm.id_pelanggan=pl.id_pelanggan");
		while($pecah = $ambil->fetch_assoc())
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;

	}
	function ulasan_status($id_ulasan)
	{
		$ambil = $this->koneksi->query("SELECT * FROM ulasan u LEFT JOIN produk pd on u.id_produk=pd.id_produk WHERE id_ulasan='$id_ulasan'");
		$pecah = $ambil->fetch_assoc();
		return $pecah;
	}
	function terima_ulasan($id_ulasan)
	{
		$status="Allowed";
		$this->koneksi->query("UPDATE ulasan SET status='$status' WHERE id_ulasan='$id_ulasan'");
	}
	function tolak_ulasan($id_ulasan)
	{
		$status="Not Allowed";
		$this->koneksi->query("UPDATE ulasan SET status='$status' WHERE id_ulasan='$id_ulasan'");
	}


}
class kategori
{
	public $koneksi;
	function __construct($mysqli)
	{
		$this->koneksi = $mysqli;
	}
	function tampil_kategori()
	{
		$ambil = $this->koneksi->query("SELECT * FROM kategori");
		while($pecahdata = $ambil->fetch_assoc())
		{
			$semuadata[] = $pecahdata;
		}
		return $semuadata;
	}
	function simpan_kategori($nama)
	{
		$this->koneksi->query("INSERT INTO kategori (nama_kategori) VALUES ('$nama')");
	}
	function hapus_kategori($idkategori)
	{
		$this->koneksi->query("DELETE FROM kategori WHERE id_kategori='$idkategori'");		
	}
	function ambil_kategori($idkategori)
	{
		$ambil = $this->koneksi->query("SELECT * FROM kategori WHERE id_kategori='$idkategori'");
		$pecah = $ambil->fetch_assoc();
		return $pecah;
	}
	function ubah_kategori($nama,$idkategori)
	{
		$this->koneksi->query("UPDATE kategori SET nama_kategori='$nama' WHERE id_kategori='$idkategori'");
	}

}
class produk
{
	public $koneksi;
	function __construct($mysqli)
	{
		$this->koneksi = $mysqli;
	}
	function tampil_produk($batas=999999, $posisi=0)
	{
		$ambil = $this->koneksi->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori ORDER BY id_produk DESC LIMIT $posisi, $batas");
		while($var = $ambil->fetch_assoc()) 
		{
			$semuadata[] = $var;
		}
		return $semuadata;
	}
	function tampil_produk_paging($posisi,$batas)
	{
		$ambil = $this->koneksi->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori ORDER BY produk.id_produk DESC LIMIT $posisi,$batas");
		while($var = $ambil->fetch_assoc()) 
		{
			$semuadata[] = $var;
		}
		return $semuadata;

	}
	function tampil_produk_kategori($id_kategori,$batas=999999,$posisi=0)
	{
		$semuadata=array();

		$ambil = $this->koneksi->query("SELECT * FROM produk WHERE id_kategori='$id_kategori' ORDER BY id_produk DESC LIMIT $posisi, $batas ");
		while($produkkategori = $ambil->fetch_assoc())
		{
			$semuadata[] = $produkkategori;
		}
		return $semuadata;
	}
	function simpan_produk($kategori,$nama,$harga,$berat,$deskripsi,$stok,$foto)
	{
		$namafoto = $foto['name'];
		$lokasifoto = $foto['tmp_name'];
		$namafiks = date("Y-m-d-H-i-s")."_".$namafoto;
		move_uploaded_file($lokasifoto, "../foto_produk/$namafiks");
		crop(300, 300, "../foto_produk/".$namafiks, "../foto_produk/crop_".$namafiks, 100);
		$this->koneksi->query("INSERT INTO produk(id_kategori,nama_produk,harga_produk,berat_produk,deskripsi,stok_produk,foto_produk) VALUES ('$kategori','$nama','$harga','$berat','$deskripsi','$stok','$namafiks')") or die(mysqli_error($this->koneksi));
	}
	function ambil_produk($id_produk)
	{
		$ambil = $this->koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
		$pecah = $ambil->fetch_assoc();
		return $pecah;
	}
	function ubah_produk($kategori,$nama,$harga,$berat,$deskripsi,$foto,$id_produk)
	{
		$namafoto = $foto['name'];
		$lokasifoto = $foto['tmp_name'];
		if(empty($lokasifoto))
		{
			$this->koneksi->query("UPDATE produk SET id_kategori='$kategori',nama_produk='$nama',
				harga_produk='$harga',berat_produk='$berat',deskripsi='$deskripsi' WHERE id_produk='$id_produk'");
		}
		else
		{
			$detailproduk = $this->ambil_produk($id_produk);
			unlink("../foto_produk/".$detailproduk['foto_produk']);
			unlink("../foto_produk/crop_".$detailproduk['foto_produk']);

			$namafiks =  date("Y-m-d-H-i-s")."_".$nama_produk;
			move_uploaded_file($lokasifoto, "../foto_produk/$namafiks");
			crop(300, 300, "../foto_produk/".$namafiks, "../foto_produk/crop_".$namafiks, 100);
			$this->koneksi->query("UPDATE produk 
				SET id_kategori='$kategori',nama_produk='$nama',harga_produk='$harga',berat_produk='$berat',
				deskripsi='$deskripsi',foto_produk='$namafiks' WHERE id_produk='$id_produk'");
		}
	}
	function hapus_produk($id_produk)
	{
		$this->koneksi->query("DELETE FROM produk WHERE id_produk='$id_produk'");
	}
	function cari_produk($cari)
	{
		$semuadata=array();
		$ambil = $this->koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$cari%'");

		while($cariproduk = $ambil->fetch_assoc())
		{
			$semuadata[] = $cariproduk;
		}
		return $semuadata;
	}
	function tampil_galeri()
	{
		$ambil = $this->koneksi->query("SELECT * FROM galeri_produk JOIN produk ON galeri_produk.id_produk=produk.id_produk");
		while($var = $ambil->fetch_assoc()) 
		{
			$semuadata[] = $var;
		}
		return $semuadata;
	}
	// function simpan_galeri_produk($id_produk,$foto)
	// {
	// 	$namafoto = $foto["name"];
	// 	$lokasifoto = $foto["tmp_name"];
	// 	move_uploaded_file($lokasifoto, "../galeri_produk/$namafoto");

	// 	$this->koneksi->query("INSERT INTO galeri_produk(id_produk,foto_galeri_produk) VALUES('$id_produk','$namafoto')");
	// }
	function tambahfoto($nama_produk,$foto_produk,$idproduk)
	{
		$namafoto = $foto_produk["name"];
		$lokasifoto = $foto_produk["tmp_name"];
		$namafiks = date("Y-m-d-H-i-s")."_".$namafoto;
		move_uploaded_file($lokasifoto, "../galeri_produk/$namafiks");
		crop(300, 300, "../galeri_produk/".$namafiks, "../galeri_produk/crop_".$namafiks, 100);

		$this->koneksi->query("INSERT INTO galeri_produk(id_produk,nama_produk,foto_geleri_produk) VALUES('$idproduk','$nama_produk','$namafiks')")or die(mysqli_error($this->koneksi));
	}
	function ambilfoto($idproduk)
	{
		$ambil = $this->koneksi->query("SELECT * FROM galeri_produk WHERE id_produk='$idproduk'");
		while ($pecah = $ambil->fetch_assoc())
		{
			$semuafoto[] = $pecah;
		}
		return $semuafoto;

	}
	function cek_rating($id_produk)
	{
		$ambil = $this->koneksi->query("SELECT *,id_produk,ROUND(AVG(rating),1) as rata_rating FROM ulasan WHERE id_produk='$id_produk' GROUP BY id_produk");

		$pecah = $ambil->fetch_assoc();
		$rating = $pecah["rata_rating"];

		for ($i=1; $i <=5 ; $i++) 
		{ 
			if($i <= $rating)
			{
				echo "<i class='fas fa-star fa-yellow'></i>";
			}
			elseif($i - $rating == 0.5)
			{
				echo "<i class='fas fa-star-half-alt fa-yellow'></i>";
			}
			else
			{
				echo "<i class='fas fa-star'></i>";
			}
		}
		// echo is_numeric($rating)&&floor($rating)!=$rating ? "<i id='' class='fas fa-star-half-alt'></i>":"";
	}
}
class pembelian extends produk
{
	public $koneksi;
	function __construct($mysqli)
	{
		$this->koneksi = $mysqli;
	}
	function tampil_pembelian()
	{
		$ambil = $this->koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON 
			pembelian.id_pelanggan=pelanggan.id_pelanggan");
		while ($pecah = $ambil->fetch_assoc())
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;
	}
	function tampil_produk_pembelian($id_pembelian)
	{
		$semuadata=array();
		$ambil = $this->koneksi->query("SELECT * FROM pembeliandetail JOIN produk ON pembeliandetail.id_produk=produk.id_produk WHERE pembeliandetail.id_pembelian='$id_pembelian'");
		while($pecah = $ambil->fetch_assoc())
		{
			$semuadata[] =$pecah;
		}
		return $semuadata;

	}
	function ambil_pembelian($id_pembelian)
	{
		$ambil = $this->koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$id_pembelian'");
		$pecah = $ambil->fetch_assoc();
		return $pecah;
	}
	function laporan_pembelian($tglmulai,$tglselesai)
	{
		$status = array("pending","sudah bayar","lunas","kirim");
		$out = array();
		foreach ($status as $key => $tiapstatus) 
		{
			foreach (diantara_tanggal($tglmulai,$tglselesai) as $key => $tiaphari) 
			{
				$ambil = $this->koneksi->query("SELECT SUM(total_pembelian) AS total_pembelian FROM pembelian WHERE DATE(tanggal_pembelian)='$tiaphari' AND status_pembelian='$tiapstatus' ");
				$detail = $ambil->fetch_assoc();

				if (!empty($detail['total_pembelian'])) 
				{
					$out[$tiapstatus][$tiaphari] = $detail['total_pembelian'];
				}
				else
				{
					$out[$tiapstatus][$tiaphari] = "0";
				}

			}
		}
		return $out;
	}
	function laporan_pembelian_tahuna($tahun)
	{
		$bulans["01"]="Januari";
		$bulans["02"]="Januari";
		$bulans["01"]="Januari";
		$bulans["01"]="Januari";
		$bulans["01"]="Januari";
		$bulans["01"]="Januari";
		$bulans["01"]="Januari";
		$bulans["01"]="Januari";
		$bulans["01"]="Januari";
		$bulans["01"]="Januari";
		$bulans["11"]="November";
		$bulans["12"]="Desember";

		$out = array();
		foreach ($bulans as $angkabulan => $namabulan) 
		{
			$ambil = $this->koneksi->query("SELECT SUM(total_pembelian) AS total_pembelian FROM pembelian
				WHERE YEAR(tanggal_pembelian)='$tahun' AND MONTH(tanggal_pembelian)='$angkabulan' AND status_pembelian='kirim'");
			$detail = $ambil->fetch_assoc();
			if(!empty($detail['total_pembelian']))
			{
				$out[$namabulan] = $detail["total_pembelian"];
			}
			else
			{
				$out[$namabulan] = "0";
			}
		}
		return $out;

	}
	function ambil_pembayaran($id_pembelian)
	{
		$ambil = $this->koneksi->query("SELECT * FROM pembayaran 
			WHERE id_pembelian='$id_pembelian'");
		$pecah = $ambil->fetch_assoc();

		return $pecah;
	}
	function simpan_keranjang($id_produk,$jml)
	{
		if(isset($_SESSION['keranjang'][$id_produk]))
		{
			$_SESSION['keranjang'][$id_produk]['jml']+=$jml;
		}
		else
		{
			$_SESSION['keranjang'][$id_produk]['jml']=$jml;
		}
	}
	function tampil_keranjang()
	{
		if(isset($_SESSION['keranjang']))
		{
			$semuadata=array();
			foreach ($_SESSION['keranjang'] as $id_produk => $value) 
			{
				$dataproduk = $this->ambil_produk($id_produk);
				$dataproduk['jumlah_beli']=$value['jml'];
				$dataproduk['sub_berat']=$value['jml']*$dataproduk['berat_produk'];
				$dataproduk['sub_harga']=$value['jml']*$dataproduk['harga_produk'];

				$semuadata[]= $dataproduk;
			}

		}
		else
		{
			$semuadata=array();
		}
		return $semuadata;
	}
	function hapus_keranjang($id_produk)
	{
		unset($_SESSION['keranjang'][$id_produk]);
	}
	function tampil_pembelian_pelanggan($id_pelanggan)
	{
		$semuadata = array();
		$ambil = $this->koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
		while ($tiapdata = $ambil->fetch_assoc()) 
		{
			$semuadata[] = $tiapdata;
		}
		return $semuadata;
	}
	function ubah_status_pembelian($status,$id_pembelian)
	{
		$this->koneksi->query("UPDATE pembelian SET status_pembelian='$status'
			WHERE id_pembelian='$id_pembelian' ");

		if ($status=="lunas") 
		{
			$keterangan = "admin telah menerima pembayaran";
		}
		elseif ($status=="kirim")
		{
			$keterangan = "admin mengirimkan produk";
		}
		$waktu = date("Y-m-d-H-i-s");
		$this->koneksi->query("INSERT INTO pembelian_status(id_pembelian,status,keterangan,waktu) 
			VALUES ('$id_pembelian','sudah bayar','$keterangan','$waktu')");
	}
	function kirim_pembayaran($nama,$bank,$tglbayar,$jumlah,$bukti,$id_pembelian)
	{
		$namabukti = date("YmdHis").$bukti["name"];
		$lokasibukti = $bukti["tmp_name"];

		$tanggalkonfirmasi = date("Y-m-d");
		move_uploaded_file($lokasibukti, "bukti_pembayaran/".$namabukti);

		$this->koneksi->query("INSERT INTO pembayaran (id_pembelian,nama,bank,tanggal_bayar,tanggal_konfirmasi,jumlah,bukti) 
			VALUES ('$id_pembelian','$nama','$bank','$tglbayar','$tanggalkonfirmasi','$jumlah','$namabukti') ");

		$this->koneksi->query("UPDATE pembelian SET status_pembelian='sudah bayar' WHERE id_pembelian = '$id_pembelian' ");

		$keterangan = $nama." mengirimkan bukti pembayaran";
		$waktu = date("Y-m-d-H-i-s");
		$this->koneksi->query("INSERT INTO pembelian_status(id_pembelian,status,keterangan,waktu) 
			VALUES ('$id_pembelian','sudah bayar','$keterangan','$waktu')");
	}
	function simpan_pembelian($nama_penerima,$telpon_penerima,$alamat_lengkap,$total_belanja,$total_berat,$provinsi,$tipe,$kabkot,$kodepos,$kurir,$paket,$biaya,$etd,$total_bayar)
	{
		//memanggil fungsi keranjang yg sudah ada diatas
		$produk_keranjang = $this->tampil_keranjang();

		$yggagal=array();
		foreach ($produk_keranjang as $key => $tiap_produk) 
		{
			$id_produk = $tiap_produk["id_produk"];
			$jumlah_beli = $tiap_produk["jumlah_beli"];

			$ambil = $this->koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk' ");
			$dp = $ambil->fetch_assoc();
			if ($dp['stok_produk'] < $jumlah_beli)
			{
				$yggagal[] = $tiap_produk;
			}
		}
		//jika tidak kosong yg gagal
		if(!empty($yggagal))
		{
			return "gagal";
		}
		else
		{


			$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
			$tanggal_pembelian = date("Y-m-d H:i:s");
			$bataspembelian = date("Y-m-d H:i:s",strtotime("$tanggal_pembelian + 1 day"));
			$this->koneksi->query("INSERT INTO pembelian(id_pelanggan,tanggal_pembelian,batas_pembelian,status_pembelian,total_belanja,total_ongkir,total_pembelian,provinsi,distrik,tipe,kodepos_pengiriman,ekspedisi_pengiriman,paket_pengiriman,lama_pengiriman,nama_penerima,telp_penerima,alamat_penerima) VALUES('$id_pelanggan','$tanggal_pembelian','$bataspembelian','pending','$total_belanja','$biaya','$total_bayar','$provinsi','$kabkot','$tipe','$kodepos','$kurir','$paket','$etd','$nama_penerima','$telpon_penerima','$alamat_lengkap')") or die(mysql_error($this->koneksi));


			//mendapatkan id pembelian yg barusan dilakukan
			$id_pembelian_barusan = $this->koneksi->insert_id;

			foreach ($produk_keranjang as $key => $tiap_produk) 
			{
				$id_produk = $tiap_produk['id_produk'];
				$nama = $tiap_produk['nama_produk'];
				$harga = $tiap_produk['harga_produk'];
				$berat = $tiap_produk['berat_produk'];
				$jumlah = $tiap_produk['jumlah_beli'];
				$sub_berat = $tiap_produk['sub_berat'];
				$sub_harga = $tiap_produk['sub_harga'];

				$this->koneksi->query("INSERT INTO pembeliandetail(id_pembelian,id_produk,nama_produk,harga_produk,berat_produk,jumlah_produk,subberat_produk,subharga_produk) VALUES('$id_pembelian_barusan','$id_produk','$nama','$harga','$berat','$jumlah','$sub_berat','$sub_harga')");

				//mengurangi stok produk karna dibeli
				$this->koneksi->query("UPDATE produk
					SET stok_produk= `stok_produk` - $jumlah WHERE id_produk='$id_produk'");

			}
			$keterangan = "pelanggan".$_SESSION['pelanggan']['nama_pelanggan']." melakukan checkout";
			$this->koneksi->query("INSERT INTO pembelian_status(id_pembelian,status,keterangan,waktu) 
				VALUES('$id_pembelian_barusan','pending','$keterangan','$tanggal_pembelian')");

			//mengosongkan session keranjang karna sudah kesimpan didatabase
			unset($_SESSION['keranjang']);

			//outputkan id_pembelian_barusan sebagai id_pembelian pada nota
			return $id_pembelian_barusan;

		}
	}
	function simpan_ulasan($array_id_produk,$array_rating,$array_isi_ulasan,$id_pembelian)
	{
		$status="Pending";
		$tanggal = date("Y-m-d");

		foreach ($array_id_produk as $key => $isi_id_produk) 
		{
			$isi_rating = $array_rating[$key];
			$isi_ulasan = $array_isi_ulasan[$key];

			$this->koneksi->query("INSERT INTO ulasan(id_pembelian,id_produk,rating,isi,tanggal,status)VALUES('$id_pembelian','$isi_id_produk','$isi_rating','$isi_ulasan','$tanggal','$status')")or die(mysqli_error($this->koneksi));
		}
	}
	function ambil_ulasan($id_pembelian,$id_produk)
	{
		$ambil = $this->koneksi->query("SELECT * FROM ulasan WHERE id_pembelian='$id_pembelian' AND id_produk='$id_produk'");
		$pecah = $ambil->fetch_assoc();
		return $pecah;
	}
	function tampil_ulasan($id_produk)
	{
		$semuadata = array();
		$status = "Allowed";
		$ambil = $this->koneksi->query("SELECT * FROM ulasan u 
			LEFT JOIN pembelian pm on u.id_pembelian=pm.id_pembelian
			LEFT JOIN pelanggan pl on pm.id_pelanggan=pl.id_pelanggan WHERE u.id_produk='$id_produk'
			AND u.status='$status'");
		while($pecah = $ambil->fetch_assoc())
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;
	}
	function cek_pembatalan()
	{
		$saatini = date("Y-m-d H:i:s");
		$ambil = $this->koneksi->query("SELECT id_pembelian,status_pembelian,batas_pembelian FROM pembelian WHERE status_pembelian='pending' AND batas_pembelian < '$saatini'");

		while($tiap = $ambil->fetch_assoc())
		{
			$id_pembelian = $tiap['id_pembelian'];

			$this->koneksi->query("UPDATE pembelian SET status_pembelian='batal'
				WHERE id_pembelian='$id_pembelian'");

			//notifikasi email
		}
	}
}
class pengaturan
{
	public $koneksi;
	function __construct($mysqli)
	{
		$this->koneksi=$mysqli;
	}
	function tampil_pengaturan()
	{
		$ambil = $this->koneksi->query("SELECT * FROM pengaturan");
		while($pecah=$ambil->fetch_assoc())
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;
	}
	function ambil_pengaturan($id_pengaturan)
	{
		$ambil = $this->koneksi->query("SELECT * FROM pengaturan 
			WHERE id_pengaturan='$id_pengaturan'");
		$pecah = $ambil->fetch_assoc();
		return $pecah;
	}
	function ubah_pengaturan($isi,$id_pengaturan)
	{
		$this->koneksi->query("UPDATE pengaturan SET isi='$isi' 
			WHERE id_pengaturan='$id_pengaturan' ");
	}
	function ambil_isi_pengaturan($nama_kolom)
	{
		$ambil = $this->koneksi->query("SELECT * FROM pengaturan WHERE kolom='$nama_kolom'");
		$pecah = $ambil->fetch_assoc();
		return $pecah['isi'];
	}

}
class customer
{
	public $koneksi;
	function __construct($mysqli)
	{
		$this->koneksi=$mysqli;
	}
	function daftar_pelanggan($email,$nama,$tlp,$pass)
	{
		$this->koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
		$ygcocok = $ambil->num_rows;
		if($ygcocok == 1)
		{
			return 'gagal';
		}
		else
		{
			// $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			// $charactersLength = strlen($characters);
			// $password = '';
			// for ($i = 0; $i <= 5; $i++) {
			// 	$password .= $characters[rand(0, $charactersLength - 1)];
			// }

			$namafoto = "default.jpg";
			$pass = sha1($pass);
			$this->koneksi->query("INSERT INTO pelanggan
				(email_pelanggan,password,nama_pelanggan,telp_pelanggan,foto_pelanggan) 
				VALUES('$email','$pass','$nama','$telp','$namafoto')");
			
			// $mail = new PHPMailer();

			// $mail->IsSMTP();
			// $mail->SMTPSecure = 'ssl';
			// $mail->Host = "mail.apakabarmusa.com"; //hostname masing-masing provider email
			// $mail->SMTPDebug = 0;
			// $mail->Port = 465;
			// $mail->SMTPAuth = true;
			// $mail->Username = "info@apakabarmusa.com"; //user email
			// $mail->Password = "msvtoko00"; //password email
			// $mail->SetFrom("info@apakabarmusa.com","Apa Kabar Musa"); //set email pengirim
			// $mail->Subject = "Apa Kabar Musa | Pendaftaran"; //subyek email
			// $mail->AddAddress("labsekolahku@gmail.com","Lab Sekolah"); //tujuan email
			// $mail->addReplyTo("info@apakabarmusa.com", "apa kabar musa");


			// $isi_email  = "<table>";
			// $isi_email .= "<tr><th>Nama</th><th>Arif Nur Rohman</th></tr>";
			// $isi_email .= "<tr><th>Email</th><th>labsekolahku@gmail.com</th></tr>";
			// $isi_email .= "<tr><th>Password</th><th>$password</th></tr>";
			// $isi_email .= "</table>";
			// $mail->MsgHTML($isi_email);

			// $mail->Send();

			return 'sukses';

		}
	}
	function update_pelanggan($email,$nama,$kelamin,$telp,$alamat,$provinsi,$tipe,$kokab,$id_pelanggan)
	{

		$this->koneksi->query("UPDATE pelanggan SET email_pelanggan='$email',nama_pelanggan='$nama',jenis_kelamin='$kelamin',telp_pelanggan='$telp',alamat_pelanggan='$alamat',provinsi='$provinsi',tipe_kota='$tipe',kokab='$kokab' WHERE id_pelanggan='$id_pelanggan'") or die(mysqli_error($this->koneksi));

	}
	function ambil_provinsi()
	{
		$ambil = $this->koneksi->query("SELECT * FROM provinsi");
		while($provinsi = $ambil->fetch_assoc())
		{
			$dataprovinsi[] = $provinsi;
		}
		return $dataprovinsi;
	}
	function ambil_kota()
	{
		$datakota = array();
		$ambil = $this->koneksi->query("SELECT * FROM kota");
		while($kota = $ambil->fetch_assoc())
		{
			$datakota[] = $kota;
		}
		return $datakota;
	}
	function simpan_testimoni($id_pelanggan,$nama,$isi)
	{
		$status ="Pending";
		$this->koneksi->query("INSERT INTO testimoni(id_pelanggan, nama_pelanggan, isi, status) 
			VALUES ('$id_pelanggan','$nama','$isi','$status')")or die(mysqli_error($this->koneksi));
	}
	function ambil_testimoni()
	{
		$ambil = $this->koneksi->query("SELECT * FROM testimoni");
		while($testi=$ambil->fetch_assoc())
		{
			$datesti[] = $testi;
		}
		return $datesti;
	}
	function simpan_testimoni_status()
	{
		$status="Allowed";
		$ambil = $this->koneksi->query("SELECT * FROM testimoni WHERE status='$status'");
		while($pecah = $ambil->fetch_assoc())
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;
	}
	function hapus_testimoni($id_testi)
	{
		$this->koneksi->query("DELETE FROM testimoni WHERE id_testimoni='$id_testi'");

	}
}
class api
{
	function update_provinsi()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://pro.rajaongkir.com/api/province?id=",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: 25ac07716543d70bee96175bd541c2b5"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) 
		{
			echo "cURL Error #:" . $err;
		} 
		else 
		{
			$dataprovinsi = json_decode($response, true);
			$province = $dataprovinsi['rajaongkir']['results'];
			
			return $province;
		}
	}
	function update_kota($id_provinsi)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://pro.rajaongkir.com/api/city?id=&province=$id_provinsi",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: 25ac07716543d70bee96175bd541c2b5"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$datakota = json_decode($response, true);
			$city = $datakota['rajaongkir']['results'];
			
			return $city;
		}
	}
	function update_ongkir($id_kota_asal,$id_kota_tujuan,$berat,$kurir)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "origin=$id_kota_asal&originType=city&destination=$id_kota_tujuan&destinationType=city&weight=$berat&courier=$kurir",
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
				"key: 25ac07716543d70bee96175bd541c2b5"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
  			// echo $response;
			$dataongkir = json_decode($response, true);

			// echo "<pre>";
			// print_r($dataongkir);
			// echo "</pre>";
			$ongkir = $dataongkir['rajaongkir']['results']['0']['costs'];

			return $ongkir;
			

		}
	}
}

$pelanggan = new pelanggan($mysqli);
$admin = new admin($mysqli);
$kategori = new kategori($mysqli);
$produk = new produk($mysqli);
$pembelian = new pembelian($mysqli);
$pengaturan = new pengaturan($mysqli);
$customer = new customer($mysqli);
$api = new api();

?>
