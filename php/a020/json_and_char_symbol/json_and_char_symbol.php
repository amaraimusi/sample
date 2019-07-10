<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>文字記号のJSON変換を検証</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>

	<style>
	h4{
		margin-top:60px;
	}
	.pre1{
		background-color:#404040;
		color:white;
	}
	</style>
</head>
<body>
<div id="header" ><h1>文字記号のJSON変換を検証</h1></div>
<div class="container">












<h2>検証する記号</h2>
<pre class="pre1"><code>$data = array(1=>'<',2=>'>',3=>'"',4=>"'",5=>'&',6=>'/',7=>"\\");
var_dump($data);
</code></pre>
<?php 
	$data = array(1=>'<',2=>'>',3=>'"',4=>"'",5=>'&',6=>'/',7=>"\\");
	var_dump($data);
?>
<br>

<h4>検証1 json_encode($data)</h4>
JSONエンコードをかけてダンプしてみる。
<pre class="pre1"><code>$json = json_encode($data);
var_dump($json);
</code></pre>
<?php 
	$json = json_encode($data);
	var_dump($json);
?>
<br>
input要素にこのJSONを埋め込むとバグになる。
<pre class="pre1"><code>&lt;input type="text" value='&lt;?php echo $json?&gt;' style="width:100%" /&gt;</code></pre>
<input type="text" value='<?php echo $json?>' style="width:100%" />
<br>


<h4>検証2 json_encode($data,true)</h4>
JSONエンコードをかけてダンプしてみる。「&lt;」と「&gt;」は変換されている。
<pre class="pre1"><code>$json = json_encode($data,true);
var_dump($json);
</code></pre>
<?php 
	$json = json_encode($data,true);
	var_dump($json);
?>
<br>
input要素にこのJSONを埋め込むとバグになる。
<pre class="pre1"><code>&lt;input type="text" value='&lt;?php echo $json?&gt;' style="width:100%" /&gt;</code></pre>
<input type="text" value='<?php echo $json?>' style="width:100%" />
<br>



<h4>検証3 json_encode($data,JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS)</h4>
JSONエンコードをかけてダンプしてみる。「&lt;」、「&gt;」、「"」、「'」は変換されている。
<pre class="pre1"><code>$json = json_encode($data,JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);
var_dump($json);
</code></pre>
<?php 
	$json = json_encode($data,JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);
	var_dump($json);
?>
<br>
input要素にこのJSONを埋め込んでもバグにならない。
<pre class="pre1"><code>&lt;input type="text" value='&lt;?php echo $json?&gt;' style="width:100%" /&gt;</code></pre>
<input id="json4" type="text" value='<?php echo $json?>' style="width:100%" />
<br>

JavaScriptで埋め込まれたJSON文字列をパースしてみる。
<script>
$(function(){
	$json4 = $('#json4').val();
	var data = JSON.parse($json4);
	console.log(data);
});
</script>
<pre class="pre1"><code>
	$json4 = $('#json4').val();
	var data = JSON.parse($json4);
	console.log(data);
</code></pre>
<pre><code>Object {1: "&lt;", 2: "&gt;", 3: """, 4: "'", 5: "&amp;", 6: "/", 7: "&yen;"}</code></pre>













<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>文字記号のJSON変換を検証</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2017-5-22</div>
</body>
</html>