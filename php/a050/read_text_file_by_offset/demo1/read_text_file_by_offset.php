<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>テキストファイルを途中から読込 | オフセットから読込 | ワクガンス</title>
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
<div id="header" ><h1>テキストファイルを途中から読込 | オフセットから読込 | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>

test.txt
<pre>
ネコ
オオカミ
ライオン
キリン
ライオンタマリン
イリオモテヤマネコ
リュウキュウコノハズク
イシカワガエル
</pre>
PHP
<pre><code>
&lt;?php 
$fn = "test.txt";
if ($fp = fopen ( $fn, "r" )) {
	fseek( $fp, 33 );
	$data = array ();
	while ( false !== ($line = fgets ( $fp )) ) {
		$ft = ftell($fp);
		echo $line . '&lt;br&gt;';
		echo $ft . '&lt;br&gt;';
	}
}
fclose ( $fp );
?&gt;
</code></pre>
<pre class="console">
<?php 
$fn = "test.txt";
if ($fp = fopen ( $fn, "r" )) {
	fseek( $fp, 33 );
	$data = array ();
	while ( false !== ($line = fgets ( $fp )) ) {
		$ft = ftell($fp);
		echo $line . '<br>';
		echo $ft . '<br>';
	}
}
fclose ( $fp );
?>
</pre>


<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>テキストファイルを途中から読込 | オフセットから読込</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2019-5-6</div>
</body>
</html>