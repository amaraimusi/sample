<?php 
// 通信元から送信されてきたパラメータを取得する。
$param_json = $_POST['key1'];
$param=json_decode($param_json,true);//JSON文字を配列に戻す

$text1 = $param['text1'];
$text1 = trim($text1);

$sql = '';
if(empty($text1)){
	$sql = 'SELECT wamei FROM en_sps limit 10';
}else{
	$sql = "SELECT wamei FROM en_sps WHERE wamei LIKE '{$text1}%' limit 100";
}

require_once 'SaveData.php';
$saveData = new SaveData();

$data = $saveData->getData($sql);

// JSONに変換し、通信元に返す。
$json_str = json_encode($data,JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);
echo $json_str;