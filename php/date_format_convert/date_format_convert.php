<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>日付フォーマット変換</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script>



		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">日付フォーマット変換</h1>
		<div id="content" >

			<div class="sec1">
				<?php

					$d='2012/2/29';
					echo "変換前：".$d."<br>";
					$d2=date('Y-m-d',strtotime($d));
					echo "変換後：".$d2."<br>";
				?>


				<pre>
	$d='2012/2/29';
	echo "変換前：".$d."&ltbr>";
	$d2=date('Y-m-d',strtotime($d));
	echo "変換後：".$d2."&ltbr>";
				</pre>
			</div><!-- sec1 -->

			<div class="sec1">
				<?php

					$d='2012/2/29 12:13:14';
					echo "変換前：".$d."<br>";
					$d2=date('h:i:s',strtotime($d));
					echo "変換後：".$d2."<br>";
				?>


				<pre>
	$d='2012/2/29 12:13:14';
	echo "変換前：".$d."&ltbr>";
	$d2=date('h:i:s',strtotime($d));
	echo "変換後：".$d2."&ltbr>";
				</pre>
			</div><!-- sec1 -->

			<div class="sec1">
				<?php

					$d='xxxx';
					echo '$d='.$d."<br>";
					$x=strtotime($d);
					echo $x;

				?>


				<pre>
		$d='xxxx';
		echo '$d='.$d."&ltbr>";
		$x=strtotime($d);
		echo $x;

				</pre>
			</div><!-- sec1 -->


		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/10/16</div>
		</div><!-- page1 -->
	</body>
</html>