<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>アイコン生成ツールの検証 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>

</head>
<body>
<div id="header" ><h1>アイコン生成ツールの検証 | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<form action="#" method="post">
	<table><tbody>
		<tr><td>テキスト</td><td><input type="text" name="icon_text" value="日本" maxlength="3" style="width:60px"/>(日本語は2文字、アルファベットは3文字)</td></tr>
		<tr><td>背景色</td><td><input type="color" name="back_color" value="#dc4f43" /></td></tr>
		<tr><td>文字色</td><td><input type="color" name="text_color" value="#ffffff" /></td></tr>
		<tr><td></td><td><button class="btn btn-success">アイコン作成</button></td></tr>
	</tbody></table>
</form>
<hr>
<?php 

if(!empty($_POST)){
	
	$icon_text = $_POST['icon_text'];
	$back_color= $_POST['back_color'];
	$text_color = $_POST['text_color'];
	
	$fps = [];
	for($i=1;$i<13;$i++){
		$fps[] = makeIcon($icon_text, $i, $back_color, $text_color);
	}
	
	$t = time();
	foreach($fps as $fp){
		echo "<div style='display:inline-block;padding:5px;'><img src='{$fp}?t={$t}' style='width:32px;height:32px;' /> </div>";
	}
// 	echo '<hr>';
// 	foreach($fps as $fp){
// 		echo "<div style='display:inline-block;padding:5px;'><img src='{$fp}?t={$t}'  /> </div>";
// 	}
	
	
}

function makeIcon($icon_text, $index, $back_color, $text_color){
	$main_w = 120;
	$main_h = 120;
	$size = 34; // 文字列のサイズ
	$angle = 0; // 文字列の角度
	
	
	$img = imagecreatetruecolor($main_w, $main_h);
	
	
	
	$rgb = colorcodeToRGB($back_color);
	$back_color2 = imagecolorallocate($img, $rgb[0], $rgb[1], $rgb[2]); // 背景色（RGB値）
	
	$rgb = colorcodeToRGB($text_color);
	$text_color2 = imagecolorallocate($img, $rgb[0], $rgb[1], $rgb[2]); // テキストの色（RGB値）
	
	imagefill ($img ,0 , 0 ,  $back_color2 ); // 背景色で塗りつぶす
	
	$img_fp = "icon{$index}.png"; // 合成結果画像ファイルパス
	
// 	// ルートパスを取得する
// 	$root = $_SERVER['DOCUMENT_ROOT'];
// 	$root_last_str =  mb_substr($root, -1);
// 	if($root_last_str == '/' || $root_last_str == '\\'){
// 		$root = mb_substr($root,0,mb_strlen($root)-1);
// 	}
	
	$fontfile = "ipaexm.ttf"; // 文字列フォントの指定
	
	// Windows環境用の文字列フォント設定
	if(PHP_OS == 'WINNT' ){
		$fontfile = "C:\Windows\Fonts\meiryo.ttc";
	}
	
	// テキストを重ねる
	textOverlay($img, $main_w, $main_h, $size, $angle, $fontfile, $icon_text, $text_color2 );
	
	// 数値テキストを重ねる
	$num_text = $index;
	$num_text_size = 26;
	numTextOverlay($img, $main_w, $main_h, $num_text_size, $angle, $fontfile, $num_text, $text_color2);
	
	imagepng($img, $img_fp); // png形式で画像を出力
	
	return $img_fp;
}


function colorcodeToRGB($color_code){

	$color_code = preg_replace("/#/", "", $color_code);
	
	$res=[];
	$res[] = hexdec(substr($color_code, 0, 2)); // R
	$res[] = hexdec(substr($color_code, 2, 2)); // G
	$res[] = hexdec(substr($color_code, 4, 2)); // B
	
	return $res;
}



// テキスト重ね表示
function textOverlay($img, $main_w, $main_h, $size, $angle, $fontfile, $text, $color ){
	$info = imagettfbbox ( $size, $angle, $fontfile, $text );
	$text_w = abs($info[0] - $info[2]);
	$text_h = abs($info[1] - $info[5]);
	$x = ($main_w - $text_w) * 0.5 - $info[0];
	$y = ($main_h - $text_h) * 0.6  - $info[5] + $info[1];
	
// 	$cnt = mb_strlen ($text);
// 	$b_cnt = mb_strwidth($text);
// 	$text_w = $b_cnt * $size / 2;
// 	$a_w = 6 * $cnt; // 調整値
	
// 	$text_h = $size;
// 	$a_h = 6;
	
// 	$x = ($main_w - $text_w) * 0.5 - $a_w;
// 	$y = ($main_h - $text_h) * 0.6 + $size + $a_h;
	
	imagettftext($img, $size, $angle, $x, $y, $color, $fontfile, $text); // 文字列を画像に重ねて合成
}

// 数値テキスト重ね表示
function numTextOverlay($img, $main_w, $main_h, $size, $angle, $fontfile, $text, $color ){
	$info = imagettfbbox ( $size, $angle, $fontfile, $text );
	$text_w = abs($info[0] - $info[2]);
	$text_h = abs($info[1] - $info[5]);
	$x = ($main_w - $text_w) * 0.5 - $info[0];
	$y = ($main_h - $text_h) * 0.2  - $info[5] + $info[1];

// 	$cnt = mb_strlen ($text);
// 	$b_cnt = mb_strwidth($text);
// 	$text_w = $b_cnt * $size / 2;
// 	$a_w = 6 * $cnt; // 調整値
	
// 	$text_h = $size;
// 	$a_h = 0;
	
// 	$x = ($main_w - $text_w) * 0.5 - $a_w;
// 	$y = ($main_h - $text_h) * 0.2 + $size + $a_h;
	
	imagettftext($img, $size, $angle, $x, $y, $color, $fontfile, $text); // 文字列を画像に重ねて合成
}



?>




<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>アイコン生成ツールの検証</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2020-11-20</div>
</body>
</html>