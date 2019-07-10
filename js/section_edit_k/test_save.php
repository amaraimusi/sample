<?php

// AJAX送信元からJSONを受け取る
$json = $_POST['key1'];

// JSONをデコードし、データを取得する
$dataSet=json_decode($json,true);//JSONデコード
$data = $dataSet['data'];


/** ～ $dataをDBに更新したりする処理は省略。代わりにセッションへ保存 ～ */
$id = $data['id'];
$ses_key = 'sese'.$id;
session_start();



// セッションへデータをセット
$_SESSION[$ses_key] = $data;


// XSSサニタイズ
foreach($data as $key => $val){
	$data[$key] = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
}

// データをJSONにエンコードし、出力する。
$json=json_encode($data);
echo $json;


