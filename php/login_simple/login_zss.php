<?php
$err_msg="";
if(isset($_POST['pw'])){
	require_once 'LoginSimple.php';
	$lg=new LoginSimple();
	$err_msg=$lg->login();
}
?>



<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>ワクガンス | ログイン</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />


		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">ログイン</h1>
		<div id="content" >
			<form name="form1"  action="#" method="post"  >
				<div class="sec1">

					<div id="err" style="color:red"><?php echo $err_msg ?></div>
					<input type="password" name="pw" value="" />
					<input type="submit" value="ログイン" />
				</div><!-- sec1 -->
			</form>
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/08/13</div>
		</div><!-- page1 -->
	</body>
</html>