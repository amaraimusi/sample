<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>テキストファイルを途中から読込 | オフセットから読込 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/ImgCompactK.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>テキストファイルを途中から読込 | オフセットから読込 | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>


<pre>

</pre>
PHP
<pre><code>

</code></pre>
<pre class="console">
<?php 
$mem1 =  memory_get_usage();

$fn = "test.txt";
// $fn = "big.csv";

$fsize = filesize ($fn);
echo "ファイルサイズ：{$fsize}<br>";
$end_flg = false;
$offset = 0;
$str_size_total = 0;
for($x_i=0;$x_i<1000000;$x_i++){
	
	if ($fp = fopen ( $fn, "r" )) {
		fseek( $fp, $offset );

		for($i=0;$i<1000;$i++){
			$line = fgets ($fp);
			if($line == false){
				$end_flg=true;
				break;
			}
			$str_size_total += strlen($line);
			//echo $line . '<br>';
		}
		$offset = ftell($fp);
		fclose($fp);
	}
	
	$mem2 =  memory_get_usage() - $mem1;
	echo "----------{$x_i}  {$mem2}<br>";
	
	if($end_flg == true){
		echo '終了しました。<br>';
		break;
	}
}
echo "文字サイズ合計：{$str_size_total}";
?>
</pre>


<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>テキストファイルを途中から読込 | オフセットから読込</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2019-5-6</div>
</body>
</html>