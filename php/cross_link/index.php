<?php

	require_once 'controll/CrossLinkControll.php';

	$con=new CrossLinkControll();

	$con->action();
	$m_data=$con->m_data;


	//---PDOでのアクセスStart
	//$dsn = 'sqlite:mondo_quest3.db';
	require_once '../../../zss_lib/ADebug.php';
// 	$dsn = 'sqlite:cross_link.sqlite';

// 	$pdo = new PDO($dsn);
// 	$sql="select * from cross_links";
// 	$entries = $pdo->query($sql);


// 	foreach ($entries as $row) {
// 		echo $row['id'] . "<br />";
// 		echo $row['title'] . "<br />";
// 	}
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>相互リンクシステムのサンプル</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script>

			function del(id){
				var url="cross_link.php?del=1&id="+id;
				location.href=url;

			}

		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">相互リンクシステムのサンプル</h1>
			<div id="content" >
				<table border="1" >
					<thead><tr><th>ID</th><th>タイトル</th><th>説明</th><th>重要</th><th>削除</th></tr></thead>
					<tbody>

					<?php
						foreach($m_data as $i=>$ent){
							echo "<tr>";
							echo "<td>{$ent['id']}</td>";
							echo "<td><a href='{$ent['url']}'>{$ent['title']}<a></td>";
							echo "<td>{$ent['note']}</td>";
							echo "<td>{$ent['omomi']}</td>";
							echo "<td><input type='button' value='削除' onclick='del({$ent['id']})' /></td>";
							echo "</tr>";
						}
					?>
					</tbody>

				</table>

				<hr />




			<form name="form1"  action="#" method="post" enctype="multipart/form-data" >


				<div class="sec1">
					<label>URL:</label><input type="text" name="url" value="" /><br />
					<label>タイトル</label><input type="text" name="title" value="" /><br />
					<label>説明</label><textarea name="note"></textarea><br /><br />
					<label>重要性</label>
					<input type="radio" name="omomi" value="1" checked />
					<input type="radio" name="omomi" value="2" /><br />
					<input type="submit" name="btn1" value="追加" /><br />
				</div><!-- sec1 -->
			</form>
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/09/03</div>
		</div><!-- page1 -->
	</body>
</html>