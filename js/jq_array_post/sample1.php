<?php


header("Access-Control-Allow-Origin:*");//クロスドメイン通信を許可する。

$ids=$_POST['ary'];
$ret=join("/",$ids);
echo $ret;
?>