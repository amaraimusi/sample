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
	$data['neko'][1]['mike'] = 'sallcat';
	$data[0] = 1;
	$data['animal'][1] = 'bigcat';
	$data['animal'][2]['konchu'][2] = 'kuro-ari';
	$data['fish']='fish';
	
	$depth = arrayDepth($data);
	echo "depth={$depth}&lt;br&gt;";
	
	$depth2 = arrayDepthSmp($data);
	echo "depth2={$depth2}&lt;br&gt;";
	
	
	/**
	 * 配列の階層の深さを調べる
	 * 
	 * @note
	 * 配列すべてをサーチするので処理は重め
	 * 
	 * @param array $ary 対象配列
	 * @param number $depth 深度（再起呼び出しで使用するので省略すること）
	 * @return number 階層数
	 */
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
	
	/**
	 * 配列の階層の深さを調べる（高速版）
	 *
	 * @note
	 * 配列の先頭からのみ深度を調べる。
	 * 処理は速いが、階層にばらつきのある配列には向かない。
	 * 行列データなどに。
	 *
	 * @param array $ary 対象配列
	 * @param number $depth 深度（再起呼び出しで使用するので省略すること）
	 * @return number 階層数
	 */
	function arrayDepthSmp(&amp;$ary, $depth=0){
		if(is_array($ary)){
			$depth++;
			$first_key = key($ary);
			$depth = arrayDepthSmp($ary[$first_key], $depth);
		}
		return $depth;
	}
</code></pre>
<p>出力</p>
<?php 

	$data['neko'][1]['mike'] = 'sallcat';
	$data[0] = 1;
	$data['animal'][1] = 'bigcat';
	$data['animal'][2]['konchu'][2] = 'kuro-ari';
	$data['fish']='fish';
	
	$depth = arrayDepth($data);
	echo "depth={$depth}<br>";
	
	$depth2 = arrayDepthSmp($data);
	echo "depth2={$depth2}<br>";
	
	
	/**
	 * 配列の階層の深さを調べる
	 * 
	 * @note
	 * 配列すべてをサーチするので処理は重め
	 * 
	 * @param array $ary 対象配列
	 * @param number $depth 深度（再起呼び出しで使用するので省略すること）
	 * @return number 階層数
	 */
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
	
	/**
	 * 配列の階層の深さを調べる（高速版）
	 *
	 * @note
	 * 配列の先頭からのみ深度を調べる。
	 * 処理は速いが、階層にばらつきのある配列には向かない。
	 * 行列データなどに。
	 *
	 * @param array $ary 対象配列
	 * @param number $depth 深度（再起呼び出しで使用するので省略すること）
	 * @return number 階層数
	 */
	function arrayDepthSmp(&$ary, $depth=0){
		if(is_array($ary)){
			$depth++;
			$first_key = key($ary);
			$depth = arrayDepthSmp($ary[$first_key], $depth);
		}
		return $depth;
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
<div id="footer">(C) kenji uehara 2019-1-8 | 2019-12-24</div>
</body>
</html>