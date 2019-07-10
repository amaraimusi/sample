<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>配列からURLのクエリを作成 | http_build_query</title>

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
			<h1>配列からURLのクエリを作成 | http_build_query</h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">
		<h2>説明</h2>
		http_build_query関数は配列をURLのクエリ文字列に変換できる。<br>
		変換した文字列はparse_str関数で元の配列に戻すことができる。<br>

	</div>

	<div class="sec3">
		<h2>サンプル</h2>
		<?php


			$ary=array('neko'=>1,'inu'=>'2','tanuki'=>'狸');

			echo "<p>変換前</p>";
			echo var_dump($ary);


			echo "<br><br><p>変換後：文字列＝http_build_query(配列)</p>";
			$str = http_build_query($ary);
			echo $str;

			echo "<br><br><br><p>parse_str関数で元に戻す。：parse_str(文字列,配列B)</p>";
			parse_str($str,$ary2);
			echo var_dump($ary2);


		?>

	</div>




	<br><br>
	<a href="http://php.net/manual/ja/function.http-build-query.php" class="btn btn-link btn-xs">ドキュメント</a>
	<a href="http://suin.asia/2011/08/09/4_tips_to_preserve_array_as_string" class="btn btn-link btn-xs">参考サイト</a>
	<br><br>

	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2014-11-12</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>