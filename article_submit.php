<?php
  function h($str) { return htmlspecialchars($str, ENT_QUOTES, "UTF-8"); }

  date_default_timezone_set("Asia/Tokyo");
  if (isset($_GET["title"]) && isset($_GET["body"])) {
    $title = $_GET["title"];
    $body = $_GET["body"];
    $time = date("Y-m-d H:i");

    $pdo	=	new	PDO("sqlite:myblog.sqlite");	
    $pdo->setAttribute(PDO::ATTR_ERRMODE,	PDO::ERRMODE_WARNING);	
     if(isset($_GET["address"])){
      $address=$_GET["address"];
    $st	=	$pdo->prepare("INSERT	INTO	article(title,	body,	time, address)	VALUES(?,	?,	?,?)");	
    $st->execute(array($title,$body,$time,$address));	
     }
    else{
      $st	=	$pdo->prepare("INSERT	INTO	article(title,	body,	time)	VALUES(?,	?,	?)");	
    $st->execute(array($title,$body,$time));	
    }
    
      $result = "登録しました。";
  }
  else {
    $result = "記事の内容がありません。";
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>記事登録ページ</title>
    <link rel="stylesheet" href="myblog_style.css">
  </head>
  <body>
    <div class="article"><h2>
  <?php
    print $result;
  ?>
       </h2>
      <p>
        <a href="top.php">ブログのページに戻る</a>	
      </p>
    </div>
  </body>
</html>
