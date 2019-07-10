<?php
require_once 'CsvDivRead.php'; // CSV分割読込クラス
require_once 'ADebug.php'; // CSV分割読込クラス

$param_json = $_POST['key1'];
$param = json_decode($param_json, true);//JSON文字を配列に戻す


$csvDivRead = new CsvDivRead();
$res = $csvDivRead->csvRead($param); // CSV読込
$data = $res['data'];
$param = $res['param'];

$json_str = json_encode($param, JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);

echo $json_str;