<pre>
require_once 'array_column.php';//use the array_column function be less than PHP5.5 of environment.

$dd=array(array(1,'nezumi','a'),array(2,'usi','b'),array(3,'tora','c'));
$ary=array_column($dd, 1);
echo var_dump($ary);

</pre>
<hr>

<?php
require_once 'array_column.php';//PHP5.5未満の環境でもarray_column関数を使えるようにする。

$dd=array(array(1,'nezumi','a'),array(2,'usi','b'),array(3,'tora','c'));
$ary=array_column($dd, 1);
echo var_dump($ary);


?>;


