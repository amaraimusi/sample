<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>半角英数字（一部記号）のチェック | 正規表現 | ワクガンス</title>
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
<div id="header" ><h1>半角英数字（一部記号）のチェック | 正規表現 | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<pre><code>
	$strs = [];
	$strs[] = "abc-123_5.csv";
	$strs[] = "ねこ";
	$strs[] = "cat";
	$strs[] = 987;
	$strs[] = "";
	$strs[] = '-_';
	$strs[] = 'abcあ';
	
	foreach($strs as $str){
		echo $str;
		if (preg_match("/^[a-zA-Z0-9-_.]+$/", $str)) {
			echo "&yen;t〇&lt;br&gt;";
		} else {
			echo "&yen;t×&lt;br&gt;";
		}
	}
</code></pre>

<p>出力</p>
<pre class="console">
<?php 

	$strs = [];
	$strs[] = "abc-123_5.csv";
	$strs[] = "ねこ";
	$strs[] = "cat";
	$strs[] = 987;
	$strs[] = "";
	$strs[] = '-_';
	$strs[] = 'abcあ';
	
	foreach($strs as $str){
		echo $str;
		if (preg_match("/^[a-zA-Z0-9-_.]+$/", $str)) {
			echo "\t〇<br>";
		} else {
			echo "\t×<br>";
		}
	}
?>
</pre>

<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>半角英数字（一部記号）のチェック | 正規表現</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2019-5-20</div>
</body>
</html>