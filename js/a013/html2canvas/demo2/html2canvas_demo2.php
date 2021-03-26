<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>html2canvas | DIV要素を画像化、さらにバックエンド側に保管 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery-3.5.1.min.js"></script>
	<script src="/note_prg/js/vue.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="html2canvas.min.js"></script>
	<script src="script.js"></script>
</head>
<body>
<div id="header" ><h1>html2canvas | DIV要素を画像化、さらにバックエンド側に保管 | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
DIV要素内のコンテンツをhtml2canvasで画像ファイル化(demo2.png)してサーバーに保存し、その画像をimgタグで表示します。<br>
<br>

<div id="vue_app">
	<textarea v-model='msg1' style="width:100%;height:50"></textarea><br>
	<input type="botton" value="テスト実行" class="btn btn-success" onclick="test1()"/>
	<div id="res" class="text-success"></div>
	<div id="div1" style="display:inline-block;border:1px solid #19a15f;width:600px;padding:10px;" >
		<p>サンプルDiv要素</p><br>
		<div style="float:left;width:49%;"><img src="imori.jpg" alt="" style="width:200px"/></div>
		<div style="float:left;width:49%;">{{msg1}}</div>
	</div>
</div>
<div style="clear:both"></div>

<p>下記は出力された画像です。(demo2.pngを表示)</p>
<img id="img1" src="demo2.png?v=<?php echo date("YmdHis"); ?>" alt="" />

<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li><a href="/sample/js/a013/html2canvas">html2canvasのサンプル</a></li>
	<li>html2canvas | DIV要素を画像化、さらにバックエンド側に保管</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2021-3-25</div>
</body>
</html>