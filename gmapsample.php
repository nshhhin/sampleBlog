<?php
  function place2loc($place) {
    $p = urlencode($place);
    $url = "http://maps.google.com/maps/api/geocode/json?address=" . $p . "&sensor=false";
    if ($response = file_get_contents($url)) {
      $obj = json_decode($response);
      $location = $obj->results[0]->geometry->location;
      return $location;
    }
    else {
      print "<pre>geocode error\n";
      var_dump($http_response_header);
      exit;
    }
  }

  $location = place2loc("川越市"); 
  $latitude = $location->lat;                  
  $longitude = $location->lng; 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="gmaps.js"></script>
    <script>
      var map;
      $(document).ready(function(){
        map = new GMaps({
          div: '#map',
          lat: <?php print $latitude; ?>,
          lng: <?php print $longitude; ?>,
          zoom: 16
        });
      });
    </script>
  </head>
  <body>
    <div id="map" style="width: 50%; height: 300px; margin: auto;"></div>
  </body>
</html>
