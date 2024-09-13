<?php 

use App\Services\Audience\LineAudienceCurl;

// 通信元から送信されてきたパラメータを取得する。
$params_json = $_POST['key1'];
$params=json_decode($params_json,true);//JSON文字を配列に戻す

$mode = $params['mode'];

require_once 'LineAudienceCurl.php';
$lineAudienceCurl = new LineAudienceCurl();

switch ($mode) {
	case 'audience_list':

		$res = $lineAudienceCurl->getAudienceList($params['access_token']);
		
		$params['list'] =$res['list'];
		$params['errs'] =$res['errs'];
		break;
		
	case 'audience_reg':
		//$res = $lineAudienceCurl->getAudienceReg($params);
		$res = $lineAudienceCurl->naroMsg();
		$params['res'] =$res['res'];
		$params['errs'] =$res['errs'];
		break;
		
	case 'audience_delete':
		$res = $lineAudienceCurl->curlDeleteToLine($params);
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
