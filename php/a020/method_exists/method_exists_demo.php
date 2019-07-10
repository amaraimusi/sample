<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>可変関数 | 文字列で関数を呼び出す</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>

</head>
<body>
<div id="header" ><h1>可変関数 | 文字列で関数を呼び出す</h1></div>
<div class="container">












<h2>デモ</h2>
<h3>文字列で指定した関数を呼び出す。</h3>
<pre><code>
	&lt;?php 
	$str = 'barking_cat';
	if (function_exists($str)) {
		$str();
	} else {
		echo "関数は存在せず";
	}
	
	function barking_cat(){
		echo 'ウオーン&lt;br&gt;';
	}
	?&gt;
</code></pre>
<?php 
$str = 'barking_cat';
if (function_exists($str)) {
	$str();
} else {
	echo "関数は存在せず";
}

function barking_cat(){
	echo 'ウオーン<br>';
}
?>
<hr>

<h3>文字列のクラス名とメソッド名を指定して実行する</h3>
<pre><code>
	&lt;?php 
	$className = 'DogClass';
	$methodName = "bark";
	if (method_exists($className, $methodName)) {
		echo "メソッド実行可&lt;br&gt;";
		$obj = new $className;
		$obj-&gt;$methodName();
	} else {
		echo "メソッドは使用できません。";
	}
	
	class DogClass{
		function bark(){
			echo 'フォンフォン';
		}
	}
	?&gt;
</code></pre>
<?php 
$className = 'DogClass';
$methodName = "bark";
if (method_exists($className, $methodName)) {
	echo "メソッド実行可<br>";
	$obj = new $className;
	$obj->$methodName();
} else {
	echo "メソッドは使用できません。";
}

class DogClass{
	function bark(){
		echo 'フォンフォン';
	}
}
?>








<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>可変関数 | 文字列で関数を呼び出す</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2017-5-26</div>
</body>
</html>