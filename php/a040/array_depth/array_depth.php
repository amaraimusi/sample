<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>配列の階層の深さを調べる | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/ImgCompactK.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>配列の階層の深さを調べる | ワクガンス</h1></div>
<div class="container">




<a href="#" target="brank">公式サイト</a>

<h2>デモ</h2>
<pre><code>
	$data[0] = 1;
	$data['animal'][1] = 'bigcat';
	$data['animal'][2]['konchu'][2] = 'kuro-ari';
	$data['fish']='fish';
	
	$depth = arrayDepth($data);
	
	var_dump($depth);
	
	function arrayDepth(&amp;$ary, $depth=0){
		if(is_array($ary)){
			$depth++;
			
			$max_depth = 0;
			foreach($ary as $value){
				$dep = arrayDepth($value, $depth);
				if($dep &gt; $max_depth) $max_depth = $dep;
			}
			return $max_depth;
			
		}else{
			return $depth;
		}
	}
</code></pre>
<p>出力</p>
<?php 

	$data[0] = 1;
	$data['animal'][1] = 'bigcat';
	$data['animal'][2]['konchu'][2] = 'kuro-ari';
	$data['fish']='fish';
	
	$depth = arrayDepth($data);
	
	var_dump($depth);
	
	function arrayDepth(&$ary, $depth=0){
		if(is_array($ary)){
			$depth++;
			
			$max_depth = 0;
			foreach($ary as $value){
				$dep = arrayDepth($value, $depth);
				if($dep > $max_depth) $max_depth = $dep;
			}
			return $max_depth;
			
		}else{
			return $depth;
		}
	}
	
?>



<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>配列の階層の深さを調べる</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2019-1-8</div>
</body>
</html>