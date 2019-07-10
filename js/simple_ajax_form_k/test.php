<?php

require_once 'sanitaize_ex.php';

$json = $_POST['key1'];


$data=json_decode($json,true);//JSONデコード

// ～ $dataをDBに更新したりする処理は省略 ～

// サニタイズ
$snz = new SanitaizeEx();
$data = $snz->sanitaizeAfterReadingDb($data);
//$data=Sanitize::clean($data, array('encode' => true));

$json=json_encode($data);//JSONエンコード

echo $json;



// function html($string, $remove = false) {
// 	if ($remove) {
// 		$string = strip_tags($string);
// 	} else {
// 		$patterns = array("/\&/", "/%/", "/</", "/>/", '/"/', "/'/", "/\(/", "/\)/", "/\+/", "/-/");
// 		$replacements = array("&amp;", "&#37;", "&lt;", "&gt;", "&quot;", "&#39;", "&#40;", "&#41;", "&#43;", "&#45;");
// 		$string = preg_replace($patterns, $replacements, $string);
// 	}
// 	return $string;
// }