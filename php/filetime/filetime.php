<?php


	$d1 = filemtime('sample/kuroba.png');
	$d1=date("Y/m/d H:i:s",$d1);


?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>ファイルの更新日時を取得</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script src="http://code.jquery.com/jquery-latest.js"></script><!-- 最新版読込 -->
		<script>


		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">ファイルの更新日時を取得</h1>
		<div id="content" >

			<div class="sec1">
				filemtime関数を使う。<br>
				なお、日本語ファイル名だとエラー。
<pre>
	$d1 = filemtime('sample/kuroba.png');
	$d1=date("Y/m/d H:i:s",$d1);
	</pre>
				<br><strong>出力</strong>
				<div>
				<?php echo $d1?>
				</div><br>
				サンプルファイル<br>
				<img src="sample/kuroba.png" />
			</div><!-- sec1 -->

		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/06/30</div>
		</div><!-- page1 -->
	</body>
</html>