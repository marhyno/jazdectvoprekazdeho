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

    public static function sendConfirmationMail($contactInfo)
    {
        $to = $contactInfo['email'];
        $subject = 'Potvrdenie registrácie jazdectvoprekazdeho.sk';
        $body = file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/api/mailTemplates/userRegistered.html');
        $body = str_replace("{{email}}",$contactInfo['email'],$body);
        $body = str_replace("{{token}}",$contactInfo['token'],$body);
        $from = array('address' => 'info@jazdectvoprekazdeho.sk', 'familyName' => 'Jazdectvo pre každého');
        MailPrepare::sendEmail($to, $subject, $body, $from);
    }

    public static function sendResetPassword($contactInfo)
    {
        $to = $contactInfo['email'];
        $subject = 'Reset hesla - jazdectvoprekazdeho.sk';
        $body = file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/api/mailTemplates/resetPassword.html');
        $body = str_replace("{{email}}",$contactInfo['email'],$body);
        $body = str_replace("{{resetToken}}",$contactInfo['token'],$body);
        $from = array('address' => 'info@jazdectvoprekazdeho.sk', 'familyName' => 'Jazdectvo pre každého');
        MailPrepare::sendEmail($to, $subject, $body, $from);
    }
}
?>