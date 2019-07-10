<?php

// 通信元から送信されてきたパラメータを取得する。
$param_json = $_POST['key1'];
$param=json_decode($param_json,true);//JSON文字を配列に戻す

$email = $param['email'];
// example.123@example.net
$registered = false;
if($email != 'example.123@example.net'){
	$registered = true;
}

//データ加工や取得
$res = array('registered' => $registered);

// JSONに変換し、通信元に返す。
$json_str = json_encode($res,JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);
echo $json_str;