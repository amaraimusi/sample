<?php
//header("Access-Control-Allow-Origin:*");//クロスドメイン通信を許可する。
sleep(1);//1秒間スリープ
$ids=$_POST['ary'];
$ret=join("/",$ids);
echo $ret;