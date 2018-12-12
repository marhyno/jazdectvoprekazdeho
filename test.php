<?php
$myfile = fopen("/share/sites/jazdectvoprekazdeho/assets/allPlacesInSlovakia.txt", "r") or die("Unable to open file!");
# include DB Manipulation + DB connector 
require_once('api/classes/easypdo.php');

while(!feof($myfile)) {
  $location = trim(preg_replace('/\s\s+/', ' ', fgets($myfile)));
  $url = "http://www.datasciencetoolkit.org/maps/api/geocode/json?sensor=false&address=".urlencode($location);
  echo $url;
  $resultLocation = file_get_contents($url);
  $resultLocation = json_decode($resultLocation,true);
  $latitude = $resultLocation['results'][0]['geometry']['location']['lat'];
  $longitude = $resultLocation['results'][0]['geometry']['location']['lng'];
  $location_exploded = explode(',',$location);
  insertData("INSERT IGNORE INTO slovakPlaces (localCity, region, province,latitude,longitude)
    VALUES (:localCity,:region,:province,:latitude,:longitude)",array('localCity'=>$location_exploded[0],'region'=>$location_exploded[1],'province'=>$location_exploded[2],'latitude'=>$latitude,'longitude'=>$longitude));
}
?>