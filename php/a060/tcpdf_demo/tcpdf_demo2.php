<?php
include '../../../composer/vendor/autoload.php';
$tcpdf = new TCPDF("Portrait");
$tcpdf->AddPage();
$tcpdf->SetFont("kozminproregular", "", 10);
$html = <<< EOF
<style>
	h1 {
		font-weight:bold;
		font-size: 24px;
		color:#FF8080;
	}

</style>
<h1>Hello World!</h1>
いろはにほへと<br>
大きなヤギと小さな犬<br>
EOF;

$tcpdf->writeHTML($html);
$tcpdf->Output("test.pdf");