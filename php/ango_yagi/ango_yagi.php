<?php

// 	$pass='kamakiri';


// 	$ps=str_split($pass);

// 	$nps=null;
// 	foreach($ps as $p){
// 		$a= bin2hex ($p);
// 		$a=hexdec($a);

// 		$nps[]=$a;
// 	}

// 	foreach($nps as $np){
// 		echo $np."<br>";
// 	}



// // 	$s= bin2hex ( $p );



// // 	$s=hexdec($s);

// // 	$arr1 = str_split($s);

// // 	$d=new DateTime();
// // 	$u=$d->format('U');

// // 	$u=$u*4;

// // 	$r=rand() * 5873;



// // 	echo $s."<br>";
// // 	echo $u."<br>";
// // 	echo $r."<br>";




// //暗号化するデータ
// $plain_text = 'これは秘密のメッセージです。';

// //暗号化＆復号化キー
// $key = md5('KQAHGOEUXD');

// //暗号化モジュール使用開始
// $td  = mcrypt_module_open('des', '', 'ecb', '');
// $key = substr($key, 0, mcrypt_enc_get_key_size($td));
// $iv  = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);

// //暗号化モジュール初期化
// if (mcrypt_generic_init($td, $key, $iv) < 0) {
//   exit('error.');
// }

// //データを暗号化
// $crypt_text = base64_encode(mcrypt_generic($td, $plain_text));

// //暗号化モジュール使用終了
// mcrypt_generic_deinit($td);
// mcrypt_module_close($td);

// //結果を表示
// echo "<!DOCTYPE html>\n";
// echo "<html lang=\"ja\">\n";
// echo "<head>\n";
// echo "<meta charset=\"utf-8\" />\n";
// echo "<title>暗号化テスト</title>\n";
// echo "</head>\n";
// echo "<body>\n";
// echo "<h1>暗号化テスト</h1>\n";
// echo "<dl>\n";
// echo "<dt>暗号化前</dt><dd>" . $plain_text . "</dd>";
// echo "<dt>暗号化後</dt><dd>" . $crypt_text . "</dd>";
// echo "</dl>\n";
// echo "</body>\n";
// echo "</html>\n";



// //復号化するデータ
// $crypt_text = 'eVVX5OPG0Vj4L49cuq8A3KT1R2nljAIPn74vAw0d/QbYQ1CfUApMlqSpSkyDjDvi';

// //暗号化＆復号化キー
// $key = md5('KQAHGOEUXD');

// //暗号化モジュール使用開始
// $td  = mcrypt_module_open('des', '', 'ecb', '');
// $key = substr($key, 0, mcrypt_enc_get_key_size($td));
// $iv  = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);

// //暗号化モジュール初期化
// if (mcrypt_generic_init($td, $key, $iv) < 0) {
//   exit('error.');
// }

// //データを復号化
// $plain_text = mdecrypt_generic($td, base64_decode($crypt_text));

// //暗号化モジュール使用終了
// mcrypt_generic_deinit($td);
// mcrypt_module_close($td);

// //結果を表示
// echo "<!DOCTYPE html>\n";
// echo "<html lang=\"ja\">\n";
// echo "<head>\n";
// echo "<meta charset=\"utf-8\" />\n";
// echo "<title>復号化テスト</title>\n";
// echo "</head>\n";
// echo "<body>\n";
// echo "<h1>復号化テスト</h1>\n";
// echo "<dl>\n";
// echo "<dt>復号化前</dt><dd>" . $crypt_text . "</dd>";
// echo "<dt>復号化後</dt><dd>" . $plain_text . "</dd>";
// echo "</dl>\n";
// echo "</body>\n";
// echo "</html>\n";
require_once 'AngoYagi.php';
$a=new AngoYagi();
$str="いろはにほへとちりぬのをわかよたれそつねならむ";
echo $str."<br>";
$kagi="AGITHLSET";
$x=$a->ango($str,$kagi);
echo $x."<br>";
$x2=$a->hukugo($x,$kagi);
echo $x2."<br>";



// function ango($str,$kagi){
// // 	//暗号化するデータ
// // 	$str = 'これは秘密のメッセージです。';

// // 	//暗号化＆復号化キー
// // 	$kagi = md5('KQAHGOEUXD');

// 	//暗号化モジュール使用開始
// 	$td  = mcrypt_module_open('des', '', 'ecb', '');
// 	$kagi = substr($kagi, 0, mcrypt_enc_get_key_size($td));
// 	$iv  = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);

// 	//暗号化モジュール初期化
// 	if (mcrypt_generic_init($td, $kagi, $iv) < 0) {
// 		exit('error.');
// 	}

// 	//データを暗号化
// 	$crypt_text = base64_encode(mcrypt_generic($td, $str));

// 	//暗号化モジュール使用終了
// 	mcrypt_generic_deinit($td);
// 	mcrypt_module_close($td);

// 	return $crypt_text;
// }

// function hukugo($str,$kagi){
// // 	//復号化するデータ
// // 	$str = 'eVVX5OPG0Vj4L49cuq8A3KT1R2nljAIPn74vAw0d/QbYQ1CfUApMlqSpSkyDjDvi';

// // 	//暗号化＆復号化キー
// // 	$kagi = md5('KQAHGOEUXD');

// 	//暗号化モジュール使用開始
// 	$td  = mcrypt_module_open('des', '', 'ecb', '');
// 	$kagi = substr($kagi, 0, mcrypt_enc_get_key_size($td));
// 	$iv  = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);

// 	//暗号化モジュール初期化
// 	if (mcrypt_generic_init($td, $kagi, $iv) < 0) {
// 		exit('error.');
// 	}

// 	//データを復号化
// 	$plain_text = mdecrypt_generic($td, base64_decode($str));

// 	//暗号化モジュール使用終了
// 	mcrypt_generic_deinit($td);
// 	mcrypt_module_close($td);

// 	return $plain_text;
// }




?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>XXX</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script src="jquery-1.11.1.min.js"></script>
		<script>

			$(document).ready(function(){

			});

		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">XXX</h1>
		<div id="content" >

			<div class="sec1">


			</div><!-- sec1 -->

		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/06/26</div>
		</div><!-- page1 -->
	</body>
</html>