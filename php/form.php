<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "../PHPMailer-master/src/PHPMailer.php";

require_once "vendor/autoload.php";

 $subject = $_POST['subject'];
 $message = $_POST['message'];

if (isset($_POST['submit'])) {
// Créer une instance de classe PHPMailer
    $mail = new PHPMailer;
// Authentification via SMTP
    $mail->isSMTP();
    $mail->SMTPAuth = true;
// Connexion
    $mail->Host = "mail.infomaniak.com";
    $mail->Port = "465";
    $mail->Username = "colin.regamey@colinrgm.ch";
    $mail->Password = "4P33T-CxL!ah!d$";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    $mail->From = 'colin.regamey@colinrgm.ch';
    $mail->FromName = 'Colin';

    $mail->addAddress('colin.regamey@colinrgm.ch');

    $mail->Subject = $subject;
    $mail->Body = $message;

    try {
        $mail->send();
        echo "Message has been sent successfully";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
    }
}