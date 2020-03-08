<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>自作ログインの基本 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>

</head>
<body>
<div id="header" ><h1>自作ログインの基本 | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<?php 
if(!empty($_POST['login_submit'])){
	$pw_hash2 = getTestPwHash($_POST['uid']);
		if(password_verify($_POST['password'], $pw_hash2)){
			print 'ログイン成功';
		}else{
			print 'ログイン失敗';
		}
}

function getTestPwHash($uid){
	// 本来は、DBからユーザーIDにひもづくパスワードハッシュを取得処理である。
	// テスト用にパスワードハッシュを直に記述している。
	$pw='hogehoge'; // テストパスワード
	$pw_hash = password_hash($pw, PASSWORD_DEFAULT);
	return $pw_hash;
}
?>
<form action="#" method="post">
	<input name="uid" type="text" /><br>
	<input name="password" type="password" />テスト用パスワード→hogehoge<br><br>
	<input type="submit" name="login_submit" value="Login" class="btn btn-primary"/>
</form>




<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>自作ログインの基本</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2020-3-7</div>
</body>
</html>