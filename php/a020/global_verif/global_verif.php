<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>globalの検証</title>
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>


	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>globalの検証</h1></div>
<div class="container">













<h2>検証</h2>
<?php 
// グローバル変数が表示される
$a = 'オオムラサキ';
test1();
function test1(){
	global $a;
	echo $a; // → オオムラサキ
}
?>

<p>検証1</p>
<pre><code>
	// 正常なパターン：グローバル変数が表示される
	$a = 'オオムラサキ';
	test1();
	function test1(){
		global $a;
		echo $a; // → オオムラサキ
	}
</code></pre>

<p>検証2</p>
<pre><code>
	// globalを使わないとエラーになる。
	$a = 'オオムラサキ';
	test1();
	function test1(){

		echo $a; // → エラー
	}
</code></pre>

<p>検証3</p>
<pre><code>
	// 関数内の変数をglobalすると空になる。
	test1();
	function test1(){
		$a = 'オオムラサキ';
		global $a;
		echo $a; // → 空値になる
	}
</code></pre>

<p>検証4</p>
<pre><code>
	test1();
	function test1(){
		$a = 'オオムラサキ';
		$a;
		echo $a; // → オオムラサキ
	}
</code></pre>









<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>globalの検証</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2017-6-9</div>
</body>
</html>