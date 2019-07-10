<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>file_get_contentsによるクロスドメイン:POST</title>

	<link href="/sample/style2/css/bootstrap.min.css" rel="stylesheet">
	<link href="/sample/style2/css/common2.css" rel="stylesheet">

	<script src="/sample/style2/js/jquery-1.11.1.min.js"></script>
	<script src="/sample/style2/js/bootstrap.min.js"></script>
	
	<!-- ソースコードをハイライト表示する -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.0.0/styles/default.min.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.0.0/highlight.min.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>file_get_contentsによるクロスドメイン:POST</h1></div>
<div class="container">




<p>ソースコード</p>
<pre><code>
&lt;?php

// POSTデータとクエリ化
$data = array(
    "animal_name" =&gt; "dog",
    "animal_value" =&gt; "101"
);
$data = http_build_query($data, "", "&amp;");

// HTTPヘッダー情報
$header = array(
    "Content-Type: application/x-www-form-urlencoded",
    "Content-Length: ".strlen($data)
);

// HTTPリクエストの設定
$option = array(
    "http" =&gt; array(
        "method"  =&gt; "POST",
        "header"  =&gt; implode("&yen;r&yen;n", $header),
        "content" =&gt; $data
    )
);

// クロスドメイン通信先
$url = "http://amaraimusi.sakura.ne.jp/sample/php/cross_domain/file_get_contents/test_serv_side.php";

// クロスドメイン通信
$res = <strong>file_get_contents</strong>($url, false, stream_context_create($option));

echo $res;
?&gt;
</code></pre>
<br>


<p>file_get_contentsで取得したコンテンツデータ</p>
<pre class="output_data">
<?php

// POSTデータとクエリ化
$data = array(
    "animal_name" => "dog",
    "animal_value" => "101"
);
$data = http_build_query($data, "", "&");

// HTTPヘッダー情報
$header = array(
    "Content-Type: application/x-www-form-urlencoded",
    "Content-Length: ".strlen($data)
);

// HTTPリクエストの設定
$option = array(
    "http" => array(
        "method"  => "POST",
        "header"  => implode("\r\n", $header),
        "content" => $data
    )
);

// クロスドメイン通信先
$url = "http://amaraimusi.sakura.ne.jp/sample/php/cross_domain/file_get_contents/test_serv_side.php";

// クロスドメイン通信
$res = file_get_contents($url, false, stream_context_create($option));

echo $res;
?>
</pre>






<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">ＰＨＰ　｜　サンプル</a></li>
	<li><a href="/sample/php/cross_domain/file_get_contents/">file_get_contentsによるクロスドメイン</a></li>
</ol>
</div><!-- container  -->
<div id="footer"  ><a href="/">(c)wacgance</a> 2016-7-20</div>
</body>
</html>