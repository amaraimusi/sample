<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>XML出力用のエスケープ</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
</head>
<body>
<div id="header" ><h1>XML出力用のエスケープ</h1></div>
<div class="container">













<h2>検証</h2>
<pre>
$data = array(
	'neko'=&gt;'&lt;input /&gt;',
	array(
		'inu' =&gt; '"犬"とは',
		'yagi' =&gt; array("'ヤギ'とは",'&amp;',"&lt;&gt;&amp;&yen;"'")
	)
);

var_dump($data);
<strong>xml_escape</strong>($data);
var_dump($data);
</pre>
<br>

<p>出力</p>
<?php 

$data = array(
	'neko'=>'<input />',
	array(
		'inu' => '"犬"とは',
		'yagi' => array("'ヤギ'とは",'&',"<>&\"'")
	)
);

var_dump($data);
xml_escape($data);
var_dump($data);

/**
 * XMLエスケープ
 *
 * @note
 * XMLに出力データをエスケープする。
 * 記号「<>"'&」を「&lt;&gt;	&amp;&quot;&apos;」にエスケープする。
 * 高速化のため、引数は参照（ポインタ）にしており、返値もかねている。
 *
 * @param any $data 対象データ | 値および配列を指定 
 * @return void
 */
function xml_escape(&$data){
	
	if(is_array($data)){
		foreach($data as &$val){
			xml_escape($val);
		}
		unset($val);
	}elseif(gettype($data)=='string'){
		$data = str_replace(array('&','<','>','"',"'"),array('&amp;','&lt;','&gt;','&quot;','&apos;'),$data);
	}else{
		// 何もしない
	}
}

/**
 * XMLアンエスケープ
 *
 * @note
 * XMLエスケープされたデータを元に戻す。
 * 高速化のため、引数は参照（ポインタ）にしており、返値もかねている。
 *
 * @param any $data 対象データ | 値および配列を指定
 * @return void
 */
function xml_unescape(&$data){
	
	if(is_array($data)){
		foreach($data as &$val){
			xml_unescape($val);
		}
		unset($val);
	}elseif(gettype($data)=='string'){
		$data = str_replace(array('&lt;','&gt;','&quot;','&apos;','&amp;'),array('<','>','"',"'",'&'),$data);
	}else{
		// 何もしない
	}
}

/**
 * XSSエスケープ（XSSサニタイズ）
 *
 * @note
 * XSSサニタイズ
 * 記号「<>」を「&lt;&gt;」にエスケープする。
 * 高速化のため、引数は参照（ポインタ）にしており、返値もかねている。
 *
 * @param any $data 対象データ | 値および配列を指定
 * @return void
 */
function xss_escape(&$data){
	
	if(is_array($data)){
		foreach($data as &$val){
			xss_escape($val);
		}
		unset($val);
	}elseif(gettype($data)=='string'){
		$data = str_replace(array('<','>'),array('&lt;','&gt;'),$data);
	}else{
		// 何もしない
	}
}

/**
 * XSSアンエスケープ（XSSサニタイズデコード）
 *
 * @note
 * XSSエスケープされたデータを元に戻す。
 * 高速化のため、引数は参照（ポインタ）にしており、返値もかねている。
 *
 * @param any $data 対象データ | 値および配列を指定
 * @return void
 */
function xss_unescape(&$data){
	
	if(is_array($data)){
		foreach($data as &$val){
			xss_unescape($val);
		}
		unset($val);
	}elseif(gettype($data)=='string'){
		$data = str_replace(array('&lt;','&gt;'),array('<','>'),$data);
	}else{
		// 何もしない
	}
}
?>
















<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>XML出力用のエスケープ</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2017-6-1</div>
</body>
</html>