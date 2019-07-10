<?php
$base64=$_POST['base64'];
$file_name=$_POST['file_name'];

$file_name = urldecode ($file_name);
$file_name = 'img/'.$file_name;
echo $file_name;


// BASE64バイナリ文字列をファイルに変換して書き出す
if($_SERVER['SERVER_NAME']=='localhost'){
	$base64 = base64_decode($base64);
	$base64 = preg_replace("/data:[^,]+,/i","",$base64);
	$base64 = base64_decode($base64);
	file_put_contents($file_name, $base64);
}







