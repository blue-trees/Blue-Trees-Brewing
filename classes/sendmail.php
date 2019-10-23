<?php

        // email部分

/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Include the Composer generated autoload.php file. */
// require '../vendor/autoload.php';
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
function sendMail($email, $body, $subject, $name) {

    $mail = new PHPMailer;

    try {
       
       $mail->setFrom('sylvaticas@gmail.com', 'Blue Tree');
       $mail->addAddress($email, $name);
       $mail->Subject = $subject;
       $mail->Body = $body;
       
       /* SMTP parameters. */
       
       /* Tells PHPMailer to use SMTP. */
       $mail->isSMTP();
       
       /* SMTP server address. */
       $mail->Host = 'smtp.gmail.com';
    
       /* Use SMTP authentication. */
       $mail->SMTPAuth = TRUE;
       
       $mail->SMTPDebug = 2;
       /* Set the encryption system. */
       $mail->SMTPSecure = 'ssl';
       
       /* SMTP authentication username. */
       $mail->Username = 'richardifyreal@gmail.com';
       
       /* SMTP authentication password. */
       $mail->Password = 'Nemodark09!!';
       
       /* Set the SMTP port. */
       $mail->Port = 465;
       
       /* Finally send the mail. */
       if($mail->send()) {
           return true;
       }
    }
    catch (Exception $e)
    {
       echo "Message not sent" . $e->errorMessage();
    }
    catch (\Exception $e)
    {
        echo "Message not sent" .  $e->getMessage();
    }

}
