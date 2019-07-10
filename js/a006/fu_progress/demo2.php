<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ファイルアップロードの進捗を表示する</title>
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/ImgCompactK.js"></script>

	<script src="fu_progress_demo2.js"></script>


	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" >
	<h1 style="font-size:1.2em">ファイルアップロードを拡張し、進捗バー、DnD、複数ファイルに対応させる</h1>
</div>
<div class="container">











<h2>デモ</h2>
<label id="file1_wrap" for="file1" style="display:'inline-block';width:320px;height:240px;background-color:#cce0f0;">
	ファイルをドラッグ＆ドロップしてください。
	（複数ファイルも可）<br>
	<input type="file" id="file1" multiple />
</label><br>
<progress id="prog1" value="0" max="100"></progress>
<div id="res1" class="text-success"></div>
<div id="err" class="text-danger" ></div>
<br>












<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>ファイルアップロードの進捗を表示する</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2017-10-30</div>
</body>
</html>