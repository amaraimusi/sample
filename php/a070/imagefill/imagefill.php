<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>塗りつぶし | imagefill | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>

</head>
<body>
<div id="header" ><h1>塗りつぶし | imagefill | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<?php 

$img = imagecreatetruecolor(240, 160);
$color = imagecolorallocate($img, 250, 50, 50); // 塗りつぶし色
imagefill ($img ,0 , 0 ,  $color );

// 画像を出力します
imagepng( $img, "test.png");
imagedestroy($img);
$t = time();
echo "<img src='test.png?t={$t}' />";
?>



<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>塗りつぶし | imagefill</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2020-11-22</div>
</body>
</html>