<?php

// 通信元から送信されてきたパラメータを取得する。
$ent_json = $_POST['key1'];
$data = json_decode($ent_json,true);//JSON文字を配列に戻す

$data['name'] ='猫と犬:' . date('i:s');

// JSONに変換し、通信元に返す。
$json_str = json_encode($data, JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);
echo $json_str;
