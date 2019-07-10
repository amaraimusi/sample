<?php

// 通信元から送信されてきたパラメータを取得する。
$param_json = $_POST['key1'];
$param=json_decode($param_json,true);//JSON文字を配列に戻す
$addr1 = $param['addr1'];

var_dump($addr1);

// Yahoo!ジオコーダAPIを利用して住所から緯度経度を取得する  (住所によっては緯度経度が取得できないケースもあり）
$app_id = 'dj00aiZpPU9vOWdUelJjRHhZbCZzPWNvbnN1bWVyc2VjcmV0Jng9MzY-'; // Yahoo APIキー
$url = "https://map.yahooapis.jp/geocode/V1/geoCoder?appid={$app_id}&query={$addr1}&results=1"; // XML系s機
$xml_str = file_get_contents ($url);
xss_escape($xml_str);

echo $xml_str;




/**
 * XSSエスケープ（XSSサニタイズ）
 *
 * @note
 * XSSサニタイズ
 * 記号「<>」を「&lt;&gt;」にエスケープする。
 * 高速化のため、引数は参照（ポインタ）にしており、返値もかねている。
 *
 * @param mixed $data 対象データ | 値および配列を指定
 * @return void
 */
function xss_escape(&$data){
	
	if(is_array($data)){
		foreach($data as &$val){
			xss_escape($val);
		}
		unset($val);
	}elseif(gettype($data)=='string'){
		$data = str_replace(array('<','>'),array('&lt;','&gt;'),$data);
	}else{
		// 何もしない
	}
}