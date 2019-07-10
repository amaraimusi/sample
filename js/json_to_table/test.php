<?php


$data[0]['test1']=999;
$data[1]['test1']="test<br>";

$json=json_encode($data,true);

echo $json;