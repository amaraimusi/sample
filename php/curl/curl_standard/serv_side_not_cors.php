<?php 


$data = ['id'=>2,'animal_name'=>'japan wolf','delete_flg'=>true];

if(!empty($_POST['key1'])){
	$json=$_POST['key1'];
	$data2=json_decode($json,true);//JSONデコード
	$data = array_merge($data, $data2);
}

$json = json_encode($data);//JSONエンコード

echo $json;

?>