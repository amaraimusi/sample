<?php


require_once 'ZipSubdiv.php';




$json_str = $_POST['key1'];
$dataset = json_decode($json_str,true);//JSON文字を配列に戻す

$zipSubdiv = new ZipSubdiv();
$dataset = $zipSubdiv->iteratorCmpr($dataset);


$json_str = json_encode($dataset);//JSONに変換

echo $json_str;