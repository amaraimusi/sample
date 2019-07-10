<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ループにおける関数処理を高速化する</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>

</head>
<body>
<div id="header" ><h1>ループにおける関数処理を高速化する</h1></div>
<div class="container">













<h2>検証</h2>

<p>遅い</p>
<pre class="intro_source_code">
$list = array();
for($i=0;$i&lt;2000;$i++){
	$list = func1($list,$i);
}

function func1($list,$n){
	$list[] = $n;
	return $list;
}
</pre>

<?php 

// 検証1
$start_tim =  microtime(true);
$list = array();
for($i=0;$i<2000;$i++){
	$list = func1($list,$i);
}
$res_tim = microtime(true)-$start_tim;
var_dump($res_tim);

function func1($list,$n){
	$list[] = $n;
	return $list;
}

?>

<hr>

<p>速い</p>
<pre class="intro_source_code">
$list = array();
for($i=0;$i&lt;2000;$i++){
	func2($list,$i);
}

function func2(&$list,$n){
	$list[] = $n;
}
</pre>
<?php 
// 検証2
$start_tim =  microtime(true);
$list = array();
for($i=0;$i<2000;$i++){
	func2($list,$i);
}
$res_tim = microtime(true)-$start_tim;
var_dump($res_tim);

function func2(&$list,$n){
	$list[] = $n;
}
?>





<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>ループにおける関数処理を高速化する</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2017-4-5</div>
</body>
</html>