<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>1つのdatalistを複数のテキストボックスで使いまわす | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery.min.js"></script>	
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/vue.min.js"></script>

</head>
<body>
<div id="header" ><h1>1つのdatalistを複数のテキストボックスで使いまわす | ワクガンス</h1></div>
<div class="container">



一つのdatalistを複数のテキストボックスで使いまわすことが可能だ。<br>
ちなみにdatalistは数万件のデータにも対応できている。<br>
<br>

<pre><code>

&lt;datalist id="animal_dlist" &gt;
&lt;?php 
for($i=0; $i&lt;10000; $i++){
    echo "&lt;option value='動物テスト{$i}'&gt;";
}
   ?&gt;
&lt;/datalist&gt;

&lt;input list="animal_dlist" id="test1" &gt;
&lt;input list="animal_dlist" id="test2" &gt;
&lt;input list="animal_dlist" id="test3" &gt;
&lt;input list="animal_dlist" id="test4" &gt;
&lt;input list="animal_dlist" id="test5" &gt;
&lt;input list="animal_dlist" id="test6" &gt;
&lt;input list="animal_dlist" id="test7" &gt;
</code></pre>


<h2>Demo</h2>



<datalist id="animal_dlist" >
<?php 
for($i=0; $i<10000; $i++){
    echo "<option value='動物テスト{$i}'>";
}
   ?>
</datalist>

<input list="animal_dlist" id="test1" >
<input list="animal_dlist" id="test2" >
<input list="animal_dlist" id="test3" >
<input list="animal_dlist" id="test4" >
<input list="animal_dlist" id="test5" >
<input list="animal_dlist" id="test6" >
<input list="animal_dlist" id="test7" >



<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>1つのdatalistを複数のテキストボックスで使いまわす</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2021-11-12</div>
</body>
</html>