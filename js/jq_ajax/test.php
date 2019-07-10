<?php
require_once '../../zss_lib/common.php';

header("Access-Control-Allow-Origin:*");//クロスドメイン通信を許可する。

debug("test");
debugData($_POST);

$ret=$_REQUEST['key1'].'-'.$_REQUEST['key2'];

echo $ret;
?>