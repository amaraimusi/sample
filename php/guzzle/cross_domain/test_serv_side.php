<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');


$data = ['id'=>1,'name'=>'cat','status'=>2];

if(!empty($_POST['key1'])){
	$json=$_POST['key1'];
	$data2=json_decode($json,true);//JSONデコード
	$data = array_merge($data, $data2);
}

$json = json_encode($data);//JSONエンコード

echo $json;

?>