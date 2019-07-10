<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Yahoo!ジオコーダAPI | アプリケーションIDの登録～住所から緯度経度取得 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/ImgCompactK.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>Yahoo!ジオコーダAPI | アプリケーションIDの登録～住所から緯度経度取得 | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<?php 
// $app_id = "dj00aiZpPU9vOWdUelJjRHhZbCZzPWNvbnN1bWVyc2VjcmV0Jng9MzY-";
// $place = "沖縄県国頭郡本部町石川４２４";
// $place = urlencode($place);// URLエンコード
// $url = "https://map.yahooapis.jp/geocode/V1/geoCoder?appid={$app_id}&query={$place}&results=1"; // XML系s機
// //$url = "https://map.yahooapis.jp/geocode/V1/geoCoder?appid={$app_id}&query={$place}&results=1&output=json"; // JSON形式
// $text = file_get_contents ($url);
// var_dump($text);
?>

PHP
<pre><code>
&lt;?php 
$app_id = "うんじゅぬアプリケーションID";
$place = "沖縄県国頭郡本部町石川４２４";
$place = urlencode($place);// URLエンコード
$url = "https://map.yahooapis.jp/geocode/V1/geoCoder?appid={$app_id}&amp;query={$place}&amp;results=1"; // XML系s機
//$url = "https://map.yahooapis.jp/geocode/V1/geoCoder?appid={$app_id}&amp;query={$place}&amp;results=1&amp;output=json"; // JSON形式
$text = file_get_contents ($url);
var_dump($text);
?&gt;
</code></pre>

出力
<div class="console">
&lt;YDF xmlns="http://olp.yahooapis.jp/ydf/1.0" totalResultsReturned="1" totalResultsAvailable="1" firstResultPosition="1"&gt;&lt;ResultInfo&gt;&lt;Count&gt;1&lt;/Count&gt;&lt;Total&gt;1&lt;/Total&gt;&lt;Start&gt;1&lt;/Start&gt;&lt;Status&gt;200&lt;/Status&gt;&lt;Description&gt;&lt;/Description&gt;&lt;Copyright&gt;&lt;/Copyright&gt;&lt;Latency&gt;0.014&lt;/Latency&gt;&lt;/ResultInfo&gt;&lt;Feature&gt;&lt;Id&gt;47308.1.424&lt;/Id&gt;&lt;Gid&gt;&lt;/Gid&gt;&lt;Name&gt;沖縄県国頭郡本部町石川（字）424&lt;/Name&gt;&lt;Geometry&gt;&lt;Type&gt;point&lt;/Type&gt;&lt;Coordinates&gt;127.87798745,26.69430191&lt;/Coordinates&gt;&lt;BoundingBox&gt;127.87238745,26.68870191 127.88358745,26.69990191&lt;/BoundingBox&gt;&lt;/Geometry&gt;&lt;Category/&gt;&lt;Description&gt;&lt;/Description&gt;&lt;Style/&gt;&lt;Property&gt;&lt;Uid&gt;8408cdf99bc13cfe5f7451f14e00734ed5928a78&lt;/Uid&gt;&lt;CassetteId&gt;b22fee69b0dcaf2c2fe2d6a27906dafc&lt;/CassetteId&gt;&lt;Yomi&gt;オキナワケンクニガミグンモトブチョウイシカワ（アザ）&lt;/Yomi&gt;&lt;Country&gt;&lt;Code&gt;JP&lt;/Code&gt;&lt;Name&gt;日本&lt;/Name&gt;&lt;/Country&gt;&lt;Address&gt;沖縄県国頭郡本部町石川（字）424&lt;/Address&gt;&lt;GovernmentCode&gt;47308&lt;/GovernmentCode&gt;&lt;AddressMatchingLevel&gt;6&lt;/AddressMatchingLevel&gt;&lt;AddressType&gt;地番・戸番&lt;/AddressType&gt;&lt;/Property&gt;&lt;/Feature&gt;&lt;/YDF&gt;
</div>

<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>Yahoo!ジオコーダAPI | アプリケーションIDの登録～住所から緯度経度取得</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2019-4-16</div>
</body>
</html>