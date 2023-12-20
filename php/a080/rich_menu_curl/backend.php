<?php 

use App\Services\RichMenu\RichMenuCurl;

// 通信元から送信されてきたパラメータを取得する。
$params_json = $_POST['key1'];
$params=json_decode($params_json,true);//JSON文字を配列に戻す

$mode = $params['mode'];

require_once 'RichMenuCurl.php';
$richMenuCurl = new RichMenuCurl();

switch ($mode) {
	case 'template_to_line':
		
		require_once 'Sample.php';
		$sample = new Sample();
		$richMenu = $sample->getSampleRichMenu();
		$areas = $sample->getSampleAreas1();
		$rich_menu_json  = $richMenuCurl->createRichMenuJson($richMenu, $areas);
		$res = $richMenuCurl->curlTemplateToLine($params['access_token'], $rich_menu_json);
		
		$params['line_rich_menu_id'] =$res['richMenuId'];
		$params['errs'] =$res['errs'];
		break;
		
	case 'img_to_line':
		$params['img_path'] = __DIR__ . '/img/' . $params['rich_menu_img'];
		 $res = $richMenuCurl->curlImgToLine($params);
		 $params = array_merge($params, $res);
		break;
		
	case 'default_to_line':
		$res = $richMenuCurl->curlDefaultToLine($params);
		$params = array_merge($params, $res);
		break;
		
	case 'list_from_line':
		$params['res'] = $richMenuCurl->curlListFromLine($params);
		break;
		
	case 'delete_to_line':
		$res = $richMenuCurl->curlDeleteToLine($params);
		$params = array_merge($params, $res);
		break;
}

// JSONに変換し、通信元に返す。
$json_str = json_encode($params, JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);
echo $json_str;

function dump($var){
	echo "<pre><code>";
	var_dump($var);
	echo "</code></pre>";
}
