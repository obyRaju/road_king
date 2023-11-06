<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$mail = new PHPMailer;

$name = !empty($_POST['name'])?$_POST['name']:'';
$phone = !empty($_POST['phone'])?$_POST['phone']:'';
$phone = !empty($_POST['message'])?$_POST['message']:'';

$emailBody = "";
//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'in-v3.mailjet.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'b925f3523b855aa9dd55bd40aacf9343';                 // SMTP username
$mail->Password = '47bb7cf81b7aa9e99d46361e60993db7';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->From = 'oby@alignminds.com';
$mail->FromName = 'Oby';
$mail->addAddress('obyraju@gmail.com', 'oby');     // Add a recipient
$mail->addReplyTo('oby@alignminds.com', 'Information');
$mail->addCC('oby@alignminds.com');
$mail->addBCC('oby@alignminds.com');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Booking';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo json_encode(array("status"=>"Error!", "message"=>"Something went wrong.Please Try again later.","type"=>"error"));
die();
} else {
    echo json_encode(array("status"=>"Success!", "message"=>"You successfully created your booking.","type"=>"success"));
die();
}

?>