<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->CharSet = 'UTF-8';
    //$mail->isSMTP();                                            // Send using SMTP
    $mail->Host = 'mail.websenso.net';                    // Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   // Enable SMTP authentication
    $mail->Username = 'miw@websenso.net';                     // SMTP username
    $mail->Password = '%)g@{Z>75[6N';                               // SMTP password
    //  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    //  $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('miw@websenso.net', 'MIW Party');
    $mail->addAddress('langlersylvain@gmail.com');     // Add a recipient
    //$mail->addCC('miw@websenso.net');

    // Attachments
//    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body = file_get_contents('email/email_party.html');
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    //echo 'Message has been sent';
    header('Location: index.php?delivery=sent');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}