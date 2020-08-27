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
        $from = array('address' => $to, 'familyName' => 'Jazdectvo pre každého', 'replyTo'=>$contactInfo['email']);
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

    public static function informOwnerOfPortalAboutNewArticle()
    {
        $to = getData("SELECT email FROM users WHERE userType='superadmin'",null)[0]['email'];
        $subject = 'Nový článok je pripravený - jazdectvoprekazdeho.sk';
        $body = '<b>Ahoj majitel,</b><br><br><p>Na portál bol pridaný nový článok, mrkni na to :).</p>';
        $from = array('address' => $to, 'familyName' => 'Jazdectvo pre každého');
        MailPrepare::sendEmail($to, $subject, $body, $from);
    }

    public static function informOwnerAboutExpiringAdverts($contactInfo)
    {
        //preparation
        $to = $contactInfo['email'];
        $titles = explode(',', $contactInfo['titles']);
        $itemIds = explode(',', $contactInfo['itemIds']);

        $subject = 'Váš inzerát o 2 dni expiruje - jazdectvoprekazdeho.sk';
        $body = 'Dobrý deň,<br><p>Chceli by sme Vás upozorniť na blížiacu sa expiráciu inzerátu.</p>';
        $body .= 'Zoznam inzerátov ktoré expirujú o 2 dni: <ul>';
        $x = 0;
        foreach ($itemIds as $singleId) {
            $body .= "<li><a href='https://jazdectvoprekazdeho.sk/inzerat?ID=" . $singleId ."' target=_blank>".$titles[$x]."</a></li>";
            $x++;
        }
        $body .= '</ul>';
        $body .= '<p>Aby ste predĺžili platnosť inzerátu o ďalšie dva mesiace, stačí editovať inzerát.';
        $body .= '<br><br>S pozdravom,';
        $body .= '<br>Jazdectvo pre každého';
        $body .= '<br><a href="https://jazdectvoprekazdeho.sk/">www.jazdectvoprekazdeho.sk</a>';
        $body .= '<br>Ak máte akúkoľvek otázku alebo ste narazili na problém, odpovedzte na tento email.</p>';
        $from = array('address' => 'info@jazdectvoprekazdeho.sk', 'familyName' => 'Jazdectvo pre každého');
        MailPrepare::sendEmail($to, $subject, $body, $from);
    }

    public static function informOwnerAboutDeletionOfAdverts($contactInfo)
    {
        //preparation
        $to = $contactInfo['email'];
        $titles = explode(',', $contactInfo['titles']);
        $itemIds = explode(',', $contactInfo['itemIds']);

        $subject = 'Váš inzerát expiroval - jazdectvoprekazdeho.sk';
        $body = 'Dobrý deň,<br><p>Chceli by sme Vás upozorniť, že niektoré z Vašich inzerátov expirovali.</p>';
        $body .= 'Zoznam inzerátov ktoré expirovali: <ul>';
        $x = 0;
        foreach ($itemIds as $singleId) {
            $body .= "<li>".$titles[$x]."</li>";
            $x++;
        }
        $body .= '</ul>';
        $body .= '<p>S pozdravom,';
        $body .= '<br>Jazdectvo pre každého';
        $body .= '<br><a href="https://jazdectvoprekazdeho.sk/">www.jazdectvoprekazdeho.sk</a>';
        $body .= '<br>Ak máte akúkoľvek otázku alebo ste narazili na problém, odpovedzte na tento email.</p>';
        $from = array('address' => 'info@jazdectvoprekazdeho.sk', 'familyName' => 'Jazdectvo pre každého');
        MailPrepare::sendEmail($to, $subject, $body, $from);
    }

    public static function sendMessageToAdvertiser($advertDetails){
        $to = getData("SELECT email FROM market WHERE ID=:advertId",array('advertId'=>$advertDetails['advertId']))[0]['email'];
        $subject = 'Nová správa z jazdectvoprekazdeho.sk - Inzerát';
        $body = 'Bola odoslaná nová správa zo stránky jazdectvoprekazdeho.sk ohľadom inzerátu<br><br><b>Email:</b> ' . $advertDetails['messageEmail'] . '<br><b>Správa:</b><br>' . $advertDetails['message'] . '<br><br><p>Odoslané zo stránky <a href="https://jazdectvoprekazdeho.sk/inzerat?ID='.$advertDetails['advertId'].'">www.jazdectvoprekazdeho.sk</a></p>';
        $from = array('address' => $advertDetails['messageEmail'], 'familyName' => $advertDetails['messageEmail']);
        MailPrepare::sendEmail($to, $subject, $body, $from);
    }
}
?>