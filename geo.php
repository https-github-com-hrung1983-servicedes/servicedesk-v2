<?php
//require_once("db_connect.php");
require_once("function.php");
$geo = 'http://maps.google.com/maps/api/geocode/xml?latlng='.htmlentities(htmlspecialchars(strip_tags($_GET['latlng']))).'&sensor=true';
$xml = simplexml_load_file($geo);

list($lat,$long) = explode(',',htmlentities(htmlspecialchars(strip_tags($_GET['latlng']))));
$geodata['latitude'] = $lat;
$geodata['longitude'] = $long;
$geodata['formatted_address'] = $xml->result->formatted_address;
$geodata['accuracy'] = htmlentities(htmlspecialchars(strip_tags($_GET['accuracy'])));
$geodata['altitude'] = htmlentities(htmlspecialchars(strip_tags($_GET['altitude'])));
$geodata['altitude_accuracy'] = htmlentities(htmlspecialchars(strip_tags($_GET['altitude_accuracy'])));
$geodata['directional_heading'] = htmlentities(htmlspecialchars(strip_tags($_GET['heading'])));
$geodata['speed'] = htmlentities(htmlspecialchars(strip_tags($_GET['speed'])));
$geodata['google_api_src'] = $geo;
//echo '<img src="http://maps.google.com/maps/api/staticmap?center='.$lat.','.$long.'&zoom=14&size=150x150&maptype=roadmap&&sensor=true" width="150" height="150" alt="'.$geodata['formatted_address'].'" \/><br /><br />';
echo 'Latitude: '.$lat.' Longitude: '.$long.'<br />';
echo 'Address:'.$geodata['formatted_address'].'<br />';
//foreach($geodata as $name => $value){
//	echo ''.$name.': '.str_replace('&','&amp;',$value).'<br />';
//}

$id = $_REQUEST["gent"];
$ip = $_SERVER["REMOTE_ADDR"];

$dtetme = getDteTme();
mysqli_query($conn,"insert into tbl_job_locationx (job_no,dtetme,la,lo,ip,address) values ('$id','$dtetme','$lat','$long','$ip','$geodata[formatted_address]')");


?>
