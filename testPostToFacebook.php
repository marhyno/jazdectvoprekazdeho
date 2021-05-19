<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$curl = curl_init();
   // Set some options - we are passing in a useragent too here
   curl_setopt_array($curl, array(
       CURLOPT_RETURNTRANSFER => 1,
       CURLOPT_SSL_VERIFYPEER => false,
       CURLOPT_URL => 'https://jazdectvoprekazdeho.sk/upcoming-events'
   ));
   // Send the request & save response to $resp
   $resp = curl_exec($curl);

$data = array();
$data['message'] = strip_tags($resp);
$data['link'] = "https://jazdectvoprekazdeho.sk/kalendar";
$data['access_token'] = "";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/1096185167215068/feed");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$return = curl_exec($ch);
echo $return;
curl_close($ch);


?>

