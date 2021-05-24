<?php
$secret = $_GET['secret'];
if ($secret != 'fromActiveCronJob'){
    echo 'wrong access token';
    return;
}

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
$data['message'] = trim(preg_replace('/\s\s+/', ' ', $data['message']));
$data['message'] = str_replace("ANGLICKÉ",chr(10).chr(10)."ANGLICKÉ",$data['message']);
$data['message'] = str_replace("WESTERNOVÉ",chr(10).chr(10)."WESTERNOVÉ",$data['message']);
$data['message'] = str_replace("###############",chr(10).chr(10)."###############".chr(10),$data['message']);
$data['message'] = str_replace("FEI LIVE STREAMY",chr(10).chr(10)."FEI LIVE STREAMY",$data['message']);
$data['message'] = str_replace("🐴",chr(10).chr(10)."🐴",$data['message']);
$data['link'] = "https://jazdectvoprekazdeho.sk/kalendar";
$data['access_token'] = "EAAGC7RcwZCmwBACSUSSYuLDAKQvwl3Sh5627ZBMQRVKrG6w0s6neeAEUC8ZAOEKZAMx9R3QgAxr3JWKH3DicrUEsQbyH1xv8at9BOe1LPuvPfC1xd5fL5TcgAIE6GV6UTbWDoDUTutU8dEkyZC36Rd4qsQrLnHd9ZBtzrMCgBfudUn3I9SQPXz";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/1096185167215068/feed");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$return = curl_exec($ch);
echo $return;
curl_close($ch);


?>

