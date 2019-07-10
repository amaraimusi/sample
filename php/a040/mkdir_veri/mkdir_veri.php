<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ディレクトリパスの種類ごとのmkdirを検証 | ワクガンス</title>
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
<div id="header" ><h1>ディレクトリパスの種類ごとのmkdirを検証 | ワクガンス</h1></div>
<div class="container">





<h2>検証</h2>
<?php 
// 	$dp = dirname(__FILE__);;
// 	mkdir($dp.'/test4');
?>

<table class = "table">
	<thead><tr><th>検証</th><th>結果</th></tr></thead>
	<tbody>
		<tr>
			<td><pre><code>	mkdir('test1');</code></pre></td>
			<td>当phpファイルと同じディレクトリにtest1ディレクトリが作成される。</td>
		</tr>
		<tr>
			<td><pre><code>	mkdir('/test2');</code></pre></td>
			<td>ローカル環境(Windows)である場合、Cドライブにtest2ディレクトリが作成される。</td>
		</tr>
		<tr>
			<td><pre><code>
	$doc_root = $_SERVER['DOCUMENT_ROOT'];
	mkdir($doc_root.'/test3');
			</code></pre></td>
			<td>
			htdocsディレクトリにtest3ディレクトリが作成される。<br>
			「C:\xampp\htdocs\test3」 (ローカル環境）<br>
			</td>
		</tr>
		<tr>
			<td><pre><code>	
	$dp = dirname(__FILE__);;
	mkdir($dp.'/test4');</code></pre></td>
			<td>
				当phpファイルと同じディレクトリにtest1ディレクトリが作成される。<br>
				「mkdir('test4');」と同じ
			</td>
		</tr>
		
	</tbody>
</table>




<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>ディレクトリパスの種類ごとのmkdirを検証</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-8-18</div>
</body>
</html>