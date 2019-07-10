<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>画像処理GD | 複数の画像を合成し、一枚の画像を作成する</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>


</head>
<body>
<div id="header" ><h1>画像処理GD | 複数の画像を合成し、一枚の画像を作成する</h1></div>
<div class="container">












<a href="http://php.net/manual/ja/book.image.php" target="brank">PHPマニュアル</a>



<h2>サンプル</h2>

合成する4枚の画像<br>
<img src="toumei1.png" alt="" />
<img src="toumei2.png" alt="" />
<img src="toumei3.png" alt="" />
<img src="toumei4.png" alt="" />
<br>

4枚の画像を合成して一枚の画像ファイルを作成する。透明、半透明を透過させながら合成する。<br>
<pre>
	// 空の画像を作成する
	$img = imagecreatetruecolor(320, 240);
	
	// 背景を透明にする
	imagecolortransparent($img, imagecolorallocate($img, 0, 0, 0));
	
	// 画像ファイル名群
	$imgFns = array('toumei1.png','toumei2.png','toumei3.png','toumei4.png');

	// シンプルな画像合成
	foreach($imgFns as $fn){
 		$img2 = imagecreatefrompng($fn); // 合成する画像を取り込む

 		// 合成する画像のサイズを取得
		$sx = imagesx($img2);
		$sy = imagesy($img2);
		
		<strong>imageLayerEffect</strong>($img, IMG_EFFECT_ALPHABLEND);// 合成する際、透過を考慮する
		<strong>imagecopy</strong>($img, $img2, 0, 0, 0, 0, $sx, $sy); // 合成する
		
		imagedestroy($img2); // 破棄
	}
	
	// 別名で保存
	imagepng( $img, "combine.png");
	imagedestroy($img);
</pre>
<?php 
	// 空の画像を作成する
	$img = imagecreatetruecolor(640, 480);
	
	// 背景を透明にする
	imagecolortransparent($img, imagecolorallocate($img, 0, 0, 0));
	
	// 画像ファイル名群
	$imgFns = array('toumei1.png','toumei2.png','toumei3.png','toumei4.png');

	// シンプルな画像合成
	foreach($imgFns as $fn){
 		$img2 = imagecreatefrompng($fn); // 合成する画像を取り込む

 		// 合成する画像のサイズを取得
		$sx = imagesx($img2);
		$sy = imagesy($img2);
		
		imageLayerEffect($img, IMG_EFFECT_ALPHABLEND);// 合成する際、透過を考慮する
		imagecopy($img, $img2, 0, 0, 0, 0, $sx, $sy); // 合成する
		
		imagedestroy($img2); // 破棄
	}
	
	
	// 別名で保存
	imagepng( $img, "combine.png");
	imagedestroy($img);
	

?>
<br>

画像：combine.png
<div style="background-color:#bdeffd">
	<img src="combine.png" alt="" />
</div>
<br><br>




<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>画像処理GD | 複数の画像を合成し、一枚の画像を作成する</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2017-2-28</div>
</body>
</html>