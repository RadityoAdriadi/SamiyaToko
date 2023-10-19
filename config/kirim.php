<?php
require_once('phpmailer/classes/class.phpmailer.php');
require_once('phpmailer/classes/class.smtp.php');

$mail = new PHPMailer();


// echo "<pre>";
// print_r ($mail);
// echo "</pre>";

$mail->IsSMTP();
$mail->SMTPSecure = 'ssl';
$mail->Host = "mail.apakabarmusa.com"; //hostname masing-masing provider email
$mail->SMTPDebug = 0;
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "info@apakabarmusa.com"; //user email
$mail->Password = "msvtoko00"; //password email
$mail->SetFrom("info@apakabarmusa.com","Apa Kabar Musa"); //set email pengirim
$mail->Subject = "Apa Kabar Musa | Pendaftaran"; //subyek email
$mail->AddAddress("labsekolahku@gmail.com","Lab Sekolah"); //tujuan email
$mail->addReplyTo("info@apakabarmusa.com", "apa kabar musa");

	
$isi_email  = "<table>";
$isi_email .= "<tr><th>Nama</th><th>Arif Nur Rohman</th></tr>";
$isi_email .= "<tr><th>Email</th><th>labsekolahku@gmail.com</th></tr>";
$isi_email .= "<tr><th>Alamat</th><th>Yogyakarta</th></tr>";
$isi_email .= "</table>";
$mail->MsgHTML($isi_email);

$mail->Send();
?>