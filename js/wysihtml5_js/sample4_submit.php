<?php

	$textarea1=$_POST['textarea1'];
?>

<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">

		<title>sample4 submit</title>



		<script src="../../style2/js/jquery-1.11.1.min.js"></script>

		<script>
			$( function() {
				//～読込イベント処理～
			});
		</script>
		<style>
			.param{
				border: solid 3px #db5625;
				padding:10px;
				margin-bottom:50px;
			}
		</style>
	</head>

<body>

<h1 >sample4 submit</h1>


<h2 >テキスト1</h2>
<div class="param">
	<?php echo $textarea1;?>
</div>



<a href="sample4.php">戻る</a>

<p style="font-size:0.8em;color:#bc99fd">(c)wacgance 2015-07-29</p>
</body>
</html>