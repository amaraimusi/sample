<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>画像処理GD | 標準サンプル</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>


</head>
<body>
<div id="header" ><h1>画像処理GD | 標準サンプル</h1></div>
<div class="container">












<a href="http://php.net/manual/ja/book.image.php" target="brank">PHPマニュアル</a>

<h2>gd_info()</h2>
<?php 
var_dump(gd_info());
?>
<br>

<h2>サンプル</h2>

<img src="imori.png" alt="" /><br>
imori.png<br>
<br>



<h3>基本</h3>
<p>画像ファイルを取り込む</p>
<pre>
	$img = imagecreatefrompng("imori.png");
	var_dump($img);
	imagedestroy($img); // 破棄
</pre>
<?php 
	$img = imagecreatefrompng("imori.png");
	var_dump($img);
	imagedestroy($img);
?>
<aside>
	ファイルが存在しない場合、falseを返すが、警告も表示される。<br>
	警告を出したくない場合は@マークを付加する。 例: $img = @imagecreatefrompng("none.png");<br>
</aside>
<br><br>

<p>取り込んだ画像からサイズを取得する</p>
<pre>
	$img = imagecreatefrompng("imori.png");
	$sx = imagesx($img);
	$sy = imagesy($img);
	imagedestroy($img);
	
</pre>
<?php 
	$img = imagecreatefrompng("imori.png");
	$sx = imagesx($img);
	$sy = imagesy($img);
	var_dump($sx);
	var_dump($sy);
	imagedestroy($img);
?>
<br><br>


<p>別名で保存する</p>
imagepngでimageオブジェクトを画像ファイルとして保存する。
<pre>
	$img = imagecreatefrompng("imori.png");
	
	// 楕円を描画
	$col_ellipse = imagecolorallocate($img, 255, 255, 255);
	imageellipse($img, 200, 150, 300, 200, $col_ellipse);
	
	// 別名で保存
	<strong>imagepng</strong>( $img, "imori2.png");
	imagedestroy($img);
</pre>
<?php 
// 	$img = imagecreatefrompng("imori.png");
	
// 	// 楕円を描画
// 	$col_ellipse = imagecolorallocate($img, 255, 255, 255);
// 	imageellipse($img, 200, 150, 300, 200, $col_ellipse);
	
// 	// 別名で保存
// 	imagepng( $img, "imori2.png");
// 	imagedestroy($img);
?>
<img src="imori2.png" alt="" />
<br><br>


<p>空画像を作成してファイル保存する</p>
<pre>
	// 空の画像を作成する
	$img = <strong>imagecreatetruecolor</strong>(200, 160);
	
	// 楕円の色を選択しますRGB
	$col = imagecolorallocate($img, 44,168,108);
	imageellipse($img, 50, 50, 60, 60, $col);
	
	// 画像を出力します
	imagepng( $img, "test1.png");
	
	imagedestroy($img);
</pre>
<?php 
// // 空の画像を作成する
// $img = imagecreatetruecolor(200, 160);

// // 楕円の色を選択しますRGB
// $col = imagecolorallocate($img, 44,168,108);
// imageellipse($img, 50, 50, 60, 60, $col);

// // 画像を出力します
// imagepng( $img, "test1.png");

// imagedestroy($img);

?>
<img src="test1.png" alt="" />



<br><br><br>



<h3>画像の大きさを取得する</h3>
<pre>
	$ret = getimagesize('imori.png');
	var_dump($ret);
</pre>
<?php 
	$ret = getimagesize('imori.png');
	var_dump($ret);
?>
<br>

<p>画像の文字列データから画像の大きさを取得する</p>
<pre>
	$data = file_get_contents('imori.png');// 文字列データとして取得
	$ret = getimagesizefromstring($data); // 文字列データから情報を取得する
	var_dump($ret);
</pre>
<?php 
	$data = file_get_contents('imori.png');// 文字列データとして取得
	$ret = getimagesizefromstring($data); // 文字列データから情報を取得する
	var_dump($ret);
?>
<br>
<br><br><br>



<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>画像処理GD | 標準サンプル</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2017-2-28</div>
</body>
</html>