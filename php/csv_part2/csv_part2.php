<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>CSV出力・方法その2</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script>



		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">CSV出力・方法その2</h1>
		<div id="content" >



			<input type="button" value="CSV出力" onclick="location.href='make_csv.php'" />

			<hr />

			<strong>サンプルコード</strong><br />
			<pre>

	$csv_file='test.csv';
	$buf = "";
	$cell = array();
	$cell[0][] = 'AAA';
	$cell[0][] = 'BBB';
	$cell[0][] = 'CCC';
	$cell[0][] = 'DDD';
	$cell[0][] = 'EEE';
	$buf .= mb_convert_encoding(implode(",",$cell[0])."\r\n", "SJIS-win", "UTF-8");


	for($i=1;$i<20;$i++){
		$cell[$i][] = $i;
		$cell[$i][] = $i * 2;
		$cell[$i][] = $i * 3;
		$cell[$i][] = $i * 4;
		$cell[$i][] = 'テスト';
		$buf .= mb_convert_encoding(implode(",",$cell[$i])."\r\n", "SJIS-win", "UTF-8");
		$i++;
	}


	header ("Content-disposition: attachment; filename=" . $csv_file);
	header ("Content-type: application/octet-stream; name=" . $csv_file);
	print($buf);
			</pre>
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/4/25</div>
		</div><!-- page1 -->
	</body>
</html>