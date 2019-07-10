<?php

require_once 'CsvDownloader.php';



$data=array(
		array('kani' => '1','yagi' => '日本語','buta' => '2012/12/12','tokage' => '1000',),
		array('kani' => '2','yagi' => 'bbb','buta' => '2012/12/13','tokage' => '1001',),
		array('kani' => '3','yagi' => 'ccc','buta' => '2012/12/14','tokage' => '1002',),
		array('kani' => '4','yagi' => 'ddd','buta' => '2012/12/15','tokage' => '1003',),
		array('kani' => '5','yagi' => 'eee','buta' => '2012/12/16','tokage' => '1004',),
		array('kani' => '6','yagi' => 'ffff','buta' => '2012/12/17','tokage' => '1005',),
);

$csv=new CsvDownloader();
$fn="dummy.csv";
$csv->output($fn, $data);




?>