<?php

require_once 'CsvDivRead.php'; // CSV分割読込クラス

$param_json = $_POST['key1'];
$param = json_decode($param_json, true);//JSON文字を配列に戻す

if($_SERVER['SERVER_NAME']=='localhost'){
	$csvDivRead = new CsvDivRead();
	$param = $csvDivRead->unzip($_FILES, $param); // ZIPの解凍
}


$json_str = json_encode($param, JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);
echo $json_str;
?>