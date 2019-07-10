<?php
require_once 'zss_lib/ADebug.php';
require_once 'zss_lib/sanitaize_ex.php';
require_once 'zss_lib/DaoForSqlite.php';


a_debug('update start');//■■■□□□■■■□□□■■■□□□


//POSTで送られてきたデータを取得
$data=null;
if(isset($_POST['data'])){
	$data=$_POST['data'];
}
if(empty($data)){
	echo 'NO DATA';
	return;
}


//サニタイズする。
$snz=new SanitaizeEx();
$data=$snz->sanitaizeBeforeRegDb($data);

a_debugData($data);//■■■□□□■■■□□□■■■□□□

$dao=new DaoForSqlite();
$dao->m_dsn='sqlite:crud_ajax.sqlite';

$whiteList=array('id','test_name','test_num','test_dbl','test_date');

//★UPDATEする。
$rs=$dao->updDataWhiteList($data,'tests',$whiteList);

a_debug('$rs='.$rs);//■■■□□□■■■□□□■■■□□□

// $newId=$dao->getNewId('tests')-1;

// $rtn['rs']='success';
// $rtn['new_id']=$newId;

// $json=json_encode($rtn);

echo 'success';