<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>テキストファイルを途中から読み込む</title>

		<link href="../../style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../style2/css/common2.css" rel="stylesheet">

		<script src="../../style2/js/jquery-1.11.1.min.js"></script>
		<script src="../../style2/js/bootstrap.min.js"></script>



	</head>

<body>
<div class="container">


	<div class="row">
		<div id="header" class="col-lg-12" >
			<h1>テキストファイルを途中から読み込む</h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">
		<h2>サンプル</h2>

	テキストファイル（text3.txt）
	<pre>
	色はにほへど
	散りぬるを
	我が世たれぞ
	常ならむ
	有為の奥山
	今日越えて
	浅き夢見じ
	酔ひもせず
	</pre>
	<br>

	ソースコード
	<pre>
	&lt;?php 
	$txtFn='test3.txt';
	$txtFn = mb_convert_encoding ( $txtFn, 'SJIS', 'UTF-8' );//全角ファイル名に対応
	echo "&lt;table border='1'&gt;&lt;thead&gt;&lt;tr&gt;&lt;th&gt;offset&lt;/th&gt;&lt;th&gt;行テキスト&lt;/th&gt;&lt;/tr&gt;&lt;/thead&gt;&lt;tbody&gt;";
	
	if ($fp = fopen ( $txtFn, "r" )) {
		fseek($fp, 54);//54バイト目から読み込む
		$data = array ();
		while ( false !== ($line = fgets ( $fp )) ) {
			$offset=ftell($fp);
			echo "&lt;tr&gt;&lt;td&gt;{$offset}&lt;/td&gt;&lt;td&gt;{$line}&lt;/td&gt;&lt;/tr&gt;";
		}
	}
	fclose ( $fp );
	
	echo '&lt;/tbody&gt;&lt;/table&gt;';
	?&gt;
	</pre>
	<br>
	
	出力
<?php 
$txtFn='test3.txt';
$txtFn = mb_convert_encoding ( $txtFn, 'SJIS', 'UTF-8' );//全角ファイル名に対応
echo "<table border='1'><thead><tr><th>offset</th><th>行テキスト</th></tr></thead><tbody>";

if ($fp = fopen ( $txtFn, "r" )) {
	fseek($fp, 54);//54バイト目から読み込む
	$data = array ();
	while ( false !== ($line = fgets ( $fp )) ) {
		$offset=ftell($fp);
		echo "<tr><td>{$offset}</td><td>{$line}</td></tr>";
	}
}
fclose ( $fp );

echo '</tbody></table>';
?>












	</div>



	<br><br>
	<a href="http://amaraimusi.sakura.ne.jp/" class="btn btn-link btn-xs">ホーム</a>
	<br><br>

	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2016-3-7</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>