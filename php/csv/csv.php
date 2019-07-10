<?php
	require_once '../../../zss_lib/common.php';
	require_once '../../../zss_lib/csv_io.php';
	require_once '../../../zss_lib/html_create_table.php';

	$m_msg='';
	$m_tblHtml='';

	//CSV読込みボタンが押された時の処理。
	if(!empty($_POST['submit_load'])){
		$csvFn=$_POST['load_csv_fn'];
		$cio=new CsvIo();
		$data=$cio->load($csvFn);

		$hct=new HtmlCreateTable();
		$m_tblHtml=$hct->createHtml3($data,"border='1'");

		debugData($data);
		$m_msg="リソースからCSVを読み込みました。";
	}






	//▽CSV保存ボタンが押された時の処理。
	if(!empty($_POST['submit_save'])){
		$csvFn=$_POST['save_csv_fn'];
		$cio=new CsvIo();

		// CSVに書き出すデータ
		$data[] = array("neko","yagi");
		$data[] = array("月曜日","Monday");
		$data[] = array("火曜日", "Tuesday");
		$data[] = array("水曜日", "Wednesday");
		$data[] = array("木曜日", "Thursday");
		$data[] = array("金曜日", "Friday");
		$data[] = array("土曜日", "Saturday");
		$data[] = array("日曜日", "Sunday");

		$data=$cio->save($csvFn,$data);


		$m_msg="リソースへCSV保存しました。（{$csvFn}）";
	}

?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>CSV入出力・セーブロード</title>
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
		<div id="header">CSV入出力・セーブロード</div>
		<div id="content" >
			<form action="csv.php" method="post">
				<div class="sec1">

					take3<br>

					<?php echo($m_msg);?><br />

					<!-- CSV読込関連 -->
					<input type="text" name="load_csv_fn" value="doc/csv_sample/data_comma.csv" />
					<input name="submit_load" type="submit" value="CSV読込" /><br>

					<!-- CSV保存関連 -->
					<input type="text" name="save_csv_fn" value="doc/csv_sample/save.csv" />
					<input name="submit_save" type="submit" value="CSV保存" /><br>

					<?php echo($m_tblHtml);?>

				</div><!-- sec1 -->
			</form>
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/03/20</div>
		</div><!-- page1 -->
	</body>
</html>