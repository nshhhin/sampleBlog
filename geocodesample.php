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

  $location = place2loc("東京都中野区中野4-21-1"); 
  $latitude = $location->lat;                  
  $longitude = $location->lng; 
?>
<!DOCTYPE html>
<html>
  <head><meta charset="utf-8"></head>
  <body>
    緯度: <?php print $latitude; ?><br>
    経度: <?php print $longitude; ?><br>
  </body>
</html>
