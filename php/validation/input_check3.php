<?php
require_once '../../../zss_lib/ADebug.php';
require_once '../../../zss_lib/CsvIo2.php';
require_once '../../../zss_lib/InputCheckA.php';
require_once '../../../zss_lib/html_create_table.php';


a_debug('input_check ver3.0のテスト');//■■■□□□■■■□□□■■■□□□

$cio=new CsvIo2();
$data=$cio->read('test.csv',true);

//エンティティ情報
$ei['int_a'] = array('name'=>'int_a','type'=>'int','jname'=>'ID','size'=>null,'def'=>0,'primaryKey'=>true,'req'=>true,'ic'=>true,'maxvalue'=>10,'minvalue'=>0,'inptype'=>'null');
$ei['string_a'] = array('name'=>'string_a','type'=>'string','jname'=>'文字列A','size'=>3,'def'=>'ネコ','primaryKey'=>null,'req'=>null,'ic'=>true,'maxvalue'=>null,'minvalue'=>null,'inptype'=>'text');
$ei['double_a'] = array('name'=>'double_a','type'=>'double','jname'=>'ダブルA','size'=>null,'def'=>99,'primaryKey'=>false,'req'=>true,'ic'=>true,'maxvalue'=>1000,'minvalue'=>10,'inptype'=>null);
$ei['date_a'] = array('name'=>'date_a','type'=>'date','jname'=>'日付A','size'=>null,'def'=>'false','primaryKey'=>false,'req'=>false,'ic'=>true,'maxvalue'=>null,'minvalue'=>null,'inptype'=>null);
$ei['time_a'] = array('name'=>'time_a','type'=>'time','jname'=>'時間A','size'=>null,'def'=>null,'primaryKey'=>false,'req'=>false,'ic'=>true,'maxvalue'=>null,'minvalue'=>null,'inptype'=>null);
$ei['datetime_a'] = array('name'=>'datetime_a','type'=>'datetime','jname'=>'時刻A','size'=>null,'def'=>null,'primaryKey'=>false,'req'=>false,'ic'=>true,'maxvalue'=>null,'minvalue'=>null,'inptype'=>null);

$ic=new InputCheckA();
$mErrHtml=$ic->checkData($data,$ei,$dataName=null);


//プレビュー用に、データテーブルHTMLを生成する。
$hct=new HtmlCreateTable();
$m_strHtml=$hct->createHtml_entKey($data,"border='1'");



?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<title>入力チェック3.0</title>
		<script>


		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">入力チェック3.0</h1>
		<div id="content" >

			<div style="color:red"><?php echo($mErrHtml);?></div>
			<br /><br />
			<div>
				<?php echo $m_strHtml;?>
			</div>


		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/04/21</div>
		</div><!-- page1 -->
	</body>
</html>