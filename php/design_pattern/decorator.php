<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ステートパターンの検証 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/ImgCompactK.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>ステートパターンの検証 | ワクガンス</h1></div>
<div class="container">


<h2>検証</h2>
<hr>
<pre><code>
class Pet{
	public $name = 'none';
	
	public function getName(){
		return $this-&gt;name;
	}
	public function bark(){
		return '吠える';
	}
	public function price(){
		return 0;
	}
}

class Cat extends Pet{
	
	public function __construct(){
		$this-&gt;name = 'ネコ';
	}
	public function bark(){
		return  'ニャゴー';
	}
	public function price(){
		return 10000;
	}
}

class Dog extends Pet{
	
	public function __construct(){
		$this-&gt;name = '犬';
	}
	public function bark(){
		return  'ワンワン';
	}
	public function price(){
		return 10;
	}
}

// デコレータークラス
class Decorator extends Pet{
	protected $pet;
	
	public function __construct(Pet $pet){
		$this-&gt;pet = $pet;
	}
	
	public function getName(){
		return $this-&gt;pet-&gt;getName();
	}
	
	public function bark(){
		return $this-&gt;pet-&gt;bark();
	}
	
	public function price(){
		return $this-&gt;pet-&gt;price();
	}
}

class Big extends Decorator{

	public function getName(){
		return '大きい' . $this-&gt;pet-&gt;getName();
	}
	
	public function price(){
		return $this-&gt;pet-&gt;price() + 500;
	}
	
}

class Small extends Decorator{

	public function getName(){
		return '小さい' . $this-&gt;pet-&gt;getName();
	}
	public function price(){
		return $this-&gt;pet-&gt;price() + 200;
	}
	
}

class Black extends Decorator{

	public function getName(){
		return '黒い' . $this-&gt;pet-&gt;getName();
	}
	
	public function price(){
		return $this-&gt;pet-&gt;price() + 50;
	}
	
}

class Bowlingual extends Decorator{

	public function bark(){
		return $this-&gt;pet-&gt;bark() . '(今日の天気はいかがですか)';
	}
	
}

// 検証

$cat = new Cat();
output($cat);

$bigCat = new Big($cat);
output($bigCat);

$smallCat = new Small($cat);
output($smallCat);

$blackCat = new Bowlingual($smallCat);
output($blackCat);

$blackCat = new Black($smallCat);

$dog = new Dog();
$dog = new Black($dog);
$dog = new Big($dog);
output($dog);

function output(Pet $pet){
	echo $pet-&gt;getName() . ' → ' . $pet-&gt;bark() . ' → ' .  $pet-&gt;price() . '円&lt;br&gt;';
}
</code></pre>

<hr>
<p>出力</p>
<?php

class Pet{
	public $name = 'none';
	
	public function getName(){
		return $this->name;
	}
	public function bark(){
		return '吠える';
	}
	public function price(){
		return 0;
	}
}

class Cat extends Pet{
	
	public function __construct(){
		$this->name = 'ネコ';
	}
	public function bark(){
		return  'ニャゴー';
	}
	public function price(){
		return 10000;
	}
}

class Dog extends Pet{
	
	public function __construct(){
		$this->name = '犬';
	}
	public function bark(){
		return  'ワンワン';
	}
	public function price(){
		return 10;
	}
}

// デコレータークラス
class Decorator extends Pet{
	protected $pet;
	
	public function __construct(Pet $pet){
		$this->pet = $pet;
	}
	
	public function getName(){
		return $this->pet->getName();
	}
	
	public function bark(){
		return $this->pet->bark();
	}
	
	public function price(){
		return $this->pet->price();
	}
}

class Big extends Decorator{

	public function getName(){
		return '大きい' . $this->pet->getName();
	}
	
	public function price(){
		return $this->pet->price() + 500;
	}
	
}

class Small extends Decorator{

	public function getName(){
		return '小さい' . $this->pet->getName();
	}
	public function price(){
		return $this->pet->price() + 200;
	}
	
}

class Black extends Decorator{

	public function getName(){
		return '黒い' . $this->pet->getName();
	}
	
	public function price(){
		return $this->pet->price() + 50;
	}
	
}

class Bowlingual extends Decorator{

	public function bark(){
		return $this->pet->bark() . '(今日の天気はいかがですか)';
	}
	
}

// 検証

$cat = new Cat();
output($cat);

$bigCat = new Big($cat);
output($bigCat);

$smallCat = new Small($cat);
output($smallCat);

$blackCat = new Bowlingual($smallCat);
output($blackCat);

$blackCat = new Black($smallCat);

$dog = new Dog();
$dog = new Black($dog);
$dog = new Big($dog);
output($dog);

function output(Pet $pet){
	echo $pet->getName() . ' → ' . $pet->bark() . ' → ' .  $pet->price() . '円<br>';
}
?>




<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li><a href="/sample/php/design_pattern">デザインパターンの検証</a></li>
	<li>ステートパターンの検証</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-6-4</div>
</body>
</html>