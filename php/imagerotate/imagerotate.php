<?php
	// ファイルと回転角
	$filename = 'test.jpg';
	$degrees = 90;

	// コンテントタイプ
	//header('Content-type: image/jpeg');

	// 読み込み
	$source = imagecreatefromjpeg($filename);

	// 回転
	$rotate = imagerotate($source, $degrees, 0);

	// 画像オブジェクトからJPEGファイルを作成する。引数：画像オブジェクト、保存するファイル名（省略すると保存しない）、品質（0～100　省略時は75）
	imagejpeg($rotate,$filename,100);

	// メモリの解放
	imagedestroy($source);
	imagedestroy($rotate);


?>
<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>画像を回転させて保存</title>

		<link href="../../style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../style2/css/common2.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<script src="../../style2/js/jquery-1.11.1.min.js"></script>
		<script src="../../style2/js/bootstrap.min.js"></script>


		<style>

		</style>
	</head>

<body>
<div class="container">

	<div class="row">
		<div id="header" class="col-lg-12" >
			<h1>画像を回転させて保存</h1>
			<p>JPEG対応</p>
		</div>
	</div>

	<div class="sec3">
		<h2>説明</h2>
		ブラウザをリロードするたびに90°ずつ角度が変わります。<br>

		<img src="test.jpg" class="img-responsive" >
	</div>





	<br><br>
	<a href="http://php.net/manual/ja/function.imagerotate.php" class="btn btn-link btn-xs">ドキュメント</a>
	<br><br>

	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2014-11-05</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>