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
$data['access_token'] = "EAAGC7RcwZCmwBADBrxX63NwHspJ0T6L9jCQ09cZACGHLozCwSg2ZCIt6cIEFyWXD6qW6yNj9E5NxKF0uZAjWPe8TWSM3UIcuNXs1hkImbLhde5kZC0wHckZAO1cNo1T1XMQkSZAaqNQHRXZACOzIGK5Nk1rjXlGh6tggASiSmmXJ2vZBXhfd1MZAZCvUbtBQgWxqrhNxHRmWBzthwZDZD";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/v8.0/feed");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$return = curl_exec($ch);
echo $return;
curl_close($ch);


?>

