<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>日付比較 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery.min.js"></script>	
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/vue.min.js"></script>
	<script src="script.js"></script>

</head>
<body>
<div id="header" ><h1>日付比較 | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<pre><code>
// 誤り
if('2022-11-3' &gt; '2022-11-10'){
    echo "2022-11-3が2022-11-10よりも大きい（最新）ということになってしまうので誤り&lt;br&gt;&lt;br&gt;";
}

// 正しい比較
if(strtotime('2022-11-3') &gt; strtotime('2022-11-10')){
   
}else{
    echo "'2022-11-10'が大きい（最新）&lt;br&gt;&lt;br&gt;";
}
</code></pre>

<p>出力</p>
<?php 

// 誤り
if('2022-11-3' > '2022-11-10'){
    echo "2022-11-3が2022-11-10よりも大きい（最新）ということになってしまうので誤り<br><br>";
}

// 正しい比較
if(strtotime('2022-11-3') > strtotime('2022-11-10')){
   
}else{
    echo "'2022-11-10'が大きい（最新）<br><br>";
}

?>

<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>日付比較</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2022-11-8</div>
</body>
</html>