<?php

require_once 'CsvIo2.php';

//header("Access-Control-Allow-Origin:*");//クロスドメイン通信を許可する。




$tmpFn=$_FILES["upload_file"]["tmp_name"];

//一時的にアップロードしたファイル名が空でないかチェック。（キャンセルを押された時など）
if(empty($tmpFn)){
	echo 'no_data';
}


//CSVファイルからデータを取り出し、さらにアクセスデータを抽出
$data=null;
try {
	//CSVファイルからデータを取り出す。
	$cio=new CsvIo2();
	$data=$cio->load($_FILES["upload_file"]["tmp_name"]);

	unlink($_FILES["upload_file"]["tmp_name"]);//一時ファイルを削除


	echo var_dump($data);

} catch (Exception $e) {
	unlink($_FILES["upload_file"]["tmp_name"]);//一時ファイルを削除
	echo 'no_data';
}


?>