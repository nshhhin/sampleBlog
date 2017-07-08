<?php
  session_start();
  if(!isset($_SESSION["user"])){
    header("Location:	login_form.php");	
		exit;	
  }
  ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>記事投稿ページ</title>
    <link rel="stylesheet" href="myblog_style.css">
  </head>
  <body>

    <div class="article">
        <h2>記事を入力してください</h2>
  <form action="article_submit.php"	method="get">
    タイトル<br>
    <input	type="text"	name="title"><br>
    本文<br>
    <textarea	name="body" rows="10" cols="40"></textarea><br>
    住所・スポット名<br>
    <input type="text" name="address"><br>
    <input type="submit" value="送信"><br>
  </form>
      <p>
        <a href="top.php">ブログのページに戻る</a>	
      </p>
      
  </div>
  </body>
</html>