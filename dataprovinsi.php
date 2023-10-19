<?php
include 'config/class.php';  
$provinsi = $api->update_provinsi();
 ?>
 <?php foreach ($provinsi as $key => $value): ?>
 	<option value="<?php echo $value['province_id']; ?>" nama="<?php echo $value['province']; ?>"><?php echo $value['province']; ?></option>
 <?php endforeach ?>



