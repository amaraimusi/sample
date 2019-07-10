<?php



?>


<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>CSV出力・方法その3 | CsvDownloadクラス</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script>



		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">CSV出力・方法その3 | CsvDownloadクラス</h1>
		<div id="content" >



			<input type="button" value="テスト・CSV出力" onclick="location.href='make_csv.php'" />

			<hr />

<h3>サンプルコード</h3>

<strong>index.html</strong>
<pre>
	&lt input type="button" value="テスト・CSV出力" onclick="location.href='make_csv.php'" />
</pre>


<strong>make_csv.php</strong>
<pre>

require_once 'CsvDownloader.php';

$data=array(
		array('kani' => '1','yagi' => '日本語','buta' => '2012/12/12','tokage' => '1000',),
		array('kani' => '2','yagi' => 'bbb','buta' => '2012/12/13','tokage' => '1001',),
		array('kani' => '3','yagi' => 'ccc','buta' => '2012/12/14','tokage' => '1002',),
		array('kani' => '4','yagi' => 'ddd','buta' => '2012/12/15','tokage' => '1003',),
		array('kani' => '5','yagi' => 'eee','buta' => '2012/12/16','tokage' => '1004',),
		array('kani' => '6','yagi' => 'ffff','buta' => '2012/12/17','tokage' => '1005',),
);

$csv=new CsvDownloader();
$fn="dummy.csv";
$csv->output($fn, $data);

</pre>

<strong>CsvDownloader.php</strong><br />
<pre>
class CsvDownloader{

	/**
	 * マトリクスデータをCSVファイルに変換してダウンロード
	 * @param  $csv_file	CSVファイル名
	 * @param  $data	マトリクスデータ
	 */
	function output($csv_file,$data){


		$buf = "";

		if(!empty($data)){
			$i=0;
			foreach($data as $ent){
				foreach($ent as $v){
					$cell[$i][] = $v;
				}
				$buf .= mb_convert_encoding(implode(",",$cell[$i])."\r\n", "SJIS-win", "UTF-8");
				$i++;
			}

		}



		header ("Content-disposition: attachment; filename=" . $csv_file);
		header ("Content-type: application/octet-stream; name=" . $csv_file);
		print($buf);

	}

}
</pre>
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/5/12</div>
		</div><!-- page1 -->
	</body>
</html>