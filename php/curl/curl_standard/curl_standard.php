<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PHPによるcURLの基本</title>
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>

	<style>

	</style>
</head>
<body>
<div id="header" ><h1>PHPによるcURLの基本</h1></div>
<div class="container">





<?php 

// 外部URL
$url = "http://amaraimusi.sakura.ne.jp/sample/php/curl/curl_standard/serv_side_cros.php";

$curl = curl_init(); // cURLのセッション開始およびcURLハンドラの取得

// 設定
curl_setopt_array($curl, [
		CURLOPT_URL=>$url,
		CURLOPT_RETURNTRANSFER=>true
]);

$html =  curl_exec($curl); // 外部URLからコンテンツを取得する。
curl_close($curl); // cURLのセッションを終了させる。

echo $html;
?>

























<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">ＰＨＰ　｜　サンプル</a></li>
	<li>PHPによるcURLの基本</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2016-7-8</div>
</body>
</html>