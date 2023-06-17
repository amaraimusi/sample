<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SQLサニタイズ【2023年版】 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap-5.0.2-dist/font/css/open-iconic.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/css/bootstrap-5.0.2-dist/js/bootstrap.bundle.js"></script>
	<script src="/note_prg/js/vue.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/ImgCompactK.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>SQLサニタイズ【2023年版】 | ワクガンス</h1></div>
<div class="container">



<table class="tbl2">
<thead><tr><th>UTF-8</th><th>Shift-JIS変換</th><th>addslashes関数</th><th>sqlSanitize自作関数</th></tr></thead>
<tbody>
<?php 

$data = ['123', '-123', 'あ', '""', '表', '表\\', '表\\\'', "表 OR '1'='1"];

$xxx =  "表\' OR 1=1";

$data[]  = mb_convert_encoding($xxx, 'Shift-JIS');


foreach($data as $str){
	$str1 = mb_convert_encoding($str, 'SJIS', 'UTF-8');
	$str2 = sqlSanitize($str1);
	$str3 = addslashes($str1);
	echo "<tr><td>{$str}</td><td>{$str1}</td><td>{$str3}</td><td style='font-weight:bold'>{$str2}</td></tr>";
}



function sqlSanitize($text) {
	$text = trim($text);
	
	// 文字列がUTF-8でない場合、UTF-8に変換する
	if(!mb_check_encoding($text, 'UTF-8')){
		$text = str_replace(['\\', '/', '\'', '"', '`',' OR '], '', $text);
		$text = mb_convert_encoding($text, 'UTF-8');
	}
		
	// SQLインジェクションのための特殊文字をエスケープする
	$search = array("\\", "\x00", "\n", "\r", "'", '"', "\x1a", "`");
	$replace = array("\\\\", "\\0", "\\n", "\\r", "\\'", "\\\"", "\\Z", "");
	
	$text = str_replace($search, $replace, $text);
		
	return $text;
}

?>
</tbody>
</table>

<p>sqlSanitize自作関数</p>
<pre><code>
function sqlSanitize($text) {
	$text = trim($text);
	
	// 文字列がUTF-8でない場合、UTF-8に変換する
	if(!mb_check_encoding($text, 'UTF-8')){
		$text = str_replace(['&yen;&yen;', '/', '&yen;'', '"', '`',' OR '], '', $text);
		$text = mb_convert_encoding($text, 'UTF-8');
	}
		
	// SQLインジェクションのための特殊文字をエスケープする
	$search = array("&yen;&yen;", "&yen;x00", "&yen;n", "&yen;r", "'", '"', "&yen;x1a", "`");
	$replace = array("&yen;&yen;&yen;&yen;", "&yen;&yen;0", "&yen;&yen;n", "&yen;&yen;r", "&yen;&yen;'", "&yen;&yen;&yen;"", "&yen;&yen;Z", "");
	
	$text = str_replace($search, $replace, $text);
		
	return $text;
}
</code></pre>


<p>テストコード</p>
<pre><code>
$data = ['123', '-123', 'あ', '""', '表', '表&yen;&yen;', '表&yen;&yen;&yen;'', "表 OR '1'='1"];

$xxx =  "表&yen;' OR 1=1";

$data[]  = mb_convert_encoding($xxx, 'Shift-JIS');


foreach($data as $str){
	$str1 = mb_convert_encoding($str, 'SJIS', 'UTF-8');
	$str2 = sqlSanitize($str1);
	$str3 = addslashes($str1);
	echo "&lt;tr&gt;&lt;td&gt;{$str}&lt;/td&gt;&lt;td&gt;{$str1}&lt;/td&gt;&lt;td&gt;{$str3}&lt;/td&gt;&lt;td style='font-weight:bold'&gt;{$str2}&lt;/td&gt;&lt;/tr&gt;";
}
</code></pre>



<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>SQLサニタイズ【2023年版】</li>
</ol>
</div><!-- content -->
<div id="footer">(C) amaraimusi 2023-6-15</div>
</body>
</html>