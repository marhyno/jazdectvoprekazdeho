<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once($_SERVER["DOCUMENT_ROOT"] . '/assets/google-api-php-client/vendor/autoload.php');

class GoogleIndexing{
  public function __construct() {
    // allocate your stuff
  }

  public static function requestGoogleIndexing($path) // $path = /path/to/dest/
  {  
    $client = new Google_Client();
    $newsIds = json_decode($path['allNews']);
    foreach($newsIds as $mydata)
    {
    // service_account_file.json is the private key that you created for your service account.
    $client->setAuthConfig($_SERVER["DOCUMENT_ROOT"] . '/assets/google-api-php-client/jazdectvo-pre-10b793743427.json');
    $client->addScope('https://www.googleapis.com/auth/indexing');

    // Get a Guzzle HTTP Client
    $httpClient = $client->authorize();
    $endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

    // Define contents here. The structure of the content is described in the next step.
    $content = '{
      "url": "https://jazdectvoprekazdeho.sk/clanok?nazov='.$mydata->slug .'",
      "type": "URL_UPDATED"
    }';

    $response = $httpClient->post($endpoint, [ 'body' => $content ]);
    $status_code = $response->getStatusCode();
    }
  }
}
