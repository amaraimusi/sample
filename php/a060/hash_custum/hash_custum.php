<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>hash_custum | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/vue.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/ImgCompactK.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>hash_custum | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<pre><code>
&lt;?php 
require_once 'HashCustom.php';

$data = [
	['id'=&gt;'1', 'code'=&gt;'neko', 'name'=&gt;'猫', ],
	['id'=&gt;'2', 'code'=&gt;'yagi', 'name'=&gt;'山羊', ],
	['id'=&gt;'3', 'code'=&gt;'same', 'name'=&gt;'鮫', ],
	['id'=&gt;'4', 'code'=&gt;'wasi', 'name'=&gt;'鷲', ],
	['id'=&gt;'5', 'code'=&gt;'goki', 'name'=&gt;'御器', ],
];
// 変換前
//var_dump($data);

// データからIDリストを抽出する。
$list=HashCustom::extract($data, '{n}.id');
var_dump($list);

echo '--------------';

// データのキーをインデックスからcodeに変換
$data2 =HashCustom::combine($data, '{n}.code','{n}');
var_dump($data2);

?&gt;
</code></pre>

<p>出力</p>
<pre><code>
<?php 
require_once 'HashCustom.php';

$data = [
	['id'=>'1', 'code'=>'neko', 'name'=>'猫', ],
	['id'=>'2', 'code'=>'yagi', 'name'=>'山羊', ],
	['id'=>'3', 'code'=>'same', 'name'=>'鮫', ],
	['id'=>'4', 'code'=>'wasi', 'name'=>'鷲', ],
	['id'=>'5', 'code'=>'goki', 'name'=>'御器', ],
];
// 変換前
//var_dump($data);

// データからIDリストを抽出する。
$list=HashCustom::extract($data, '{n}.id');
var_dump($list);

echo '--------------';

// データのキーをインデックスからcodeに変換
$data2 =HashCustom::combine($data, '{n}.code','{n}');
var_dump($data2);

?>
</code></pre>

<a href="HashCustom.php" download>DL</a>

<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>hash_custum</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2020-3-26</div>
</body>
</html>