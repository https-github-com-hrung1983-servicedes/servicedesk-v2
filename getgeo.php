<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <title>Location </title>
  </head>
  <body>
<?$id = $_REQUEST["gent"]; ?>
		<!--div id="geo_id"><?=$id?></div-->
		<div id="geo"></div>



<script>
	myWindow.close();
</script>
  </body>
</html>

<script>

function GEOprocess(position,id_job) {
  document.getElementById('geo').innerHTML = 'Latitude: ' + position.coords.latitude + ' Longitude: ' + position.coords.longitude;
	GEOajax("geo.php?accuracy=" + position.coords.accuracy + "&latlng=" + position.coords.latitude + "," + position.coords.longitude +"&altitude="+position.coords.altitude+"&altitude_accuracy="+position.coords.altitudeAccuracy+"&heading="+position.coords.heading+"&speed="+position.coords.speed+"&gent="+<?=$id?>);


}


function GEOdeclined(error) {
  document.getElementById('geo').innerHTML = 'Error: ' + error.message;
}

if (navigator.geolocation) {
	navigator.geolocation.getCurrentPosition(GEOprocess, GEOdeclined);
}else{
  document.getElementById('geo').innerHTML = 'Your browser sucks. Upgrade it.';
}

if (window.XMLHttpRequest) {
 xmlHttp = new XMLHttpRequest();
}else if(window.ActiveXObject){
 xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
}


function GEOajax(url) {
 xmlHttp.open("GET", url, true);
 xmlHttp.onreadystatechange = updatePage;
 xmlHttp.send(null);
}


function updatePage() {
 if (xmlHttp.readyState == 4) {
  var response = xmlHttp.responseText;
  document.getElementById("geo").innerHTML = '' + response;
 }
}


</script>
