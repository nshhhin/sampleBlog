<?php
  function h($str) { return htmlspecialchars($str, ENT_QUOTES, "UTF-8"); }

  if (isset($_GET["article_id"]) && isset($_GET["name"]) && isset($_GET["body"])) {
    
    $article_id= $_GET["article_id"];
    $name = $_GET["name"];
    $body = $_GET["body"];
    
    $pdo	=	new	PDO("sqlite:myblog.sqlite");	
    $pdo->setAttribute(PDO::ATTR_ERRMODE,	PDO::ERRMODE_WARNING);	
    $st	=	$pdo->prepare("INSERT	INTO	comment(article_id, name,	body)	VALUES(?,	?, ?)");	
    $st->execute(array($article_id,$name,$body));	
    
      $result = "登録しました。";
  }
  else {
    $result = "コメントの内容がありません。";
  }
?>
<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <title>コメント登録ページ</title>
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