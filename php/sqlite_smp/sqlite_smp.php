

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>PHPでSQLite</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script>

			function test_func1(){
				var x=document.getElementById('xxx1').innerHTML;
				alert(x);
			}

		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">PHPでSQLite</h1>
		<div id="content" >
			<div class="sec1">

			<pre>
	$dsn = 'sqlite:test_a.sqlite';

	$pdo = new PDO($dsn);
	$sql="select * from test_as";
	$entries = $pdo->query($sql);


	foreach ($entries as $row) {
		echo $row['id'] . "&lt br />";
		echo $row['a_name'] . "&lt br />";
	}
			</pre>

				出力<br />
				<?php

					//---PDOでのアクセスStart
					//$dsn = 'sqlite:mondo_quest3.db';
					require_once '../../../zss_lib/ADebug.php';
					$dsn = 'sqlite:test_a.sqlite';

					$pdo = new PDO($dsn);
					$sql="select * from test_as";
					$entries = $pdo->query($sql);


					foreach ($entries as $row) {
						echo $row['id'] . "<br />";
						echo $row['a_name'] . "<br />";
					}
				?>



			</div>

		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/09/03</div>
		</div><!-- page1 -->
	</body>
</html>