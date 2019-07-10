

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>DateTime型日付と unix timestampの相互変換</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script>


		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">DateTime型日付と unix timestampの相互変換</h1>
		<div id="content" >

			<div class="sec1">

<?php
	$d1 = new DateTime("2006-12-12");
	echo $d1->format("Y-m-d H:i:s");
	echo "<br>";
	$u=$d1->format("U");
	echo $u;
	echo "<br>";
	$u+=86400;
	echo $u;
	echo "<br>";
	$d2=new DateTime();
	$d2->setTimestamp($u);
	echo $d2->format("Y-m-d H:i:s");



?>


			</div><!-- sec1 -->

		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/07/17</div>
		</div><!-- page1 -->
	</body>
</html>