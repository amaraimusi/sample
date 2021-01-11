<?php 

require_once 'MakeIcon.php';

// 通信元から送信されてきたパラメータを取得する。
$param_json = $_POST['key1'];
$param=json_decode($param_json,true);//JSON文字を配列に戻す

// アイコン作成
$makeIcon = new MakeIcon();
$param = $makeIcon->make($param);


// JSONに変換し、通信元に返す。
$json_str = json_encode($param, JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);
echo $json_str;


function debug($value){
    echo '<pre>';
    var_dump($value);
    echo "</pre>";
}