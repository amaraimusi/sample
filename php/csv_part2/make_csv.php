<?php

$csv_file='test.csv';
$buf = "";
$cell = array();
$cell[0][] = 'AAA';
$cell[0][] = 'BBB';
$cell[0][] = 'CCC';
$cell[0][] = 'DDD';
$cell[0][] = 'EEE';
$buf .= mb_convert_encoding(implode(",",$cell[0])."\r\n", "SJIS-win", "UTF-8");


for($i=1;$i<20;$i++){
	$cell[$i][] = $i;
	$cell[$i][] = $i * 2;
	$cell[$i][] = $i * 3;
	$cell[$i][] = $i * 4;
	$cell[$i][] = 'テスト';
	$buf .= mb_convert_encoding(implode(",",$cell[$i])."\r\n", "SJIS-win", "UTF-8");
	$i++;
}


header ("Content-disposition: attachment; filename=" . $csv_file);
header ("Content-type: application/octet-stream; name=" . $csv_file);
print($buf);
?>