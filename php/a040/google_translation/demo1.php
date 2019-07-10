<?php
/**
 * Ajax | 非同期通信
 * @return string
 */

if($_SERVER['SERVER_NAME'] != 'localhost' && date('U') > strtotime('2019-2-1')){
	echo '2019月2月1日にて公開停止';
	return;
}


$json_param = $_POST['key1'];
$param = json_decode($json_param,true);//JSON文字を配列に戻す


require_once 'vendor/vendor/autoload.php';
use Google\Cloud\Translate\TranslateClient;


//Google APIの「プロジェクトID」
$projectId = 'api-project-577997945594';

//「Google Cloud Translation API」の「APIキー」
$apiKey = 'AIzaSyBFdIWjLXlyGV8aDzTkg28BU_SbjjhbB6k';

//「TranslateClient」クラスを呼び出し
$translate = new TranslateClient([
		'projectId' => $projectId,
		'key' => $apiKey,
]);

$lang = $param['lang']; // 言語コードを指定

//翻訳開始
$result = $translate->translate($param['text1'], [
		'target' => $lang,
]);
$json = json_encode($result,JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);
echo $json;

//var_dump($result);//■■■□□□■■■□□□■■■□□□)
// //データ加工や取得
// $data=array('neko'=>'猫','yagi'=>'山羊','kani'=>'蟹','same'=>'鮫');

// //サニタイズ（XSS対策）
// $data=Sanitize::clean($data, array('encode' => true));

// $json_data=json_encode($data);//JSONに変換
	