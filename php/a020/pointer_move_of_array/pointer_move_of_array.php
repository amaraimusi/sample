<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>配列のポインタ移動 | end,reset,current,each,next,prev</title>
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>


	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>配列のポインタ移動 | end,reset,current,each,next,prev</h1></div>
<div class="container">













<h2>検証</h2>
<?php 
$animals = array(
		'neko'=>'ネコ',
		'yagi'=>'ヤギ',
		'kani'=>'カニ',
		'same'=>'サメ',
);


//$last = end($animals);
$last = end($animals);
echo $last; // → サメ
echo '<br>';

foreach($animals as $key => $val){
	echo $key . '→' . $val . '<br>';
}




?>
<hr>

<p>サンプル配列</p>
<pre><code>
	$animals = array(
			'neko'=&gt;'ネコ',
			'yagi'=&gt;'ヤギ',
			'kani'=&gt;'カニ',
			'same'=&gt;'サメ',
	);
</code></pre>




<p>検証1</p>
endで末尾要素を取得したあと、currentで現在要素を取得すると末尾の要素が取得される。<br>
内部ポインタが末尾に移動しているためである。
<pre><code>
	$last = <strong>end</strong>($animals);
	$v = current($animals);
	echo $v; // → サメ
</code></pre>




<p>検証2</p>
内部ポインタを末尾に移動してもeachには影響なし
<pre><code>
	$last = end($animals);
	echo $last; // → サメ
	
	<strong>foreach</strong>($animals as $key =&gt; $val){
		echo $key . '→' . $val . '&lt;br&gt;';
	}
</code></pre>
<pre class="output_data">
	neko→ネコ
	yagi→ヤギ
	kani→カニ
	same→サメ
</pre>




<p>検証3</p>
resetを実行すると内部ポインタは先頭に戻る。
<pre><code>
	$last = end($animals);
	<strong>reset</strong>($animals);
	$v = current($animals);
	echo $v; // → ネコ
</code></pre>




<p>検証4</p>
内部ポイントを末尾に移動させたあと、nextを実行すると空が出力される。
<pre><code>
	$last = end($animals);
	echo <strong>next</strong>($animals); // → 空値
	$v = current($animals);
	echo $v; // → 空値
</code></pre>




<p>検証5</p>
内部ポインタを１つ上にずらしてみる。
<pre><code>
	$last = end($animals);
	echo <strong>prev</strong>($animals); // → カニ
	$v = current($animals);
	echo $v; // → カニ
</code></pre>




<p>検証6</p>
内部ポインタが先頭に状態でprevを実行すると空が出力される
<pre><code>
	echo prev($animals); // → 空値
	$v = current($animals);
	echo $v; // → 空値
</code></pre>










<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>配列のポインタ移動 | end,reset,current,each,next,prev</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2017-6-9</div>
</body>
</html>