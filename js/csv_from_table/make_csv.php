<?php

require_once 'CsvDownloader.php';

session_start();
$data=$_SESSION['XX_DATA'];

if(isset($data)){
	$csv=new CsvDownloader();
	$fn="dummy.csv";
	$csv->output($fn, $data);
}



?>