<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>CSVファイルを非同期で読込む | 拡張版</title>

		<link href="../../style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../style2/css/common2.css" rel="stylesheet">

		<script src="../../style2/js/jquery-1.11.1.min.js"></script>
		<script src="../../style2/js/bootstrap.min.js"></script>
		<script src="jquery.upload-1.0.2.min.js"></script>

		<script>

		//ファイルアップロードされたときのイベント。
	    $(function() {
	        $('#medaka').change(function() {

	        	//ファイル名
	        	var fn="test.php";


		     	//☆非同期通信で画像ファイルをアップロードする。
	            $(this).upload(fn, function(res) {
					//▽以下はファイルアップロードに成功したときの処理。

					$("#res").html(res);

	            }, 'html');
	        });
	    });

		</script>
	</head>

<body>
<div class="container">

	<div class="row">
		<div id="header" class="col-lg-12" >
			<h1>CSVファイルを非同期で読込む | 拡張版</h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">
		通常のCSV読込みを拡張した。以下の機能を追加。<br>
		<ul>
		<li>入力チェックを強化</li>
		<li>列名から指定CSVファイルであることを判定する機能を追加。</li>
		<li>指定した列だけデータ取得する機能を追加。</li>
		</ul>

		<h2>サンプル</h2>
		<input type="file" name="upload_file" id="medaka"><br />
		<hr>

		<h3>結果</h3>
		<div id="res" style="color:red"></div>


	</div>





	<hr>



	<h2>ソースコード</h2>


	<div class="sec1">
		<input type="button" onclick="$('#html_source').toggle()"; value="HTMLソースコード" class="btn btn-info" value="info" />
		<pre id="html_source" style="display:none">
&lt!DOCTYPE html&gt
&lthtml lang="ja"&gt

	&lthead&gt
		&ltmeta charset="utf-8"&gt
		&lttitle&gtサンプル&lt/title&gt


		&ltscript src="jquery-1.11.1.min.js"&gt&lt/script&gt
		&ltscript src="jquery.upload-1.0.2.min.js"&gt&lt/script&gt

		&ltscript&gt

		//ファイルアップロードされたときのイベント。
	    $(function() {
	        $('#medaka').change(function() {

	        	//ファイル名
	        	var fn="test.php";


		     	//☆非同期通信で画像ファイルをアップロードする。
	            $(this).upload(fn, function(res) {
					//▽以下はファイルアップロードに成功したときの処理。

					$("#res").html(res);

	            }, 'html');
	        });
	    });

		&lt/script&gt
	&lt/head&gt

	&ltbody&gt

		&lth2&gtサンプル&lt/h2&gt
		&ltinput type="file" name="upload_file" id="medaka"&gt&ltbr /&gt
		&lthr&gt

		&lth3&gt結果&lt/h3&gt
		&ltdiv id="res" style="color:red"&gt&lt/div&gt

	&lt/body&gt
&lt/html&gt
		</pre>
	</div>












	<div class="sec1">
		<input type="button" onclick="$('#test_php_source').toggle()"; value="test.php" class="btn btn-info" value="info" />
		<pre id="test_php_source" style="display:none">


&lt?php

require_once 'CsvIo2.php';

$start_tm=microtime();//時間測定用


$tmpFn=$_FILES["upload_file"]["tmp_name"];

//一時的にアップロードしたファイル名が空でないかチェック。（キャンセルを押された時など）
if(empty($tmpFn)){
	echo 'no_data';
}


//CSVファイルからデータを取り出し、さらにアクセスデータを抽出
$data=null;
try {

	$cio=new CsvIo2();


	//指定CSVであるか識別する
	$idents=array(array("テストIDダミー","テストID別名","テストID"),"注文日","売上");

	//抽出列を指定する。
	$targets=array(array("テストIDダミー","テストID"),"フラグA");

	//★CSV読込
	$results=$cio-&gtload3($_FILES["upload_file"],$idents,$targets);

	$res=$results['res'];
	$err_msg=$results['err_msg'];
	$data=$results['data'];

	@unlink($_FILES["upload_file"]["tmp_name"]);//一時ファイルを削除



} catch (Exception $e) {
	@unlink($_FILES["upload_file"]["tmp_name"]);//一時ファイルを削除
	echo 'no_data';
}


$res_tm=microtime()-$start_tm;//時間測定用
echo "&ltdiv&gt{$res_tm}ms&lt/div&gt";

echo "res=".$res."&ltbr&gt";
echo "err_msg=".$err_msg."&ltbr&gt";

echo var_dump($data);
?&gt
		</pre>
	</div>



	<div class="sec1">
		<input type="button" onclick="$('#sample_csv').toggle()"; value="sample.csv" class="btn btn-info" value="info" />

		<table id="sample_csv" border="1" style="display:none"><thead>
			<tr>
				<th>テストID</th>
				<th>注文日</th>
				<th>売上</th>
				<th>フラグA</th>
			</tr></thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>2012/12/12</td>
					<td>100</td>
					<td>100</td>
				</tr>
				<tr>
					<td>2</td>
					<td>2012/12/13</td>
					<td>11</td>
					<td>101</td>
				</tr>
				<tr>
					<td>3</td>
					<td>2012/12/14</td>
					<td>30</td>
					<td>102</td>
				</tr>
				<tr>
					<td>4</td>
					<td>2012/12/15</td>
					<td>50</td>
					<td>103</td>
				</tr>
				<tr>
					<td>5</td>
					<td>2012/12/16</td>
					<td>60</td>
					<td>104</td>
				</tr>
				<tr>
					<td>6</td>
					<td>2012/12/17</td>
					<td>120</td>
					<td>105</td>
				</tr>
			</tbody>
		</table>

	</div>



	<div class="sec1">
		<a href="csv_io2.zip" class="btn btn-primary">ダウンロード</a>

	</div>
























	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2015-04-16</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>