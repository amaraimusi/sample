<?php
$param['neko'] = 'cat';
$param['inu'] = 'dog';

echo render($param);


function render($params){
	extract($params);
	ob_start();

	include "template.php";
	$html = ob_get_contents();
	ob_end_clean();

	return $html;
}