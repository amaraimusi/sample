<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>画像に文字を重ねる | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>

</head>
<body>
<div id="header" ><h1>画像に文字を重ねる | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<?php 

$back_img_fp = "imori.jpg"; // 背景画像ファイルパス
$size = 32; // 文字列のサイズ
$angle = 0; // 文字列の角度
$text = "シリケンイモリ"; // 重ねて合成表示する文字列

$fontfile = "ipaexm.ttf"; // 文字列フォントの指定

// Windows環境用の文字列フォント設定
if(PHP_OS == 'WINNT' ){
	$fontfile = "C:\Windows\Fonts\meiryo.ttc";
}

$image = imagecreatefromjpeg($back_img_fp);// 画像リソース IDを取得（失敗時はfalse)
$info = imagettfbbox ( $size, $angle, $fontfile, $text );

echo "<table class='table'>";
foreach($info as $i => $v){
	echo "<tr><td>{$i}</td><td>{$v}</td></tr>";
}
echo '</table>';

$color = imagecolorallocate($image, 255, 255, 255); // 文字列の色（int型：色ID）

// 挿入位置
$x = 8;         // 文字列の位置：左上座標
$y = 8 + $size; // 文字列の位置：左上座標



imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text); // 文字列を画像に重ねて合成

imagepng($image, 'test.png'); // png形式で画像を出力

?>
<img src="test.png?t=<?php echo time(); ?>" /><br>



<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>画像に文字を重ねる</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2020-11-20</div>
</body>
</html>