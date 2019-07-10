<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>波ダッシュを全角チルダに変換する</title>

		<link href="../../style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../style2/css/common2.css" rel="stylesheet">

		<script src="../../style2/js/jquery-1.11.1.min.js"></script>
		<script src="../../style2/js/bootstrap.min.js"></script>


		<style>

		</style>
	</head>

<body>
<div class="container">


	<div class="row">
		<div id="header" class="col-lg-12" >
			<h1>波ダッシュを全角チルダに変換する</h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">
		<h2>サンプル</h2>

<?php 

	$wave_dash1 = '〜';
	$tilde1=preg_replace("/\xE3\x80\x9C/", "\xEF\xBD\x9E", $wave_dash1);

	echo $wave_dash1.'→'.$tilde1;
	
	
?>

	</div>



	<br><br>
	<a href="http://amaraimusi.sakura.ne.jp/" class="btn btn-link btn-xs">ホーム</a>
	<br><br>

	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2016-3-22</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>