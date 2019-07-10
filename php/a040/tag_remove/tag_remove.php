<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>タグ除去 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
</head>
<body>
<div id="header" ><h1>タグ除去 | ワクガンス</h1></div>
<div class="container">




<h2>デモ</h2>
<pre>
&lt;?php 
	$test_str = "
		&lt;div class=&yen;"yohaku&yen;"&gt;&lt;/div&gt;
		
		&lt;ol class=&yen;"breadcrumb&yen;"&gt;
			&lt;li&gt;&lt;a href=&yen;"/&yen;"&gt;ホーム&lt;/a&gt;&lt;/li&gt;
			&lt;li&gt;&lt;a href=&yen;"/sample&yen;"&gt;サンプルソースコード&lt;/a&gt;&lt;/li&gt;
			&lt;li&gt;&lt;a href=&yen;"/sample/php&yen;"&gt;PHP ｜ サンプル&lt;/a&gt;&lt;/li&gt;
			&lt;li&gt;タグ除去&lt;/li&gt;
		&lt;/ol&gt;
		&lt;p&gt;TEST&lt;/p&gt;
	";
	
	echo '&lt;pre&gt;';
	$test_str = strip_tags($test_str,'&lt;a&gt;&lt;p&gt;');
	echo $test_str;
	echo '&lt;/pre&gt;';
?&gt;
</pre>
<?php 
	$test_str = "
		<div class=\"yohaku\"></div>
		
		<ol class=\"breadcrumb\">
			<li><a href=\"/\">ホーム</a></li>
			<li><a href=\"/sample\">サンプルソースコード</a></li>
			<li><a href=\"/sample/php\">PHP ｜ サンプル</a></li>
			<li>タグ除去</li>
		</ol>
		<p>TEST</p>
	";
	
	echo '<p>出力</p><pre>';
	$test_str = strip_tags($test_str,'<a><p>'); // AタグとPタグだけ除外
	echo $test_str;
	echo '</pre>';
?>




<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>タグ除去</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-11-27</div>
</body>
</html>