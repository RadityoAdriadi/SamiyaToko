<?php 
include 'config/class.php';

$id_kota = $_POST["id_kota"];
$berat = $_POST["berat"];
$kurir = $_POST["kurir"];
$dataongkir = $api->update_ongkir(419,$id_kota,$berat,$kurir);
// echo "<pre>";
// print_r($dataongkir);
// echo "</pre>";
 ?>

<option value="">--Pilih Ongkir--</option>
 <?php foreach ($dataongkir as $key => $value): ?>
 	<option value="" nama="<?php echo $value['service'] ?>" biaya="<?php echo $value['cost']['0']['value']; ?>" lama="<?php echo $value['cost']['0']['etd'] ?>" >
 		<?php echo $value['service']; ?>
 		Rp. <?php echo number_format($value['cost']['0']['value']); ?> 
 		<?php echo $value['cost']['0']['etd']; ?> Hari
 	</option>
 <?php endforeach ?>