<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>サムネイル画像作成 | png,jpeg,pngに対応したクラス</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>



</head>
<body>
<div id="header" ><h1>サムネイル画像作成 | png,jpeg,pngに対応したクラス</h1></div>
<div class="container">










<h2>デモ</h2>


<form action="#" method="post">
	
<p>サムネイル</p>
<?php 
if(!empty($_POST)){
	require_once 'ThumbnailEx.php';

	$thumbnailEx = new ThumbnailEx();
	
	$orig_pfn1 = "orig/imori.png";
	$thum_pfn1 = "thum/imori.png";
	$thumbnailEx->createThumbnail($orig_pfn1,$thum_pfn1,80,100);
	echo "<img src='{$thum_pfn1}' />";
	
	$orig_pfn2 = "orig/test1.jpg";
	$thum_pfn2 = "thum/test1.jpg";
	$thumbnailEx->createThumbnail($orig_pfn2,$thum_pfn2,80,100);
	echo "<img src='{$thum_pfn2}' />";
	
	$orig_pfn3 = "orig/batta.gif";
	$thum_pfn3 = "thum/batta.gif";
	$thumbnailEx->createThumbnail($orig_pfn3,$thum_pfn3,80,100);
	echo "<img src='{$thum_pfn3}' />";
}
?>
	<br>
	
	<input type="submit" name="submit1" value="TEST1"/>
</form>
<br>

<hr>
<p>オリジナル画像</p>
<img src="orig/imori.png" alt="" />
<img src="orig/test1.jpg" alt="" />
<img src="orig/batta.gif" alt="" />
<hr>






<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>サムネイル画像作成 | png,jpeg,pngに対応したクラス</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2016-11-1</div>
</body>
</html>