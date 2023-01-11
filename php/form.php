<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "../PHPMailer-master/src/PHPMailer.php";

require_once "vendor/autoload.php";

require_once realpath(__DIR__ . '/vendor/autoload.php');

// Looing for .env at the root directory
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$recaptcha = $_POST['g-recaptcha-response'];
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
    $mail->Username = $_ENV["USER_NAME"];
    $mail->Password = $_ENV["PASSWORD"];
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
        $res = reCaptcha($recaptcha);
        var_dump($res);
        if ($res['success']) {
            $mail->send();
            echo "Message has been sent successfully";
            header('Location : https://colinrgm.ch/contact.html?message=success');
        } else {
           header('Location : https://colinrgm.ch/contact.html?message=error');
        }


    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
    }
}

function reCaptcha($recaptcha)
{
    $secret = "6Lext84jAAAAAKL-uJPTSYeWlDoIeeHV3_xIjIJO";
    $ip = $_SERVER['REMOTE_ADDR'];

    $postvars = array("secret" => $secret, "response" => $recaptcha, "remoteip" => $ip);
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
    $data = curl_exec($ch);
    curl_close($ch);

    return json_decode($data, true);
}