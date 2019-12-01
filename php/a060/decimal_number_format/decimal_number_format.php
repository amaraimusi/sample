<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>小数点以下の0(ゼロ)埋めて桁数をそろえる | number_format | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>

</head>
<body>
<div id="header" ><h1>小数点以下の0(ゼロ)埋めて桁数をそろえる | number_format | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<pre>
$num1 = 123.456;
$num2 = 123.45678;
$num3 = 123;
$num4 = 123.45674;
$num5 = 123.45675;

echo number_format($num1, 4) . '&lt;br&gt;';
echo number_format($num2, 4) . '&lt;br&gt;';
echo number_format($num3, 4) . '&lt;br&gt;';
echo number_format($num4, 4) . '&lt;br&gt;';
echo number_format($num5, 4) . '&lt;br&gt;'; // 切り捨て部分は四捨五入される。
</pre>
<?php 

$num1 = 123.456;
$num2 = 123.45678;
$num3 = 123;
$num4 = 123.45674;
$num5 = 123.45675;

echo number_format($num1, 4) . '<br>';
echo number_format($num2, 4) . '<br>';
echo number_format($num3, 4) . '<br>';
echo number_format($num4, 4) . '<br>';
echo number_format($num5, 4) . '<br>'; // 切り捨て部分は四捨五入される。

?>


<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>小数点以下の0(ゼロ)埋めて桁数をそろえる | number_format</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2019-12-1</div>
</body>
</html>