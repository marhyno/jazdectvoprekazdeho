<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require $root . '/PHPMailer/src/Exception.php';
require $root . '/PHPMailer/src/PHPMailer.php';
require $root . '/PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 class MailPrepare{
    public function __construct() {
        // allocate your stuff
    }
     public static function sendEmail($to, $subject, $body, $from = null){
        if ($from == null){
            $from = array('address' => 'info@jazdectvoprekazdeho.sk', 'familyName' => 'Jazdectvo pre každého');
        }  
        $mail = new PHPMailer(true);  
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.zoho.com';  //gmail SMTP server
            $mail->SMTPAuth = true;
            $mail->CharSet = 'UTF-8';
            $mail->Username = 'stefan.marcin@jazdectvoprekazdeho.sk';   //username
            $mail->Password = 'Takashi@27015';   //password
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;                    //smtp port
        
            $mail->setFrom($from['address'], $from['familyName']);
            $mail->addAddress($to);
        
            //$mail->addAttachment(__DIR__ . '/attachment1.png');
            //$mail->addAttachment(__DIR__ . '/attachment2.jpg');
        
            $mail->isHTML(true);
        
            $mail->Subject = $subject;
            $mail->Body = $body;
        
            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                header('HTTP/1.0 503 Bad error');
            } else {
                echo 'Message has been sent';
            }
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            header('HTTP/1.0 503 Bad error');
        }
    }
}
?> 