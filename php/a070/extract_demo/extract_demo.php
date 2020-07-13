<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>連想配列から変数を作成する | extract | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/vue.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/ImgCompactK.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>連想配列から変数を作成する | extract | ワクガンス</h1></div>
<div class="container">



<h3>Demo</h3>

<pre><code>
$box = ['neko'=&gt;'ネコ', 'inu'=&gt;'犬', 'buta'=&gt;'ブタ'];
<strong>extract</strong>($box, EXTR_REFS);

echo $neko;
echo '&lt;br&gt;';
echo $inu;
echo '&lt;br&gt;';
echo $buta;

$box['buta'] = "大ブタ";
echo '&lt;br&gt;';
echo $buta;
</code></pre>
出力-----------<br>
<?php 
$box = ['neko'=>'ネコ', 'inu'=>'犬', 'buta'=>'ブタ'];
extract($box, EXTR_REFS);

echo $neko;
echo '<br>';
echo $inu;
echo '<br>';
echo $buta;

$box['buta'] = "大ブタ";
echo '<br>';
echo $buta;

?>



<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>連想配列から変数を作成する | extract</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2020-7-13</div>
</body>
</html>