
<h1>SectionEditK.js |セッションクリア</h1>
<?php
session_start();

$ids=[99,100];
foreach($ids as $id){
	$ses_key = 'sek'.$id;
	$_SESSION[$ses_key] = null;
	echo "セッションキー クリア：{$ses_key}<br>";
}