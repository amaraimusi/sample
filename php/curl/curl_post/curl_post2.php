<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>cURLでPOSTする</title>
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>

	<style>

	</style>
</head>
<body>
<div id="header" ><h1>cURLでPOSTする</h1></div>
<div class="container">





<?php 

// 外部URL
$url = "https://www.hellowork.mhlw.go.jp/kensaku/GECA110010.do";

$data=[
		'oJo'=>'',
		'kSNoGe'=>'',
		'kjKbnRadioBtn'=>'1',
		'nenreiInput'=>'',
		'tDFK1CmbBox'=>'47',
		'tDFK2CmbBox'=>'',
		'tDFK3CmbBox'=>'',
		'sKGYBRUIJo1'=>'',
		'sKGYBRUIGe1'=>'',
		'sKGYBRUIJo2'=>'',
		'sKGYBRUIGe2'=>'',
		'sKGYBRUIJo3'=>'',
		'sKGYBRUIGe3'=>'',
		'freeWordInput'=>'',
		'nOTKNSKFreeWordInput'=>'',
		'searchBtn'=>'検索',
		'kJNoJo1'=>'',
		'kJNoGe1'=>'',
		'kJNoJo2'=>'',
		'kJNoGe2'=>'',
		'kJNoJo3'=>'',
		'kJNoGe3'=>'',
		'kJNoJo4'=>'',
		'kJNoGe4'=>'',
		'kJNoJo5'=>'',
		'kJNoGe5'=>'',
		'jGSHNoJo'=>'',
		'jGSHNoChuu'=>'',
		'jGSHNoGe'=>'',
		'kyujinkensu'=>'0',
		'iNFTeikyoRiyoDantaiID'=>'',
		'searchClear'=>'0',
		'siku1Hidden'=>'',
		'siku2Hidden'=>'',
		'siku3Hidden'=>'',
		'kiboSuruSKSU1Hidden'=>'',
		'kiboSuruSKSU2Hidden'=>'',
		'kiboSuruSKSU3Hidden'=>'',
		'summaryDisp'=>'false',
		'searchInitDisp'=>'0',
		'screenId'=>'GECA110010',
		'action'=>'',
		'codeAssistType'=>'',
		'codeAssistKind'=>'',
		'codeAssistCode'=>'',
		'codeAssistItemCode'=>'',
		'codeAssistItemName'=>'',
		'codeAssistDivide'=>'',
		'maba_vrbs'=>'infTkRiyoDantaiBtn,searchShosaiBtn,searchBtn,searchNoBtn,searchClearBtn,dispDetailBtn',
		'preCh'=>'',
		
];
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
	<li>cURLでPOSTする</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2016-7-8</div>
</body>
</html>