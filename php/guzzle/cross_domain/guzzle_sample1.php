<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Guzzle | PHPからhttpリクエストを送る</title>

	<link href="/sample/style2/css/bootstrap.min.css" rel="stylesheet">
	<link href="/sample/style2/css/common2.css" rel="stylesheet">

	<script src="/sample/style2/js/jquery-1.11.1.min.js"></script>
	<script src="/sample/style2/js/bootstrap.min.js"></script>

</head>
<body>
<div id="header" ><h1>Guzzle | PHPからhttpリクエストを送る</h1></div>
<div class="container">







通常、httpリクエストはクライアント側のブラウザ画面を通して送受信する。<br>
しかし、Guzzleライブラリを使えば、サーバー側のPHPにてhttpリクエストの送受信ができる。<br>
<br>

クロスドメインはAjaxで行うのが主流であるが、Guzzleでクロスドメインを実現することが可能である。<br>
下記のサンプルは、別サーバーとクロスドメインでhttp通信するテストである。<br>
<br>

<h2>サンプル</h2>
<pre>
&lt;?php 
	require_once 'vendor/autoload.php';

	$url = "http://example.com/server_side.php";

	$data = ['id'=&gt;888,'name'=&gt;'dog'];
	$json = json_encode($data);
	
	$client = new GuzzleHttp\Client();
	
	$res = $client-&gt;<strong>request</strong>('POST', $url,['form_params'=&gt;['key1'=&gt;$json]]);
	
	echo $res-&gt;getStatusCode();
	echo '&lt;br&gt;';
	
	$body = $res-&gt;getBody();
	$contents = $body-&gt;getContents();
	var_dump($contents);
?&gt;
</pre>
<br>

<p>server_side.php</p>
<pre>
&lt;?php 
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: POST');
	
	
	$data = ['id'=&gt;1,'name'=&gt;'cat','status'=&gt;2];

	if(!empty($_POST['key1'])){
		$json=$_POST['key1'];
		$data2=json_decode($json,true);//JSONデコード
		$data = array_merge($data, $data2);
	}
	
	$json = json_encode($data);//JSONエンコード
	
	echo $json;

?&gt;
</pre>
<br>

<p>出力</p>
<?php 
	require_once '../vendor/autoload.php';

	//$url = "http://sendgrid.churakami-okinawa.jp/cross_domain_b/smp_simple/server_side.php";
	$url = "http://localhost/sample/php/guzzle/cross_domain/test_serv_side.php";

	$data = ['id'=>888,'name'=>'dog'];
	$json = json_encode($data);
	
	$client = new GuzzleHttp\Client();
	
	$res = $client->request('POST', $url,['form_params'=>['key1'=>$json]]);
	
	echo $res->getStatusCode();
	echo '<br>';
	
	$body = $res->getBody();
	$contents = $body->getContents();
	var_dump($contents);
?>






<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">ＰＨＰ　｜　サンプル</a></li>
	<li>Guzzle | PHPからhttpリクエストを送る</li>
</ol>
</div><!-- container  -->
<div id="footer"  ><a href="/">(c)wacgance</a> 2016-7-5</div>
</body>
</html>