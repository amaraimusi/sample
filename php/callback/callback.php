<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PHPのコールバック関数</title>
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/ImgCompactK.js"></script>

	<style>

	</style>
</head>
<body>
<div id="header" ><h1>PHPのコールバック関数</h1></div>
<div class="container">












<h3>コールバック関数の検証1</h3>
関数を引数として渡す方法。<br>
<br>
<pre>
$str = "ネコ";
<strong>$funcA</strong> = function($str){ echo "Hello " . $str; };
test1( $str, <strong>$funcA</strong> );

function test1( $str, <strong>$callback</strong> ) {
	echo 'Test1&lt;br&gt;';
	$callback($str);
}
</pre>
<br>

出力
<pre class="output_data">
<?php 

$str = "ネコ";
$funcA = function($str){ echo "Hello " . $str; };

test1( $str, $funcA );

function test1( $str, $callback ) {
	echo 'Test1<br>';
	$callback($str);
}
?>
</pre>
<br><br>





<h3>コールバック関数の検証2</h3>
JavaScriptでよく見かけるコールバック関数の記述方法<br>
<br>
<pre>
$str = "ヤギ";
test2( $str, <strong>function</strong>($str){ 
		echo "Hello " . $str; } 
);

function test2( $str, $callback ) {
	echo 'Test2&lt;br&gt;';
	$callback($str);
}
</pre>
<br>

出力
<pre class="output_data">
<?php 
$str = "ヤギ";
test2( $str, function($str){ 
		echo "Hello " . $str; } 
);

function test2( $str, $callback ) {
	echo 'Test2<br>';
	$callback($str);
}
?>
</pre>
<br><br>





<h3>コールバック関数の検証3</h3>
コールバック関数名を文字列で指定する方法。
<pre>
$str = "カニ";
test3( $str, <strong>'hello_print'</strong> );

function test3( $str, $callback ) {
	return <strong>call_user_func</strong>( $callback, $str );
}

function <strong>hello_print</strong>($str) {
	echo "Hello " . $str;
}
</pre>
<br>
出力
<pre class="output_data">
<?php 

$str = "ヤギ";
test3( $str, 'hello_print' );

function test3( $str, $callback ) {
	return call_user_func( $callback, $str );
}

function hello_print($str) {
	echo "Hello " . $str;
}
?>
</pre>
<br><br>





<h3>コールバック関数の検証4</h3>
クラスのメソッドを文字列で指定する方法。
<pre>
$str = "サメ";
$obj4 = new Class4();
test4( $str, array( <strong>$obj4,'hello_print4'</strong>));

function test4( $str, $callback ) {
	return call_user_func( $callback, $str );
}

class Class4{
	public function hello_print4($str){
		echo "Hello " . $str;
	}
}
</pre>
<br>
出力
<pre class="output_data">
<?php 

$str = "サメ";
$obj4 = new Class4();
test4( $str, array( $obj4,'hello_print4'));

function test4( $str, $callback ) {
	return call_user_func( $callback, $str );
}

class Class4{
	public function hello_print4($str){
		echo "Hello " . $str;
	}
}

?>
</pre>
<br><br>











<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">ＰＨＰ　｜　サンプル</a></li>
	<li>PHPのコールバック関数</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2016-7-5</div>
</body>
</html>