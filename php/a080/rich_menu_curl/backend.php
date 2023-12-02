<?php 

// 通信元から送信されてきたパラメータを取得する。
$params_json = $_POST['key1'];
$params=json_decode($params_json,true);//JSON文字を配列に戻す

$mode = $params['mode'];

require_once 'RichMenuCurl.php';
$richMenuCurl = new RichMenuCurl();

// template_to_line
// img_to_line
// default_to_line

if($mode == 'template_to_line'){
	$line_rich_menu_id = $richMenuCurl->curlTemplateToLine($params);
	$params['line_rich_menu_id'] = $line_rich_menu_id;
}else if($mode == 'img_to_line'){
	$params['img_path'] =   __DIR__ . '/img/' . $params['rich_menu_img'];
	//$params['img_path'] =   $params['rich_menu_img'];
	$params['res'] = $richMenuCurl->curlImgToLine($params);
}else if($mode == 'default_to_line'){
	$params['res'] = $richMenuCurl->curlDefaultToLine($params);
}

// JSONに変換し、通信元に返す。
$json_str = json_encode($params, JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);
echo $json_str;