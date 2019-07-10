<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>JAX.phpでXMLと配列データを相互変換する</title>
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>JAX.phpでXMLと配列データを相互変換する</h1></div>
<div class="container">












<a href="http://0-oo.net/sbox/php-tool-box/jax" target="brank">公式サイト</a>

<h2>デモ</h2>
<pre><code>
	require_once 'JAX.php';
	
	// 配列データのサンプル
	$data = array(
			'id' =&gt; 99,
			'name' =&gt; '赤猫',
			'option' =&gt; array(
					'age'=&gt;0,
					'date'=&gt;'2017-5-1'
			)
	);

	var_dump($data);
	
	// 配列データからXMLテキストに変換する
	$jax = new JAX();
	$xml_fp = 'test1.xml';
	$xml_text = $jax-&gt;array2xml('cat',$data);
	var_dump($xml_text);
	

	// XMLテキストから配列データに変換する。
	$data2 = @$jax-&gt;xml2array($xml_text);
	var_dump($data2);
</code></pre><br>

<p>出力</p>
<?php 
	require_once 'JAX.php';
	
	// 配列データのサンプル
	$data = array(
			'id' => 99,
			'name' => '赤猫',
			'option' => array(
					'age'=>0,
					'date'=>'2017-5-1'
			)
	);

	var_dump($data);
	
	// 配列データからXMLテキストに変換する
	$jax = new JAX();
	$xml_fp = 'test1.xml';
	$xml_text = $jax->array2xml('cat',$data);
	var_dump($xml_text);
	

	// XMLテキストから配列データに変換する。
	$data2 = @$jax->xml2array($xml_text);
	var_dump($data2);
	

?>















<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">PHP ｜ サンプル</a></li>
	<li>JAX.phpでXMLと配列データを相互変換する</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2017-6-28</div>
</body>
</html>