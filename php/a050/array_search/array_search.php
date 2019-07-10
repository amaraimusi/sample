<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>配列内を値で検索し、キーを取得する | array_searchの検証 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>配列内を値で検索し、キーを取得する | array_searchの検証 | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<pre><code>
&lt;?php 
$list = [
		'yakusima' =&gt; 'ヤクシマタゴガエル',
		'tokyo' =&gt; 'トウキョウダルマガエル',
		'chousen' =&gt; 'チョウセンヤマアカガエル',
		'tusima' =&gt; 'ツシマアカガエル',
		'test1' =&gt; '\'',
		'test2' =&gt; '&amp;',
		'test3' =&gt; '"',
		'test4' =&gt; '$',
		'test5' =&gt; '\',
		'tonosama' =&gt; 'トノサマガエル',
		'ryokyu' =&gt; 'リュウキュウアカガエル',
	];

echo "&lt;pre class='console'&gt;";
$key = array_search('ツシマアカガエル', $list);
echo $key . '&lt;br&gt;';
$key = array_search('ニョロボン', $list);
echo $key . '&lt;br&gt;';
$key = array_search('\'', $list);
echo $key . '&lt;br&gt;';
$key = array_search('&amp;', $list);
echo $key . '&lt;br&gt;';
$key = array_search('"', $list);
echo $key . '&lt;br&gt;';
$key = array_search('$', $list);
echo $key . '&lt;br&gt;';
$key = array_search('\', $list);
echo $key . '&lt;br&gt;';
echo "&lt;/pre&gt;";
?&gt;
</code></pre>

<p>出力</p>
<?php 
$list = [
		'yakusima' => 'ヤクシマタゴガエル',
		'tokyo' => 'トウキョウダルマガエル',
		'chousen' => 'チョウセンヤマアカガエル',
		'tusima' => 'ツシマアカガエル',
		'test1' => '\'',
		'test2' => '&',
		'test3' => '"',
		'test4' => '$',
		'test5' => '\\',
		'tonosama' => 'トノサマガエル',
		'ryokyu' => 'リュウキュウアカガエル',
	];

echo "<pre class='console'>";
$key = array_search('ツシマアカガエル', $list);
echo $key . '<br>';
$key = array_search('ニョロボン', $list);
echo $key . '<br>';
$key = array_search('\'', $list);
echo $key . '<br>';
$key = array_search('&', $list);
echo $key . '<br>';
$key = array_search('"', $list);
echo $key . '<br>';
$key = array_search('$', $list);
echo $key . '<br>';
$key = array_search('\\', $list);
echo $key . '<br>';
echo "</pre>";
?>


<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>配列内を値で検索し、キーを取得する | array_searchの検証</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2019-4-9</div>
</body>
</html>