<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require $root . '/PHPMailer/src/Exception.php';
require $root . '/PHPMailer/src/PHPMailer.php';
require $root . '/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailPrepare{
    public static function sendEmail(){  
        $mail = new PHPMailer(true);  
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.zoho.com';  //gmail SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'stefan.marcin@jazdectvoprekazdeho.sk';   //username
            $mail->Password = 'Takashi@27015';   //password
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;                    //smtp port
        
            $mail->setFrom('info@jazdectvoprekazdeho.sk', 'Contact Form');
            $mail->addAddress('stefan.marcin74@gmail.com', 'Stefan Marcin');
        
            //$mail->addAttachment(__DIR__ . '/attachment1.png');
            //$mail->addAttachment(__DIR__ . '/attachment2.jpg');
        
            $mail->isHTML(true);
        
            $mail->Subject = 'Email Subject';
            $mail->Body    = 'Email Body';
        
            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }
}
?>