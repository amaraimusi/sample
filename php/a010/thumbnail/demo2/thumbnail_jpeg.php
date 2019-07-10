<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>サムネイル画像作成 | JPEG</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>



</head>
<body>
<div id="header" ><h1>サムネイル画像作成 | JPEG</h1></div>
<div class="container">










<h2>デモ</h2>
<img src="orig/test1.jpg" alt="" /><br>

<form action="#" method="post">
	
<?php 
$orig_pfn = "orig/test1.jpg";
$thum_pfn = "thum/test1.jpg";

// オリジナル画像の幅を取得する
list($orig_width, $orig_height) = getimagesize($orig_pfn);


if(!empty($_POST)){

	// オリジナル画像のresourceオブジェクトを取得
	$origImg = imagecreatefromjpeg($orig_pfn);

	// サムネイル画像のresourceオブジェクトを取得
	$thumImg = imagecreatetruecolor(80, 60);
	
	// サムネイル画像を作成
	imagecopyresized($thumImg, $origImg, 0, 0, 0, 0,
			80, 60,
			$orig_width, $orig_height);

	
	// サムネイル画像を出力
	imagejpeg($thumImg,$thum_pfn);
	
	// resourceオブジェクトを破棄する
	imagedestroy($origImg);
	imagedestroy($thumImg);
	
	echo "<img src='{$thum_pfn}' /><br>";
}
?>
	<br>
	
	<input type="submit" name="submit1" value="TEST1"/>
</form>
<br>









<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>サムネイル画像作成 | JPEG</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2016-11-1</div>
</body>
</html>