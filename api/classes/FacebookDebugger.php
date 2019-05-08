<?php
	class FacebookDebugger
	{
        function __construct() {
        }
		/*
		 * https://developers.facebook.com/docs/opengraph/using-objects
		 *
		 * Updating Objects
		 *
		 * When an action is published, or a Like button pointing to the object clicked,
		 * Facebook will 'scrape' the HTML page of the object and read the meta tags.
		 * The object scrape also occurs when:
		 *
		 *      - Every 7 days after the first scrape
		 *
		 *      - The object URL is input in the Object Debugger
		 *           http://developers.facebook.com/tools/debug
		 *
		 *      - When an app triggers a scrape using an API endpoint
		 *           This Graph API endpoint is simply a call to:
		 *
		 *           POST /?id={object-instance-id or object-url}&scrape=true
		 */
		public function reload($url)
		{
            $graph = 'https://graph.facebook.com/v2.9/?scrape=true&id=';
            $appId = '425429784657516';
            $access_token = '72a16509811a18471c4b630b683c14d7';
            $post = urlencode($url).'&access_token=' .$appId.'|'.$access_token;
            $graph = $graph . $post;
			return $this->send_post($graph);
		}
		private function send_post($url)
		{
            $r = curl_init();
            $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36 OPR/58.0.3135.132';
			curl_setopt($r, CURLOPT_URL, $url);
            curl_setopt($r, CURLOPT_POST, 1);
            curl_setopt($r, CURLOPT_USERAGENT , $userAgent);
			curl_setopt($r, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($r, CURLOPT_CONNECTTIMEOUT, 5);
			$data = curl_exec($r);

            if(curl_errno($r)){
                echo 'Curl error: ' . curl_error($r);
            }
            curl_close($r);
			return $data;
		}
    }
?>