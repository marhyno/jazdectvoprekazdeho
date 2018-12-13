<?php
class sendEmail
{
    public function __construct() {
        // allocate your stuff
    }

    public static function sendFastEmail($contactInfo)
    {
        $to = 'info@jazdectvoprekazdeho.sk';
        $subject = 'Nová správa z jazdectvoprekazdeho.sk';
        $body = $contactInfo['message'] . '<br><br><p>Odoslané zo stránky : '.$contactInfo['sentFrom'].'</p>';
        $from = array('address' => $contactInfo['email'], 'familyName' => $contactInfo['name']);
        MailPrepare::sendEmail($to, $subject, $body, $from);
    }
}
?>