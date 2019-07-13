<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LogEx | ワクガンス</title>
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
<div id="header" ><h1>LogEx | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<a href="/note_prg/php/note16.html#sec16-10" class="btn btn-info">覚書 / ソースコード</a><br>
LogExクラス<br>
ディレクトリごとテキストファイル（ログファイル）を作成、および旧ファイルの除去<br>
<?php 
    require_once ('LogEx.php');
    $logEx = new LogEx();
    
    $logEx->write('カタクチイワシ');
    $logEx->write('カライワシ');
    
    $log_text = $logEx->getLogText(); // ログのテキストを取得
    
    echo '<pre>';
    echo $log_text;
    echo '</pre>';
    
?>

<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>LogEx</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2019-7-13</div>
</body>
</html>