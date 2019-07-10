<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Guzzle3 | PHPからhttpリクエストを送る</title>

	<link href="/sample/style2/css/bootstrap.min.css" rel="stylesheet">
	<link href="/sample/style2/css/common2.css" rel="stylesheet">

	<script src="/sample/style2/js/jquery-1.11.1.min.js"></script>
	<script src="/sample/style2/js/bootstrap.min.js"></script>

</head>
<body>
<div id="header" ><h1>Guzzle3 | PHPからhttpリクエストを送る</h1></div>
<div class="container">







通常、httpリクエストはクライアント側のブラウザ画面を通して送受信する。<br>
しかし、Guzzleライブラリを使えば、サーバー側のPHPにてhttpリクエストの送受信ができる。<br>
<br>

クロスドメインはAjaxで行うのが主流であるが、Guzzleでクロスドメインを実現することが可能である。<br>
下記のサンプルは、別サーバーとクロスドメインでhttp通信するテストである。<br>
データを別サーバーに送り、jsonをレスポンスとして受け取る。
<br>






<p>出力</p>
<?php 
	require_once '../vendor/autoload.php';

	$data = ['id'=>1200,'delete_flg'=>false, 'animal_name'=>'lion'];
	$json = json_encode($data);
	
	$url = "http://amaraimusi.sakura.ne.jp/sample/php/guzzle3/cross_domain/test_serv_side.php";

	$client = new \Guzzle\Http\Client($url);
	$request = $client->post($url,null,array('key1' => $json));
	$res = $request->send();

	$json = $res->json();
	
	var_dump($json);
	
?>






<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">ＰＨＰ　｜　サンプル</a></li>
	<li>Guzzle3 | PHPからhttpリクエストを送る</li>
</ol>
</div><!-- container  -->
<div id="footer"  ><a href="/">(c)wacgance</a> 2016-7-8</div>
</body>
</html>