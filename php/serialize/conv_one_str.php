<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>serialize関数で、変数や配列を１つの文字列にする</title>

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
			<h1>serialize関数で、変数や配列を１つの文字列にする</h1>
			<p></p>
		</div>
	</div>



	<div class="sec3">
		<h2>説明</h2>
		serialize関数で変数や多重構造配列等を1つの文字列に変換できる。<br>
		変換した文字列はunserialize関数で元の配列に戻すことができる。<br>

	</div>

	<div class="sec3">
		<h2>サンプル</h2>
		<?php

			$ary=array(
					array('id'=>101,'name'=>'ネコ'),
					array('id'=>102,'name'=>'ネズミ'),
					array('id'=>103,'name'=>'ウシ'),
					array('id'=>104,'name'=>'トラ'),
					array('id'=>105,'name'=>'鵜'),
					array('id'=>106,'name'=>'猿'),
			);

			echo "<p>変換前</p>";
			echo var_dump($ary);


			echo "<br><br><p>変換後：文字列＝serialize(配列)</p>";
			$str = serialize($ary);
			echo $str;

			echo "<br><br><br><p>unserializeで元に戻す。：配列＝unserialize(文字列)</p>";
			$ary2=unserialize($str);
			echo var_dump($ary2);


		?>

	</div>



	<br><br>
	<a href="http://php.net/manual/ja/function.serialize.php" class="btn btn-link btn-xs">ドキュメント</a>
	<br><br>

	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2014-11-10</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>