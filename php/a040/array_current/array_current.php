<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>配列先頭の値を取得 | ワクガンス</title>
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
<div id="header" ><h1>配列先頭の値を取得 | ワクガンス</h1></div>
<div class="container">




<a href="#" target="brank">公式サイト</a>

<h2>検証</h2>
<?php 

$ary = array();
$ary[0] = 'dog';
$ary['animal'] = 'cat';

$first = current($ary);
var_dump($first);
?>
<hr>

<p>ソースコード</p>
<pre><code>
$ary = array();
$ary[0] = 'dog';
$ary['animal'] = 'cat';
$first = current($ary);
var_dump($first); // → dog
</code></pre>
<hr>
<p>空配列の場合</p>
<pre><code>
$ary = array();
$first = current($ary);
var_dump($first); // → false
</code></pre>


<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>配列先頭の値を取得</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2019-1-8</div>
</body>
</html>