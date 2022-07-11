<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// require_once "src/PHPMailer.php";
// require_once "src/SMTP.php";
// require_once "src/Exception.php";


date_default_timezone_set("Europe/Rome");

// Load Composer's autoloader
require 'vendor/autoload.php';

 $name = $_POST['name'];
 $lastname = $_POST['lastname'];
 $email = $_POST['email'];
 $subject = $_POST['subject'];
 $message = $_POST['message'];


if (isset($_POST['submit'])) {
//Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    //Server settings
    // $mail->SMTPDebug = ;                //Enable verbose debug output
    $mail->isSMTP();                                      //Send using SMTP
    $mail->Host = 'ssl0.ovh.net';            //Set the SMTP server to send through
    $mail->SMTPAuth = true;//Enable SMTP authentication
    $mail->CharSet = 'utf-8';
    $mail->Username = 'colin.regamey@colinrgm.ch';                        //SMTP username
    $mail->Password = 'Cameroun_99';                           //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      //Enable implicit TLS encryption
    // $mail->SMTPSecure = 'tls';      //Enable implicit TLS encryption
    $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($email, $name . ' ' . $lastname);
    $mail->addAddress('colin.regamey@colinrgm.ch');     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = $message;

    $envoyer = $mail->send();
}