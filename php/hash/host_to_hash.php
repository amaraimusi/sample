<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">

		<title>ホスト（ドメイン）からハッシュを作成する</title>

	</head>

<body>

<h1 >ホスト（ドメイン）からハッシュを作成する</h1>

<p>ソースコード</p>
<pre>
	$url=$_SERVER['HTTP_REFERER'];//遷移元URLを取得
	$url_host=parse_url($url,PHP_URL_HOST);//ホストを抜き出す。
	$hash = hash('sha256',MD5($url_host));
	
	echo 'URL = '.$url.'&lt;br&gt;';
	echo 'HOST = '.$url_host.'&lt;br&gt;';
	echo 'HASH = '.$hash.'&lt;br&gt;';
</pre>
<hr>
<?php 

	$url=$_SERVER['HTTP_REFERER'];//遷移元URLを取得
	$url_host=parse_url($url,PHP_URL_HOST);//ホストを抜き出す。
	$hash = hash('sha256',MD5($url_host));
	
	echo 'URL = '.$url.'<br>';
	echo 'HOST = '.$url_host.'<br>';
	echo 'HASH = '.$hash.'<br>';
?>





<p style="font-size:0.8em;color:#bc99fd">(c)wacgance 2015-06-12</p>
</body>
</html>