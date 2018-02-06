<html>
<head>
<title>Map</title>
<script type='text/javascript'
src='https://maps.googleapis.com/maps/api/js?key=AIzaSyDFLaJwxTIGpZmwfpbEyOU5XZglUq6-5iM&sensor=false'>
</script>

<?php
$lat= $_POST['lat'];
$long= $_POST['long'];
?>

<script type='text/javascript'>
    var latitude = "<?php echo $lat; ?>";
    var longitude ="<?php echo $long; ?>";
function initialize()
{
    var myLatLng = new google.maps.LatLng(latitude,longitude);

 var mapProp = {
  zoom:8,
  center: myLatLng,
  mapTypeId: google.maps.MapTypeId.ROADMAP
  };
var map=new google.maps.Map(document.getElementById('map_canvas'),mapProp);

var marker = new google.maps.Marker({
  position: myLatLng,
  map: map,
  optimized: false,
  title:'Former About.com Headquarters'
}); 
}


</script>
</head>
<body onload='initialize()'>

<div id='map_canvas' style='width:300px; height:300px;'></div>
</body>
</html>




/////////////////////////




<html>
<head>
<title>Map</title>

<?php
$query = @unserialize (file_get_contents('http://ip-api.com/php/'));
if ($query && $query['status'] == 'success') {
//echo 'Hey user from ' . $query['country'] . ', ' . $query['city'] . '!';
  echo $query['city'];
}
foreach ($query as $data) {
    echo $data . "<br>";
}
?>
</head>
<body onload='initialize()'>

<iframe
  width="600"
  height="450"
  frameborder="0" style="border:0"
  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBfQGK-tKfDCOerfB-Z-X5U-6iz3tMBXlA
    &q=Jaipur,Seattle+WA" allowfullscreen>
</iframe>
</body>
</html>