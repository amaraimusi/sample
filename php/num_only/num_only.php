<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>文字列から数値のみ取り出す</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script>


		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">文字列から数値のみ取り出す</h1>
		<div id="content" >

			<div class="sec1">

<?php
	$test='\-10,123.45';
	$rtn=mb_ereg_replace('[^0-9.-]', '', $test);
	echo $test;
	echo '<br>';
	echo $rtn;

?>
<pre>

	$test='\-10,123.45';
	$rtn=mb_ereg_replace('[^0-9.-]', '', $test);
	echo $test;
	echo '&ltbr>';
	echo $rtn;
</pre>
<br><br>
0-9のみ取り出す場合
<pre>
	$rtn=mb_ereg_replace('[^0-9]', '', $test);
</pre>

			</div><!-- sec1 -->

		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/05/06</div>
		</div><!-- page1 -->
	</body>
</html>