<?php

require_once 'config/config.php';



//メンテログ出力
function log_adm($msg,$idStr){
	
	
	$m_adminLogPath=Config::getInstance()->m_logAddminPath;//Admin用ログフォルダパスを取得


	session_start();

	$ary[0]=date_format(date_create('now'), "Y/m/d H:i:s");//本日日付を取得する。
	$ary[1]=$_SESSION['user_name'];
	$ary[2]=$_SESSION['user_id'];
	$ary[3]=$_SESSION['group_id'];
	$ary[4]=$msg;
	$ary[5]=$idStr;
	$msg2=join(" ",$ary);
	
	
	$fn=$m_adminLogPath.'adm'.date(Ymd).'.log';

	error_log("$msg2\n", 3, $fn);

}


?>