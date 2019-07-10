<?php
//echo "hello";
$p_str=$_POST['p_str'];

//$param=json_decode($json_param,true);//JSON文字を配列に戻す

$log=date('Y-m-d H:i:s').'    '.$_SERVER["REMOTE_ADDR"].'    '.$p_str.'    '.$_SERVER["REQUEST_URI"];
error_log("{$log}\n", 3, "login_simple.log");

if($p_str=='kanibuta' || $p_str=='fatcat'){
	echo "success";
}else{
	echo 'fail';
}