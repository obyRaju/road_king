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
$phone = !empty($_POST['Phone_number'])?$_POST['Phone_number']:'';
$message = !empty($_POST['Msg'])?$_POST['Msg']:'';
$email = !empty($_POST['email'])?$_POST['email']:'';
$emailBody = "<!DOCTYPE html>
<html>
<body>
    <div>
        <section>
            <p>Dear sir/madam,</p>
            <div>
            $message
                <br><br>
                <div>
                <p>Best regards, </p>
                </div>
                <p>$name</p>
                <p>$phone</p>
                <p></p>
            </div>
        </section>
    </div>
</body>
</html>";

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

 $mail->isSMTP();                                      // Set mailer to use SMTP
 $mail->Host = 'smtp-relay.sendinblue.com';  // Specify main and backup SMTP servers
 $mail->SMTPAuth = true;                               // Enable SMTP authentication
 $mail->Username = 'support@safelimogcc.com';                 // SMTP username
 $mail->Password = 'OWBgJxGjynaV2UTf';                           // SMTP password
 $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
 $mail->Port = 587;                                    // TCP port to connect to

 $mail->From = $email;
 $mail->FromName = $name;
 $mail->addAddress('obyraju@gmail.com', 'oby');     // Add a recipient
 $mail->addReplyTo($email, $name);
 $mail->addCC('support@safelimogcc.com');
 $mail->addBCC('support@safelimogcc.com');

 $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
 $mail->isHTML(true);                                  // Set email format to HTML

 $mail->Subject = 'Inquiry/Feedback/Support - Safe Limo';
 $mail->Body    =  $emailBody;
 //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

 if(!$mail->send()) {
     echo json_encode(array("status"=>"Error!", "message"=>"Something went wrong.Please Try again later.","type"=>"error"));
 die();
 } else {
    echo json_encode(array("status"=>"Success!", "message"=>"Message has been sent successfully.","type"=>"success"));
    die();
 die();
 }

?>