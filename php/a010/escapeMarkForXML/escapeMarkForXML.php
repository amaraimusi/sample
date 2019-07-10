<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>XML用の記号エスケープ関数 | escapeMarkForXML</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>


</head>
<body>
<div id="header" ><h1>XML用の記号エスケープ関数 | escapeMarkForXML</h1></div>
<div class="container">













<h2>デモ</h2>
<?php 
$data = array('neko'=>'<input />',array(
		"<>&\"'",122,array('dog'=>'犬">','pig'=>null),
));
var_dump($data);

$data = escapeMarkForXML($data);
echo 'エスケープ後↓<br>';

var_dump($data);


/**
 * XML用の記号エスケープ関数
 * 
 * @note
 * 記号「 &<>"' 」をXML用にエスケープする
 * 
 * @param any $data
 * @return エスケープ後のデータ
 */
function escapeMarkForXML($data){

	if(is_array($data)){
		foreach ($data as $key => $v){
			$data[$key] = escapeMarkForXML($v);
		}
		return $data;
	}else{
		if(gettype($data) == 'string'){
			
			$search = array('&','<','>','"',"'");
			$replace = array('&amp;','&lt;','&gt;','&quot;','&apos;');
			
			$data = str_replace($search, $replace, $data);
		}
		return $data;
	}
}
?>








<hr><br><br>
<h2>XML用の記号エスケープ関数のソースコード</h2>
<pre>
/**
 * XML用の記号エスケープ関数
 * 
 * @note
 * 記号「 &amp;&lt;&gt;"' 」をXML用にエスケープする
 * 
 * @param any $data
 * @return エスケープ後のデータ
 */
function escapeMarkForXML($data){

	if(is_array($data)){
		foreach ($data as $key =&gt; $v){
			$data[$key] = escapeMarkForXML($v);
		}
		return $data;
	}else{
		if(gettype($data) == 'string'){
			
			$search = array('&amp;','&lt;','&gt;','"',"'");
			$replace = array('&amp;amp;','&amp;lt;','&amp;gt;','&amp;quot;','&amp;apos;');
			
			$data = str_replace($search, $replace, $data);
		}
		return $data;
	}
}
</pre>









<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>XML用の記号エスケープ関数 | escapeMarkForXML</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2017-2-10</div>
</body>
</html>