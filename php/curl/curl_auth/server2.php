<?php 
// クロスドメイン通信の許可（cURLの場合、許可しなくても通信できる）
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: POST');

// デフォルトデータ
$data = ['id'=>1400,'animal_name'=>'kame','age'=>20];

if(!empty($_POST['key1'])){
	
	// データにPOSTデータをマージします。
	$json=$_POST['key1'];
	$data2=json_decode($json,true);
	$data = array_merge($data, $data2);
	
	// 認証処理
	$secretKey="xxx123";// 秘密キー（便宜上、ソースコードに直接記述しているが、本来ならDBなどから取得すべき）
	$ip=$_SERVER['REMOTE_ADDR'];// 遷移元のIPアドレスを取得する
	$hash = hash('sha256',MD5($ip.$secretKey));// IPアドレスと秘密キーから認証キーを作成する。
	
	kenshoOutput($hash);// 検証出力 ■■■□□□■■■□□□■■■□□□テスト用
	
	if($hash != $data['hash']){// POSTの認証キーと、上記で作成した認証キーを比較判定する。
		echo "Fail Auth";//認証失敗
		die();
	}

}else{
	echo "NONE";
	die();
}

// データをレスポンス可してレスポンスします。
$json = json_encode($data);//JSONエンコード
echo $json;

// 検証出力
function kenshoOutput($hash){
	echo '認証キー:'.$hash.'<br>';
	echo 'IPアドレス【SERVER_ADDR】:'.$_SERVER['SERVER_ADDR'].'<br>';
	echo 'IPアドレス【REMOTE_ADDR】:'.$_SERVER['REMOTE_ADDR'].'<br>';
	echo 'リファラ:'.$_SERVER['HTTP_REFERER'].'<br>';
	echo 'ユーザーエージェント:'.$_SERVER['HTTP_USER_AGENT'].'<br>';
	//var_dump($_SERVER);
}
?>