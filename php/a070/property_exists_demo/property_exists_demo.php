<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>property_exists | オブジェクトもしくはクラスにプロパティが存在するかどうかを調べる | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>

</head>
<body>
<div id="header" ><h1>property_exists | オブジェクトもしくはクラスにプロパティが存在するかどうかを調べる | ワクガンス</h1></div>
<div class="container">

<pre><code>
$animal = new Animal();

echo property_exists($animal, 'name'); // → 1
echo property_exists($animal, 'age');//  → 1
echo property_exists($animal, 'power');//  → 1
echo property_exists($animal, 'bark');//  → 空
echo property_exists($animal, 'dummy');// → 空

class Animal{
	public $name = 'Cat';
	protected $age = 99;
	private $power = 99;
	
	public function bark(){
		
	}
}
</code></pre>

<?php 

$animal = new Animal();

echo property_exists($animal, 'name'); // → 1
echo property_exists($animal, 'age');//  → 1
echo property_exists($animal, 'power');//  → 1
echo property_exists($animal, 'bark');//  → 空
echo property_exists($animal, 'dummy');// → 空

class Animal{
	public $name = 'Cat';
	protected $age = 99;
	private $power = 99;
	
	public function bark(){
		
	}
}

?>





<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>property_exists | オブジェクトもしくはクラスにプロパティが存在するかどうかを調べる</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2020-12-10</div>
</body>
</html>