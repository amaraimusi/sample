<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>進捗バー付きのアップロード</title>
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/ImgCompactK.js"></script>

	<script src="fu_progress_demo1.js"></script>


	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" >
	<h1 style="font-size:1.2em">ファイルアップロード要素のラッパー要素にファイルドラッグ＆ドロップイベントを追加する</h1>
</div>
<div class="container">










<h2>デモ1</h2>
<div class="text-danger">プレビューには利用できるが肝心のアップロードに向かず。</div>
<div id="file1_wrap" style="display:'inline-block';width:320px;height:240px;background-color:#cce0f0;">
	ファイルをドラッグ＆ドロップしてください。
	（複数ファイルも可）<br>
	<input type="file" id="file1" multiple />
</div>
<div id="res1" class="text-success"></div>













<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li><a href="/sample/js/a006/fu_progress">進捗バー付きのアップロード</a></li>
	<li>進捗バー付きのアップロード</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2017-10-30</div>
</body>
</html>