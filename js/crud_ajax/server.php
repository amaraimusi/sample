<?php
require_once 'zss_lib/ADebug.php';
//---PDOでのアクセスStart
//$dsn = 'sqlite:mondo_quest3.db';

a_debug('PDOでのアクセスStart');//■■■□□□■■■□□□■■■□□□

$dsn = 'sqlite:crud_ajax.sqlite';

$pdo = new PDO($dsn);
$sql="select * from tests";
$rtns = $pdo->query($sql);

$data=null;
foreach ($rtns as $i=>$row) {

	foreach($row as $k=> $val){

		if(!is_numeric($k)){
			$ent[$k]=$val;
		}

	}
	$data[]=$ent;

}

$str_json=json_encode($data);

echo $str_json;

// echo "<table border='1'>";
// foreach ($data as $i=>$row) {
// 	echo '<tr>';
// 	echo "<td>{$i}</td>";
// 	foreach($row as $k=> $val){
// 		echo "<td>{$k}=>{$val}</td>";
// 	}

// 	echo '</tr>';
// }
// echo '</table>';
?>