<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>file_get_contentsによるクロスドメイン:GET</title>

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
<div id="header" ><h1>file_get_contentsによるクロスドメイン:GET</h1></div>
<div class="container">



<p>ソースコード</p>
<pre><code>
&lt;?php
$opts = array(
	'http'=&gt;array(
		'method'=&gt;"GET",
		'header'=&gt;"Accept-language: en&yen;r&yen;n" .
		"Cookie: foo=bar&yen;r&yen;n"
  )
);

echo file_get_contents('http://www.example.com', false, stream_context_create($opts));
?&gt;

</code></pre>
<br>

<p>file_get_contents関数で取得したコンテンツ</p>
<?php
$opts = array(
	'http'=>array(
		'method'=>"GET",
		'header'=>"Accept-language: en\r\n" .
		"Cookie: foo=bar\r\n"
  )
);

echo file_get_contents('http://www.example.com', false, stream_context_create($opts));
?>





<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">ＰＨＰ　｜　サンプル</a></li>
	<li><a href="/sample/php/file_get_contents/">file_get_contentsによるクロスドメイン</a></li>
</ol>
</div><!-- container  -->
<div id="footer"  ><a href="/">(c)wacgance</a> 2016-7-20</div>
</body>
</html>