<?php
include '../../../composer/vendor/autoload.php';
$tcpdf = new TCPDF("Portrait");
$tcpdf->AddPage();
$tcpdf->SetFont("kozminproregular", "", 10);


$param = [];
$html = render('demo2_in.php', $param);

$tcpdf->writeHTML($html);
$tcpdf->Output("test.pdf");


function render($in_fn, $params){
	extract($params);
	ob_start();
	
	include $in_fn;
	$html = ob_get_contents();
	ob_end_clean();
	
	return $html;
}