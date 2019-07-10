<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ローワーキャメルケース</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
</head>
<body>
<div id="header" ><h1>ローワーキャメルケース</h1></div>
<div class="container">













<h2>デモ</h2>
<?php 

$data = array(
		'neko',
		'big_dog',
		'RedFox',
		'greenTanuki',
		'big_last_pig_master',
		'SmallFirstPigMaster',
		'smallFirstPigMaster',
		'',
		'あいう',
		'123'
		
);

echo "<table class='tbl2'><thead><tr><th>元文字</th><th>ローワーキャメルケース</th></tr></thead><tbody>";
foreach($data as $str){
	$lc_str = lowerCamelize($str);
	echo "<tr><td>{$str}</td><td>{$lc_str}</td></tr>";
}
echo "</tbody></table>";


/**
 * ローワーキャメルケースに変換する
 *
 * @note
 * ローワーキャメルケースは先頭の一文字が小文字のキャメルケース。
 *
 * @param string $str スネーク記法、またはキャメル記法の文字列
 * @return string ローワーキャメルケースの文字列
 */
function lowerCamelize($str){
	
	if(empty($str)) return $str;
	
	// 先頭の一文字が小文字である場合、一旦キャメルケースに変換する。
	$h_str = substr($str,0,1);
	if(ctype_lower($h_str)){
		// キャメルケースに変換する
		$str = strtr($str, '_', ' ');
		$str = ucwords($str);
		$str = str_replace(' ', '', $str);
	}
	
	// 先頭の一文字を小文字に変換する。
	$str = lcfirst($str);
	
	return $str;

}

?>










<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>ローワーキャメルケース</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-4-22</div>
</body>
</html>