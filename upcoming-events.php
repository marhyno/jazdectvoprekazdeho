<?php
error_reporting(0);
echo "<div style='text-align:center'>";
echo '<meta property="og:image" content="https://' . $_SERVER['HTTP_HOST'] . '/img/upcomingEvents.png"/>';
echo '<meta property="fb:app_id" content="425429784657516"/>';
echo '<meta property="og:title" content="Jazdectvo pre každého" />';
echo '<img src="https://' . $_SERVER['HTTP_HOST'] . '/img/upcomingEvents.png"><br>';
//SJF
   $curl = curl_init();
   // Set some options - we are passing in a useragent too here
   curl_setopt_array($curl, array(
       CURLOPT_RETURNTRANSFER => 1,
       CURLOPT_SSL_VERIFYPEER => false,
       CURLOPT_URL => 'https://www.sjf.sk/?plugin=all-in-one-event-calendar&controller=ai1ec_exporter_controller&action=export_events&xml=true'
   ));
   // Send the request & save response to $resp
   $resp = curl_exec($curl);
   $xml=simplexml_load_string($resp) or die("Error: Cannot create object");

   $today = date('Ymd',strtotime("last monday")); //set up for MONDAY
   $next7Days = date('Ymd',strtotime('last monday + 7 days'));

   echo '<br><h4>Program na tento týždeň (' . date('d',strtotime("last monday")) .' - '.date('d.m.Y',strtotime($today . ' + 7 days')).'):</h4><br>';
   echo '<h2>ANGLICKÉ JAZDENIE</h2>';
   echo '############### <br><br>';

   foreach ($xml -> vevent as $singleEvent) {
       $eventStart = $singleEvent -> dtstart;
       $eventEnd = $singleEvent -> dtend;
       if ($eventStart >= $today && $eventEnd <= $next7Days){
           echo 🐴;
           echo '<b> ' . date('d.m.Y',strtotime($singleEvent -> dtstart)) . ' - ';
           if ($singleEvent -> dtstart !== $singleEvent -> dtend){
            echo date('d.m.Y',strtotime($singleEvent -> dtend) - 1) . ' - '; //based on SJF Site
           }
           echo '</b>'.$singleEvent -> summary . ' - ';
           echo '@' . $singleEvent -> location;
           echo ' (' . $singleEvent -> categories . ') - ';
           $linkToShow = $pretty ? "LINK" : $singleEvent -> url ->attributes() -> uri;
           echo '<a href="'.$singleEvent -> url ->attributes() -> uri . '">'. $linkToShow . '</a><br><br>';
       }
   }
   

//END SJF

//START EURORODEO
echo '<br><h2>WESTERNOVÉ JAZDENIE</h2>';
echo '############### <br><br>';

$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_URL => 'https://www.eurorodeo.eu/kalendar'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);

$dom = new DOMDocument;
 $dom->loadHTML($resp);
 foreach($dom->getElementsByTagName('tr') as $node)
 {
     foreach ($node->getElementsByTagName('td') as $value) {
         $array[] = $dom->saveHTML($value);
     }
 }

 $currentWeekDates = array();
 for ($i=0; $i < 7; $i++) { 
     array_push($currentWeekDates, date('j. n.',strtotime($today . ' + ' . ($i) . ' days')));
 }
 $dates_array = array();
 for ($i=0; $i < count($array); $i++) { 
     $event = $array[$i];
     $event = str_replace("Pridať do kalendára","",$event);
     preg_match_all("([0-9]+. [0-9].)",$event,$output_array);
     foreach ($output_array as $singleDateOfEvent) {
         foreach ($singleDateOfEvent as $singleDate) {
             if (in_array($singleDate,$currentWeekDates)){
                 $dom = new DOMDocument;
                 $dom->loadHTML($array[$i+1]);
                 $link = $dom->saveHTML($dom->getElementsByTagName('a')[0]);
                 $link = str_replace("/detail-zavodu/","https://eurorodeo.eu/detail-zavodu/",$link);
                 preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $link, $match);
                 $linkToShow = $pretty ? "LINK" : $match[0][0];
                 echo 🐴 . " <b>" .implode(' - ',$singleDateOfEvent) .date('Y').' - </b>' . strip_tags(utf8_decode($link)) . ' - <a href="'.$match[0][0].'">'.$linkToShow.'</a><br><br>';
             }
             break;
         }
         break;
     }
 }
 
//END EURORODEO


//FEI UPCOMING STREAMS
$curl = curl_init();
   // Set some options - we are passing in a useragent too here
   curl_setopt_array($curl, array(
       CURLOPT_RETURNTRANSFER => 1,
       CURLOPT_URL => 'https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=UCb3uedNKWKG7gGDYQJ1VsWg&eventType=upcoming&type=video&key=AIzaSyBT_NSLzSvpELApIh4Aqc1S5hS02521kZI'
   ));
   // Send the request & save response to $resp
   $resp = curl_exec($curl);
   $liveStreams = json_decode($resp);
   echo '<pre>';
   print_r($items);
   echo '</pre>';
   echo '<br><h2>PRIPRAVOVANÉ FEI LIVE STREAMY (vrátane repríz)</h2>';	
   echo '###############';
   if (count($liveStreams -> items) > 0){
       for ($i=0; $i < count($liveStreams -> items); $i++) { 
           echo '<br>🐴 ' . $liveStreams -> items[$i] -> snippet -> title;
       }
       echo '<br><br>Nájdete ich na -> https://jazdectvoprekazdeho.sk/live-streams';
   }else{
       echo '<br><p>Na nasledujúci týždeň nie sú naplánované žiadne live streamy</p>';
   }


//END FEI 
echo "</div>";
?>