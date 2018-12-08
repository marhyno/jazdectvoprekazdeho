<?php

$xml=simplexml_load_file("assets/searchFilter.xml");
foreach($xml->children() as $child)
{
  echo $child->attributes() . ": " . $child . "<br>";
}
?>