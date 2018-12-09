<?php
$myfile = fopen("/share/sites/jazdectvoprekazdeho/assets/allPlacesInSlovakia.txt", "r") or die("Unable to open file!");
$x = 0;
# include DB Manipulation + DB connector 
require_once('api/classes/easypdo.php');

while(!feof($myfile)) {
  $x++;
  $location = trim(preg_replace('/\s\s+/', ' ', fgets($myfile)));
  $url = "http://www.datasciencetoolkit.org/maps/api/geocode/json?sensor=false&address=".$location."";
  $resultLocation = file_get_contents($url);
  $resultLocation = json_decode($resultLocation,true);
  $latitude = $resultLocation['results'][0]['geometry']['location']['lat'];
  $longitude = $resultLocation['results'][0]['geometry']['location']['lng'];
  $location_exploded = explode(',',$location);
  insertData("INSERT INTO slovakPlaces (localCity, region, province,latitude,longitude)
    VALUES (:localCity,:region,:province,:latitude,:longitude)",array('localCity'=>$location_exploded[0],'region'=>$location_exploded[1],'province'=>$location_exploded[2],'latitude'=>$latitude,'longitude'=>$longitude));
}
?>