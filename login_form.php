
<?php
session_start();
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
      <h2>ユーザ名とパスワードを入力してください</h2>
      <form action="login_submit.php"	method="get">
        <table>
          <tr>
            <td>ユーザ名</td> <td><input	type="text"	name="username"></td>
          </tr>
          <tr>
            <td>パスワード</td> <td><input type="password"	name="passwd"></td>
          </tr>
          <tr>
            <td> </td> <td><input type="submit" value="送信"></td>
          </tr>
        </table>
        
      </form>
      <p>
      <a href="top.php">ブログのページに戻る</a>
      </p>
    </div>
  </body>
</html>