<?php


	if(isset($_POST['submit1'])){




		$url = 'http://amaraimusi.sakura.ne.jp/sample/php/web_image_get/smp/imori.jpg';

		$data = file_get_contents($url);

		file_put_contents('img/test.jpg',$data);





		echo 'on submit1';



	}
	if(isset($_POST['submit_clear'])){
		unlink('img/test.jpg');
	}


?>

<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>web上の画像をコピーする</title>

		<link href="../../style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../style2/css/common2.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<script src="../../style2/js/jquery-1.11.1.min.js"></script>
		<script src="../../style2/js/bootstrap.min.js"></script>


		<style>

		</style>
	</head>

<body>
<div class="container">

	<div class="row">
		<div id="header" class="col-lg-12" >
			<h1>web上の画像をコピーする</h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">
		<h2>ソースコード</h2>
		<pre>
		$url = 'http://amaraimusi.sakura.ne.jp/sample/php/web_image_get/smp/imori.jpg';//WEB上の画像ファイルURL

		$data = file_get_contents($url);

		file_put_contents('img/test.jpg',$data);
		</pre>

	</div><br><br>

	<form name="form1"  action="#" method="post" enctype="multipart/form-data" >



		<h2>サンプル</h2>
		<input type="submit" name="submit1" value="画像コピー" class="btn btn-danger" value="danger"/>
		<input type="submit" name="submit_clear" value="クリア" class="btn btn-primary" value="primary"/>
	</form>

	<hr>
	<img src="img/test.jpg" class="img-responsive" />

	<br><br>
	<a href="http://php.net/manual/ja/function.file-get-contents.php" class="btn btn-link btn-xs">file_get_contentsのドキュメント</a>
	<a href="http://codaholic.org/?p=341" class="btn btn-link btn-xs">参考サイト</a>

	<br><br>

	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2014-11-05</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>