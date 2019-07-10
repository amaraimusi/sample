<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>cURLによるクロスドメイン：認証キー付き</title>
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>

	<style>

	</style>
</head>
<body>
<div id="header" ><h1>cURLによるクロスドメイン：認証キー付き</h1></div>
<div class="container">





<?php 

// 外部URL
$url = "http://amaraimusi.sakura.ne.jp/sample/php/curl/curl_auth/server2.php";

// 認証キー
$hash="08977553564800ea12cf5277006e238577b2318850e201b353204e9486364788";
if ($_SERVER['SERVER_NAME'] == 'localhost'){
	$hash="737ff58576b3f8b1f882aa4772d45c6914d7d534dca2725450a7abf866abc232";
}


// POSTデータのサンプル
$data=['id'=>1401,'animal_name'=>'unagi','hash'=>$hash];
$json = json_encode($data);
$data2 = ['key1'=>$json];
$query = http_build_query($data2);

$curl = curl_init(); // cURLのセッション開始およびcURLハンドラの取得

// 設定
curl_setopt_array($curl, [
		CURLOPT_URL=>$url,
		CURLOPT_RETURNTRANSFER=>true,
		CURLOPT_POST=>true,
		CURLOPT_POSTFIELDS=>$query,
		CURLOPT_FOLLOWLOCATION=>true,
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
	<li>cURLによるクロスドメイン：認証キー付き</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2016-7-11</div>
</body>
</html>