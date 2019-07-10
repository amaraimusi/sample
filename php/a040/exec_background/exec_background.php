<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>execでバックグランド実行 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>
</head>
<body>
<div id="header" ><h1>execでバックグランド実行 | ワクガンス</h1></div>
<div class="container">




<h2>デモ</h2>
<?php 

$t1 = microtime(true);
echo 'START<br>';

// バックグラウンド（非同期）でPHPを実行する
execPhpByBackground('test.php');

$t0 = microtime(true) - $t1;
echo $t0 . 'ms<br>';
echo 'END<br>';

/**
 * バックグラウンド（非同期）でPHPを実行する
 * @param string $php_fp PHPファイルパス
 */
function execPhpByBackground($php_fp){

	if (PHP_OS == 'WIN32' || PHP_OS == 'WINNT') {
		// Windowsである場合のPHP非同期実行
		$fp = popen('start php test.php', 'r');
		pclose($fp);
	}else{
		// Linux系である場合のPHP非同期実行
		// → nohupはkillを防ぐ役割、「/dev/null &」は出力の除去を表す
		exec("nohup php -c '' 'test.php' > /dev/null &");
		
	}

}

?>




<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>execでバックグランド実行</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-12-14</div>
</body>
</html>