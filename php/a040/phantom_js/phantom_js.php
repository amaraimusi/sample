<?php 

$json_param=$_POST['key1'];
$param=json_decode($json_param,true);//JSON文字を配列に戻す
$url1 = $param['url1'];

require_once 'vendor/autoload.php';
use JonnyW\PhantomJs\Client;
$client = Client::getInstance();

// Phantomjs.exeエンジンを設定
$client->getEngine()->setPath('vendor\bin\phantomjs.exe');

$request  = $client->getMessageFactory()->createRequest();
$response = $client->getMessageFactory()->createResponse();
$request->setTimeout(120 * 1000); // 最大2分待つ。2分を超えるとステータス408エラーが返る。

$request->setMethod('GET');
$request->setUrl($url1);
$client->send($request, $response);

if($response->getStatus() === 200) {
	echo $response->getContent();
}else{
	echo "request url: " . $request->getUrl() . "<br>";
	echo "response: " . $response->getStatus() . "<br>";
	echo 'ログ<br>';
	echo $client->getLog();
}

