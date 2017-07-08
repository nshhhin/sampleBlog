<?php
     if (isset($_GET["article_id"])) {
       $article_id= $_GET["article_id"];
     }
  ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>コメント投稿ページ</title>
    <link rel="stylesheet" href="myblog_style.css">
  </head>
  <body>

    <div class="article">
        <h2>コメントを入力してください</h2>
  <form action="comment_submit.php"	method="get">
    名前<br>
    <input	type="text"	name="name"><br>
    本文<br>
    <textarea	name="body" rows="10" cols="40"></textarea><br>
    <input type="submit" value="送信"><br>
    <input	type="hidden"	name="article_id"	value="<?php print $article_id ?>"><br>
  </form>
      <p>
        <a href="top.php">ブログのページに戻る</a>	
      </p>
  </div>
  </body>
</html>