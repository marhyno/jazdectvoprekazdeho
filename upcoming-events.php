<?php
error_reporting(0);
echo '<meta property="og:image" content="https://' . $_SERVER['HTTP_HOST'] . '/img/upcomingEvents.png"/>';
echo '<meta property="fb:app_id" content="425429784657516"/>';
echo '<meta property="og:title" content="Jazdectvo pre každého" />';
echo '<img src="https://' . $_SERVER['HTTP_HOST'] . '/img/upcomingEvents.png">';
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

   $today = date('Ymd'); //set up for MONDAY
   $next7Days = date('Ymd',strtotime($currentDate . ' + 5 days'));

   echo 'Program na tento týždeň (' . date('d') .' - '.date('d.m.Y',strtotime(' + 7 days')).'): <br><br>';
   echo 'ANGLICKÉ JAZDENIE <br>';
   echo '############################################# <br>';

   foreach ($xml -> vevent as $singleEvent) {
       $eventStart = $singleEvent -> dtstart;
       $eventEnd = $singleEvent -> dtend;
       if ($eventStart > $today && $eventEnd < $next7Days){
           echo 🐴;
           echo ' ' . date('d.',strtotime($singleEvent -> dtstart)) . ' - ';
           echo date('d.m.Y',strtotime($singleEvent -> dtend) - 1) . ' - '; //based on SJF Site
           echo $singleEvent -> summary . ' - ';
           echo '@' . $singleEvent -> location;
           echo ' (' . $singleEvent -> categories . ') - ';
           echo $singleEvent -> url ->attributes() -> uri . '<br><br>';
       }
   }
   

//END SJF

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
   echo '<br>PRIPRAVOVANÉ FEI LIVE STREAMY (vrátane repríz)<br>';	
   echo '#############################################';
   if (count($liveStreams -> items) > 0){
       for ($i=0; $i < count($liveStreams -> items); $i++) { 
           echo '<br>🐴 ' . $liveStreams -> items[$i] -> snippet -> title;
       }
       echo '<br><br>Nájdete ich na -> https://jazdectvoprekazdeho.sk/live-streams';
   }else{
       echo '<br><p>Na nasledujúci týždeň nie sú naplánované žiadne live streamy</p>';
   }
?>