<?php
	$dt=new DateTime();
	echo $dt->format('y/m/d h:i:s');//タイムスタンプ
	echo '<br>';
	echo $dt->format('U');//タイムスタンプ



?>


<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>タイムスタンプ</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script>


		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">タイムスタンプ</h1>
		<div id="content" >

				<div class="sec1">
					DateTimeからタイムスタンプを取得する方法。

					<pre>
	$dt=new DateTime();
	echo $dt->format('y/m/d h:i:s');//タイムスタンプ
	echo '&ltbr>';
	echo $dt->format('U');//タイムスタンプ

					</pre>

				</div><!-- sec1 -->

		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/05/12</div>
		</div><!-- page1 -->
	</body>
</html>