<?php
  session_start();

  function h($str) { return htmlspecialchars($str, ENT_QUOTES, "UTF-8"); }

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

  


  $article_id= $_GET["article_id"];
  $pdo = new PDO("sqlite:myblog.sqlite");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  $st = $pdo->query("SELECT * FROM article WHERE article_id=".$article_id);
  $data = $st->fetch();
  $address =$data["address"];

  $location = place2loc("$address"); 
  $latitude = $location->lat;                  
  $longitude = $location->lng; 

  

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>My Blog</title>
    <link rel="stylesheet" href="myblog_style.css">
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
      map.addMarker({
        lat: <?php print $latitude; ?>,
        lng: <?php print $longitude; ?>,
        title: "<?php	print	h($address);	?>"	
      });
     });
    
    </script>
  </head>
  <body>
    <?php
      if(!isset($_SESSION["user"])){
        print '<p class="login">[<a href="login_form.php">ログイン</a>]</p>';
      }else{
        print '<p class="login">ようこそ '.$_SESSION["user"].' さん！ [<a href="logout.php">ログアウト</a>]</p>';
      }
        print '<div class="article">';
        print '<h2>' . h($data["title"]) . '</h2>';
        print '<p>' . h($data["body"]) . '</p>';
      
        print '<div id="map" style="width: 50%; height: 300px; margin: auto;"></div><br><br>';
        


        $st2 = $pdo->query("SELECT * FROM comment WHERE article_id=".$article_id);
        $data2 = $st2->fetchAll();
        foreach ($data2 as $comment) {
          print '<div class="comment">';
          print '<h3>' . h($comment["name"]) . '</h3>';
          print '<p>' . h($comment["body"]) . '</p>';
          print '</div>';
        }
        print '<p class="comment_link">投稿日:' . h($data["time"]);
        print	' <a	href="comment_form.php?article_id='	.	h($data['article_id']	)	.	'">コメントをする</a></p>';
        print '　<a href="top.php">ブログのページに戻る</a>';	
      
        print '</div>';
       
    ?>
 
     
  </body>
</html>

