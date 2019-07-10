<?php
require_once 'zss_lib/ADebug.php';
require_once 'zss_lib/sanitaize_ex.php';
require_once 'zss_lib/DaoForSqlite.php';


$snz=new SanitaizeEx();

$ent=null;
foreach($_POST as $key=>$val){
	$ent[$key]=$val;
}

$ent=$snz->sanitaizeBeforeRegDb($ent);
a_debugData($ent);


$dao=new DaoForSqlite();
$dao->m_dsn='sqlite:crud_ajax.sqlite';


//★INSERTする。
$dao->insData($ent,'tests');

$newId=$dao->getNewId('tests')-1;

$rtn['rs']='success';
$rtn['new_id']=$newId;

$json=json_encode($rtn);

echo $json;
