<?php 
// クロスドメイン通信の許可は不要
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: POST');

if(!empty($_POST)){
	echo 'POSTデータを受け取りました。<br>';
	foreach($_POST as $key => $val){
		echo $key.' = ' . $val . '<br>';
	}

}else{
	echo 'NONE';
}
?>