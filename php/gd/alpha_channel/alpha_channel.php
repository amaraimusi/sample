<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>画像処理GD | アルファチャネルによる透明</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>


</head>
<body>
<div id="header" ><h1>画像処理GD | アルファチャネルによる透明</h1></div>
<div class="container">












<a href="http://php.net/manual/ja/book.image.php" target="brank">PHPマニュアル</a>



<h2>サンプル</h2>

元画像：toumei.png:背景透明<br>
<img src="toumei.png" alt="" /><br>
<br>

元画像を取り込み、赤い円を描画し、透明を保ったまま保存する。<br>
<pre>
	$img = imagecreatefrompng("toumei.png");
	
	//ブレンドモードを無効にする
	<strong>imagealphablending</strong>($img, false);
	
	//完全なアルファチャネル情報を保存するフラグをonにする
	<strong>imagesavealpha</strong>($img, true);
	
	// 楕円を描画RGB
	$col = imagecolorallocate($img, 221,77,64);
	imageellipse($img, 50, 50, 60, 60, $col);
	
	// 別名で保存
	imagepng( $img, "toumei2.png");
	imagedestroy($img);
</pre>
<?php 
// 	$img = imagecreatefrompng("toumei.png");
	
// 	//ブレンドモードを無効にする
// 	imagealphablending($img, false);
	
// 	//完全なアルファチャネル情報を保存するフラグをonにする
// 	imagesavealpha($img, true);
	
// 	// 楕円を描画RGB
// 	$col = imagecolorallocate($img, 221,77,64);
// 	imageellipse($img, 50, 50, 60, 60, $col);
	
// 	// 別名で保存
// 	imagepng( $img, "toumei2.png");
// 	imagedestroy($img);
?>
<br>

画像：toumei2.png
<div style="background-color:#bdeffd">
	<img src="toumei2.png" alt="" />
</div>
<br><br>




<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>画像処理GD | アルファチャネルによる透明</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2017-2-28</div>
</body>
</html>