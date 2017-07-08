<?php
  session_start();

  function h($str) { return htmlspecialchars($str, ENT_QUOTES, "UTF-8"); }
 
  $pdo = new PDO("sqlite:myblog.sqlite");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  $st = $pdo->query("SELECT * FROM article ORDER by article_id DESC");
  $data = $st->fetchAll();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>My Blog</title>
    <link rel="stylesheet" href="myblog_style.css">
  </head>
  <body>
    <h1>My Blog</h1>
    <?php
      if(!isset($_SESSION["user"])){
        print '<p class="login">[<a href="login_form.php">ログイン</a>]</p>';
      }else{
        print '<p class="login">ようこそ '.$_SESSION["user"].' さん！ [<a href="logout.php">ログアウト</a>]</p>';
      }
      foreach($data as $article) {
        print '<div class="article">';
        print '<h2>' . h($article["title"]) . '</h2>';
        print '<p>' . h($article["body"]) . '</p>';
        if(isset($article["address"])){
        print '<p>[ <a href="showmap.php?article_id='	.	h($article['article_id']).'">地図を見る</a> ]</p>';
        }

        $st2 = $pdo->query("SELECT * FROM comment WHERE article_id=".$article["article_id"]);
        $data2 = $st2->fetchAll();
        foreach ($data2 as $comment) {
          print '<div class="comment">';
          print '<h3>' . h($comment["name"]) . '</h3>';
          print '<p>' . h($comment["body"]) . '</p>';
          print '</div>';
        }

        print '<p class="comment_link">投稿日:' . h($article["time"]);
        print	'　<a	href="comment_form.php?article_id='	.	h($article['article_id']	)	.	'">コメントをする</a></p>';
        print '</div>';
        
      }

      
    ?>
    <p class="article_link">	
		  <a href="article_form.php">記事投稿</a>	
    </p>	
  </body>
</html>

