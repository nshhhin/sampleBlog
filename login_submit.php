<?php
  session_start();
  if(isset($_GET["username"])	&&	isset($_GET["passwd"])){	
		$username	=	$_GET["username"];	
		$passwd	=	$_GET["passwd"];	
    
    $pdo	=	new	PDO("sqlite:myblog.sqlite");	
    $st	=	$pdo->prepare("SELECT *FROM user where username=?");	
    $st->execute(array($username));	
    $user_on_db	=	$st->fetch();	
    $password =$user_on_db[2];
      
  function h($str) { return htmlspecialchars($str, ENT_QUOTES, "UTF-8"); }
    
  if(!$user_on_db){
    $result	=	"指定されたユーザが存在しません。";	
  }	
  else if($passwd === $password){
    $_SESSION["user"]	=	$username;	
		$result	=	"ようこそ"	.	$username	.	"さん。ログインに成功しました。";	
  }	
  else{
    $result	=	"パスワードが違います。";
  }
 }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ログインページ</title>
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
