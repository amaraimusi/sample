<?php

	$data[]=array('NEKO');
	$data[]=array('Neko');
	$data[]=array('ＮＥＫＯ');
	$data[]=array('ＮＥＫＯネコ');
	$data[]=array('ネコＮＥＫＯネコ');
	$data[]=array('１２３ＡＢＣ');



	foreach ($data as &$ent){
		//全角から半角に変換
		$han=mb_convert_kana($ent[0], "a", "UTF-8");

		//さらに小文字化
		$low=mb_strtolower($han,"UTF-8");

		$ent[]=$han;
		$ent[]=$low;
	}
	unset($ent);



?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>全角英数字を半角英数字に変換</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script>

		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">全角英数字を半角英数字に変換</h1>
		<div id="content" >


			<div class="sec1">
				似ている２つの文字列を比較し、一致率として数値化できるsimilar_text関数をテストしてみる。<br >
				ついでに小文字化もテスト。


				<hr />
				<table><thead><tr><th>元文字</th><th>半角化</th><th>小文字化</th></tr></thead>
				<tbody>
					<?php
						foreach($data as $ent){
							echo "<tr><td>{$ent[0]}</td><td>{$ent[1]}</td><td>{$ent[2]}</td></tr>";
						}
					?>
				</tbody>
				</table>

<hr />
<strong>ソース</strong><br />
<pre>
	foreach ($data as &$ent){
		//全角から半角に変換
		$han=mb_convert_kana($ent[0], "a", "UTF-8");

		//さらに小文字化
		$low=mb_strtolower($han,"UTF-8");

		$ent[]=$han;
		$ent[]=$low;
	}
	unset($ent);
</pre>
			</div><!-- sec1 -->

		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/05/19</div>
		</div><!-- page1 -->
	</body>
</html>