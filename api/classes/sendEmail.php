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
        $body = '<b>Meno:</b> '. $contactInfo['name'] . '<br><b>Email:</b> ' . $contactInfo['email'] . '<br><b>Predmet:</b> ' . $contactInfo['subject'] . '<br><b>Správa:</b><br><br>' . $contactInfo['message'] . '<br><br><p>Odoslané zo stránky : '.$contactInfo['sentFrom'].'</p>';
        $from = array('address' => $to, 'familyName' => 'Jazdectvo pre každého');
        MailPrepare::sendEmail($to, $subject, $body, $from);
    }
}
?>