<?php 

//データ加工や取得
$res = ['success'=>1,'yagi'=>'山羊','kani'=>'蟹','same'=>'鮫'];

// JSONに変換し、通信元に返す。
$json_str = json_encode($res, JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);
echo $json_str;

