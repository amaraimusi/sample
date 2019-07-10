<?php
require_once '../../zss_lib/common.php';

header("Access-Control-Allow-Origin:*");//クロスドメイン通信を許可する。

debug("ajax json test");
debugData($_POST);

$names=$_POST["names"];
$contry=$_POST["contry"];
$year=$_POST["year"];

for($i=0;$i<4;$i++){
	$ent["names"]=$names.$i;
	$ent["contry"]=$contry;
	$ent["year"]=$year;
	$data[$i]=$ent;;
	
}

$jdt=json_encode($data);
echo $jdt;
?>