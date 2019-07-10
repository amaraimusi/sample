<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>IPアドレスを取得する</title>

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
			<h1>IPアドレスを取得する</h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">
		<h2>サンプル</h2>
		
		<pre>		
		$ipAddr=$_SERVER["REMOTE_ADDR"];//IPアドレス取得
		echo "ipAddr={$ipAddr}&ltbr&gt";
		
		$ipVal = ip2long($ipAddr);// IPアドレスを数値変換
		echo "ipVal={$ipVal}&ltbr&gt";
		
		//CakePHPでのIPアドレス取得
		//$ipAddr=$this->request->clientIp(false);
		</pre>
		<?php 
		$ipAddr=$_SERVER["REMOTE_ADDR"];//IPアドレス取得
		echo "ipAddr={$ipAddr}<br>";
		
		$ipVal = ip2long($ipAddr);// IPアドレスを数値変換
		echo "ipVal={$ipVal}<br>";
		
		//CakePHPでのIPアドレス取得
		//$ipAddr=$this->request->clientIp(false);
		
		?>

	</div>




	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2015-09-17</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>