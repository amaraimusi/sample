<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>文字列を配列化する</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>



</head>
<body>
<div id="header" ><h1>文字列を配列化する</h1></div>
<div class="container">








<h2>デモ1</h2>
<?php 
$str = "Hello world!";
echo $str.'<br>';
$ary = str_split($str);
var_dump($ary);
?>
<br>


<h2>デモ2 : 日本語</h2>
<?php 
$str = "あなた自身の水溜めから水を，あなた自身の井戸から水の滴りを飲め";
echo $str.'<br>';
$ary = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
var_dump($ary);
?>
<br>


<h2>デモ3 : 重複除去とソート</h2>
<?php 
$str = "あなた自身の水溜めから水を，あなた自身の井戸から水の滴りを飲め";
echo $str.'<br>';
$ary = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
$ary=array_unique($ary);// 配列から重複値を除去する
sort($ary); // 配列をソートする
var_dump($ary);
?>
<br>









<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>文字列を配列化する</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2016-11-25</div>
</body>
</html>