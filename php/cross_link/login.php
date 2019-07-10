<?php
	require_once 'zss_lib/LoginCheckForSqlite.php';

	require_once 'zss_lib/sanitaize_ex.php';
	//require_once 'controll/LoginControll.php';

	if(!empty($_POST['btn1'])){

		$snz=new SanitaizeEx();
		$_POST=$snz->sanitaizeAfterReadingDb($_POST);
		$login=new LoginCheckForSqlite();


		$login->authX($_POST['user_name'],$_POST['password']);

	}


?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>ログイン</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script>



		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">ログイン</h1>
			<div id="content" >


			<form name="form1"  action="#" method="post" enctype="multipart/form-data" >


				<div class="sec1">
					<label>ユーザー:</label><input type="text" name="user_name" value="" /><br />
					<label>パスワード</label><input type="password" name="password" value="" /><br />

					<input type="submit" name="btn1" value="ログイン" /><br />
				</div><!-- sec1 -->
			</form>
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/09/03</div>
		</div><!-- page1 -->
	</body>
</html>