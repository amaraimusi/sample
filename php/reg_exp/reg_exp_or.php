<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>OR条件(または) | PHPの正規表現</title>

		<link href="/sample/style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="/sample/style2/css/common2.css" rel="stylesheet">

		<script src="/sample/style2/js/jquery-1.11.1.min.js"></script>
		<script src="/sample/style2/js/bootstrap.min.js"></script>


		<style>

		</style>
	</head>

<body>
<div class="container">

	<div id="header" >
		<h1>OR条件(または) | PHPの正規表現</h1>
	</div>

	<h3>基本サンプル</h3>
	正規表現でOR条件を実現にするには「|」を記述する。<br>
	<pre class="kata">/文字1<strong>|</strong>文字2/</pre>
	文字1または文字2に一致<br>
	<br>
	
	<p>サンプル1</p>
	<pre>
	$tests[] = "大きなネコと小さなイヌがいました。";
	$tests[] = "大きなネコがいました。";
	$tests[] = "小さなイヌがいました。";
	$tests[] = "普通サイズのヤギがいました。";
	
	foreach($tests as $test){
		if(preg_match('<strong>/イヌ|ネコ/</strong>', $test)){
			echo $test.'→'.'○&lt;br&gt;';
		}else{
			echo $test.'→'.'×&lt;br&gt;';
		}
	}
	</pre>
	
	出力
	<div class="output_data">
	<?php 
		$tests[] = "大きなネコと小さなイヌがいました。";
		$tests[] = "大きなネコがいました。";
		$tests[] = "小さなイヌがいました。";
		$tests[] = "普通サイズのヤギがいました。";
		
		foreach($tests as $test){
			if(preg_match('/イヌ|ネコ/', $test)){
				echo $test.'→'.'○<br>';
			}else{
				echo $test.'→'.'×<br>';
			}
		}
		
	?>
	</div>
	<br>
	<hr>
	
	<h3>応用サンプル</h3>
	文字列に日付が含まれているか調べる正規表現のサンプル。<br>
	日付のセパレータは「/」、「-」、「年月日」などがある。<br>
	OR条件を応用して、これら複数のセパレータに対応してみる。<br>
	<br>
	
	<p>サンプル2</p>
	<pre>
	$tests=null;
	$tests[] = "いろは2016-6-6ネコ";
	$tests[] = "いろは2016/6/6イヌ";
	$tests[] = "いろは2016年6月6日ヤギ";
	$tests[] = "いろは";

	foreach($tests as $test){
		$re = '/([1-9][0-9]{3})<strong>&yen;/|-|年</strong>([1-9]{1}|1[0-2]{1})<strong>&yen;/|-|月</strong>([1-9]{1}|[1-2]{1}[0-9]{1}|3[0-1]{1})/';
		if(preg_match($re, $test)){
			echo $test.'→'.'○&lt;br&gt;';
		}else{
			echo $test.'→'.'×&lt;br&gt;';
		}
	}
	</pre>
	<div class="output_data">
	<?php 
		$tests=null;
		$tests[] = "いろは2016-6-6ネコ";
		$tests[] = "いろは2016/6/6イヌ";
		$tests[] = "いろは2016年6月6日ヤギ";
		$tests[] = "いろは";
	
		foreach($tests as $test){
			$re = '/([1-9][0-9]{3})\/|-|年([1-9]{1}|1[0-2]{1})\/|-|月([1-9]{1}|[1-2]{1}[0-9]{1}|3[0-1]{1})/';
			if(preg_match($re, $test)){
				echo $test.'→'.'○<br>';
			}else{
				echo $test.'→'.'×<br>';
			}
		}
	?>
	</div>
	<br>

	<br>
	<div class="yohaku"></div>
	<ol class="breadcrumb">
		<li><a href="/">ホーム</a></li>
		<li><a href="/sample">サンプルソースコード</a></li>
		<li><a href="/sample/php">ＰＨＰ　｜　サンプル</a></li>
		<li>OR条件(または) | PHPの正規表現</li>
	</ol>

	<div id="footer"  >
		<a href="/">(c)wacgance</a> 2016-6-6 
	</div>
	

		


</div><!-- container  -->
</body>
</html>