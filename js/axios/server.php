<?php
$json_param=$_POST['key1'];
$param=json_decode($json_param,true);//JSON文字を配列に戻す
$data=array('neko'=>'猫','yagi'=>'山羊','kani'=>'蟹','same'=>'鮫');
$data = array_merge ($data,$param);
$json_str = json_encode($data);//JSONに変換
echo $json_str;