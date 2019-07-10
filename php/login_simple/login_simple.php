<?php
require_once 'LoginSimple.php';
$lg=new LoginSimple();
$lg->check();//ログインチェック

if(isset($_GET['logout'])){
	$lg->logout();//ログアウト
}

?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>シンプルログイン</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />


		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">シンプルログイン</h1>
		<div id="content" >

			<div class="sec1">
				いろはにほへとちりぬのをわかよたれそつねならむ<br>
				<br>
				うゐのおくやま けふこえてあさきゆめみし ゑひもせす<br>
				<a href="login_simple.php?logout=1">ログアウト</a>
			</div><!-- sec1 -->

		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/08/13</div>
		</div><!-- page1 -->
	</body>
</html>