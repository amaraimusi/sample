<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>コマンドを実行する | shell_exec | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
    <link href="/note_prg/css/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/note_prg/css/bootstrap-5.0.2-dist/font/css/open-iconic.min.css" rel="stylesheet">
    <link href="/note_prg/css/highlight/default.css" rel="stylesheet">
    <link href="/note_prg/css/common2.css" rel="stylesheet">
    <script src="/note_prg/js/jquery3.js"></script> <!-- jquery-3.3.1.min.js -->
    <script src="/note_prg/css/bootstrap-5.0.2-dist/js/bootstrap.bundle.js"></script>
    <script src="/note_prg/js/vue.min.js"></script>
    <script src="/note_prg/js/highlight.pack.js"></script>
    <script src="/note_prg/js/livipage.js"></script>
    <script src="/note_prg/js/ImgCompactK.js"></script>
	<script src="script.js"></script>

</head>
<body>
<div id="header" ><h1>コマンドを実行する | shell_exec | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<?php 
echo '<br>-----------A<br>';

// Windowsコマンドプロンプトのコマンド
$cmd_str = 'cd C:\xampp\mysql\bin && mysqldump --default-character-set=utf8 -uroot crud_base_laravel9 nekos > C:\tmp\nekos.sql';
$out = shell_exec($cmd_str);
var_dump($out);

echo '<br>-----------<br>';

$cmd_str = 'cd C:\xampp\mysql\bin && mysqldump --default-character-set=utf8 -uroot crud_base_bulk > C:\tmp\crud_base_bulk.sql';
$out = shell_exec($cmd_str);
var_dump($out);

// echo '<br>-----------<br>';
// //$output = shell_exec('ls -l');
// $output = shell_exec('bash');
// $output = shell_exec('ls -l');
// var_dump($output);

// echo '<br>-----------<br>';
// mb_convert_variables('UTF-8', 'SJIS-win' ,$output);

// //$output = mb_convert_encoding($output , 'SJIS' , 'UTF-8');
// echo $output;
echo '<br>-----------<br>';
?>


<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>コマンドを実行する | shell_exec</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2023-1-7</div>
</body>
</html>