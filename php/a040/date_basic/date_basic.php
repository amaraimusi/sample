<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>日付の基礎 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>日付の基礎 | ワクガンス</h1></div>
<div class="container">


<pre><code>
echo date('Y-m-d'); // 本日
echo date('U'); // 現在のUNIXタイムスタンプ
echo date("H:i:s"); // 現在時刻
echo strtotime('2012-12-12'); // 文字列日付からのUNIXタイムスタンプ
echo date('Y-m-d',strtotime('2012-12-12')); // 文字列から日付
</code></pre>

<pre class="console">
<?php 

echo date('Y-m-d'); // 本日
echo '<br>';
echo date('U'); // 現在のUNIXタイムスタンプ
echo '<br>';
echo date("H:i:s"); // 現在時刻
echo '<br>';
echo strtotime('2012-12-12'); // 文字列日付からのUNIXタイムスタンプ
echo '<br>';
echo date('Y-m-d',strtotime('2012-12-12')); // 文字列から日付

?>
</pre>



<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>日付の基礎</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-12-10</div>
</body>
</html>