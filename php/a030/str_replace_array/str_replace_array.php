<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PHPの覚書 | 文字列の複数置換 | 配列を指定すると一括で複数の文字置換ができる | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/ImgCompactK.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>PHPの覚書 | 文字列の複数置換 | 配列を指定すると一括で複数の文字置換ができる | ワクガンス</h1></div>
<div class="container">




<h2>検証</h2>
<pre><code>
&lt;?php 
$subject = "ネコが家でカツオブシを食べる";
echo $subject . '&lt;br&gt;';
$search = ['ネコ','家','カツオブシ'];
$replace = ['イヌ','庭','残飯'];

$subject = str_replace($search, $replace, $subject);
echo $subject . '&lt;br&gt;';
?&gt;
</code></pre>

<p>出力</p>
<?php 
$subject = "ネコが家でカツオブシを食べる";
echo $subject . '<br>';
$search = ['ネコ','XXX','カツオブシ'];
$replace = ['イヌ','庭','残飯'];

$subject = str_replace($search, $replace, $subject);
echo $subject . '<br>';
?>




<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>PHPの覚書 | 文字列の複数置換 | 配列を指定すると一括で複数の文字置換ができる</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-6-30</div>
</body>
</html>