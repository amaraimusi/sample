<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>プロキシチェック</title>

		<link href="../../style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../style2/css/common2.css" rel="stylesheet">

		<script src="../../style2/js/jquery-1.11.1.min.js"></script>
		<script src="../../style2/js/bootstrap.min.js"></script>
		<script src="../../login_simple_a/login_simple_a.js"></script>

		<script>
			$( function() {
	
				var url= '/sample/login_simple_a';
				loginSimpleA(url);//ログインシンプル
			});
		</script>

		<style>

		</style>
	</head>

<body>
<div class="container">



	<div class="row">
		<div id="header" class="col-lg-12" >
			<h1>プロキシチェック</h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">
		<h2>プロキシに関係しそうな情報を取得</h2>
		<table class="table">
			<thead>
				<tr><th>コード</th><th>説明</th><th>取得値</th></tr>
			</thead>
			<tbody>
				<tr><td>$_SERVER['REMOTE_ADDR']</td><td>アクセス元のIPアドレスまたは、ProxyサーバーのIPアドレス</td><td><?php echo $_SERVER['REMOTE_ADDR'] ?></td></tr>
				<tr><td>$_SERVER['SERVER_ADDR']</td><td>WebサーバーのIPアドレス</td><td><?php echo $_SERVER['SERVER_ADDR'] ?></td></tr>
				<tr><td>$_SERVER['HTTP_X_FORWARDED_FOR']</td><td>アクセス元のIPアドレス</td><td><?php echo $_SERVER['HTTP_X_FORWARDED_FOR'] ?></td></tr>
				<tr><td>$_SERVER['HTTP_SP_HOST']</td><td></td><td><?php echo $_SERVER['HTTP_SP_HOST'] ?></td></tr>
				<tr><td>$_SERVER['HTTP_VIA']</td><td></td><td><?php echo $_SERVER['HTTP_VIA'] ?></td></tr>
				<tr><td>$_SERVER['HTTP_CLIENT_IP']</td><td></td><td><?php echo $_SERVER['HTTP_CLIENT_IP'] ?></td></tr>
				<tr><td>$_SERVER['HTTP_FORWARDED']</td><td></td><td><?php echo $_SERVER['HTTP_FORWARDED'] ?></td></tr>
				<tr><td>$_SERVER['HTTP_FROM']</td><td></td><td><?php echo $_SERVER['HTTP_FROM'] ?></td></tr>
				<tr><td></td></tr>
		
			</tbody>
		</table>
		<br><br><hr><br><br>
		
		<h4>$_SERVERの中身</h4>
		<input type="button" value="show" onclick="$('#tbl2').toggle()" class="btn btn-primary btn-xs" />
		<table id="tbl2" class="table" style="display:none">
			<thead>
				<tr><th>キー</th><th>取得値</th></tr>
			</thead>
			<tbody>
			<?php
				foreach($_SERVER as $key => $v){
					echo "<tr><td>{$key}</td><td>{$v}</td></tr>";
				}
			?>
			</tbody>
		</table>

	</div>
	


	<br><br>
	<a href="http://amaraimusi.sakura.ne.jp/" class="btn btn-link btn-xs">参考サイト</a>
	<br><br>

	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2016-01-05</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>