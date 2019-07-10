<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Google Translate APIの使い方 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="script.js"></script>
</head>
<body>
<div id="header" ><h1>Google Translate APIの使い方 | ワクガンス</h1></div>
<div class="container">




<h2>デモ</h2>
<?php 

if($_SERVER['SERVER_NAME'] != 'localhost' && date('U') > strtotime('2019-2-1')){
	echo '2019月2月1日にて公開停止';
	return;
}

require_once 'vendor/vendor/autoload.php';

use Google\Cloud\Translate\TranslateClient;
echo 'OK';

//Google APIの「プロジェクトID」
$projectId = 'api-project-577997945594';

//「Google Cloud Translation API」の「APIキー」
$apiKey = 'AIzaSyBFdIWjLXlyGV8aDzTkg28BU_SbjjhbB6k';

//「TranslateClient」クラスを呼び出し
$translate = new TranslateClient([
'projectId' => $projectId,
'key' => $apiKey,
]);

//翻訳したい言語を指定。今回は「日本語→英語」なので「en」
$lang = "en";
//language.languages.list
//翻訳開始
$langList = $translate->languages();
var_dump($langList);//■■■□□□■■■□□□■■■□□□)
$json = json_encode($langList,JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);
echo "<div id='lang_json'>{$json}</div>";


$result = $translate->translate("私の猫を捕まえてください。<br>この猫はキジトラの雄です。", [
'target' => $lang,
]);

var_dump($result);
?>


<div id="lang_div"></div>

<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>Google Translate APIの使い方</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-12-8</div>
</body>
</html>