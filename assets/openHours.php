<?php
$start = "06:00";
$end = "23:30";

$tStart = strtotime($start);
$tEnd = strtotime($end);
$tNow = $tStart;
$dropdown = "";
$dropdown .= '<option value="">Vybrať</option>';
$dropdown .= '<option value="Zatvorené">Zatvorené</option>';

while($tNow <= $tEnd){
  $dropdown .= '<option value="'.date("H:i",$tNow).'">' . date("H:i",$tNow) . '</option>';
  $tNow = strtotime('+30 minutes',$tNow);
}

echo $dropdown;