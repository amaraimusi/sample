<?php

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
	$results=$cio->load3($_FILES["upload_file"],$idents,$targets);

	$res=$results['res'];
	$err_msg=$results['err_msg'];
	$data=$results['data'];

	@unlink($_FILES["upload_file"]["tmp_name"]);//一時ファイルを削除



} catch (Exception $e) {
	@unlink($_FILES["upload_file"]["tmp_name"]);//一時ファイルを削除
	echo 'no_data';
}


$res_tm=microtime()-$start_tm;//時間測定用
echo "<div>{$res_tm}ms</div>";

echo "res=".$res."<br>";
echo "err_msg=".$err_msg."<br>";

echo var_dump($data);
?>