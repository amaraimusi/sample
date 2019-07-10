<?php

$url =$_POST['ary'][0];
$data = file_get_contents($url);
file_put_contents('img/temp.png',$data);
echo "success";