<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ob_startとob_end_cleanによる出力バッファのクリア</title>

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
			<h1>ob_startとob_end_cleanによる出力バッファのクリア</h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">
		
		「ob_start」と「ob_end_clean」に囲まれた範囲は出力されなくなります。
		<h2>検証</h2>

		<p>source code</p>
		<pre>
	&lt;?php 
	echo 'ねこ&lt;br&gt;';
	ob_start();
	echo 'やぎ&lt;br&gt;';<strong>←出力されない</strong>
	ob_end_clean();
	echo 'かに&lt;br&gt;';
	?&gt;
		</pre>
		<br>
		
		<p>出力</p>
		<div style="color:#dd4f43">
		<?php 
		echo 'ねこ<br>';
		ob_start();
		echo 'やぎ<br>';
		ob_end_clean();
		echo 'かに<br>';
		?>
		</div>
	</div>



	<br><br>
	<a href="http://php.net/manual/ja/function.ob-end-clean.php" target="brank" class="btn btn-link btn-xs">ドキュメント</a>
	<br><br>

	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2016-1-28</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>