<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>自作ログイン | ログインチェックとログアウト | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>

</head>
<body>
<div id="header" ><h1>自作ログイン | ログインチェックとログアウト | ワクガンス</h1></div>
<div class="container">


<h2>Demo2</h2>
<?php 
// ログインチェック
session_start();
if(empty($_SESSION['uid'])){
	$_SESSION['referer'] = $_SERVER['REQUEST_URI'];
	header('Location: demo2_login.php');
	exit;
}
?>
ログインが必要なページです。<br>
<a href="demo2_logout.php" class="btn btn-default">ログアウト</a><br>




<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>自作ログイン | ログインチェックとログアウト</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2020-3-7</div>
</body>
</html>