<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

if($_SERVER["REMOTE_ADDR"] != '126.219.137.211'){
	echo 'IPアドレス制限がかけられています。';
	die();
}

$fn = "test.jpg";
$fp = 'xxx/' . $fn;

// 一時ファイルをコピー
move_uploaded_file($_FILES["fu_file1"]["tmp_name"], $fp);

$res = ['fp'=> $fp];
$json_str = json_encode($res, JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);
echo $json_str;