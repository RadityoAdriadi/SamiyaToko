<?php 
include 'config/class.php'; 

$city = $api->update_kota($_POST['idprovinsi']);
?>

<option value="">--Pilih Kota--</option>
 <?php foreach ($city as $key => $value): ?>
 	<option value="<?php echo $value['city_id']; ?>" nama="<?php echo $value['city_name']; ?>" kodepos="<?php echo $value['postal_code']; ?>" type="<?php echo $value['type']; ?>">
 		<?php echo $value['type']; ?> 
 		<?php echo $value['city_name']; ?>
 	</option>
 <?php endforeach ?>
