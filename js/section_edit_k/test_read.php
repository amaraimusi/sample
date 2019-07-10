<?php

// AJAX送信元からJSONを受け取る
$json = $_POST['key1'];

// JSONをデコードし、データを取得する
$dataSet=json_decode($json,true);
$data = $dataSet['data'];




/** ～ $dataをDBから読み取る処理は省略。代わりにセッションから取得 ～ */

// セッションキーの作成とセッション開始
$id = $data['id'];
$ses_key = 'sese'.$id;
session_start();

// セッションに既存データが存在しない場合、データのプロパティにnullをセットする。(id以外）
if(empty($_SESSION[$ses_key])){
	foreach($data as $key=>$val){
		if($key != 'id'){
			$data[$key] = null;
		}
	}
}

// セッションに既存データが存在する場合、データに既存データをセットする。
else{
	$data = $_SESSION[$ses_key];

	// XSSサニタイズ
	foreach($data as $key => $val){
		$data[$key] = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
	}
	
}


// データをJSONにエンコードし、出力する。
$json=json_encode($data);
echo $json;


