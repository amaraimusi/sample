<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ストラテジーパターンの検証 | ワクガンス</title>
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
<div id="header" ><h1>ストラテジーパターンの検証 | ワクガンス</h1></div>
<div class="container">


<h2>検証</h2>
<hr>
<pre><code>
&lt;?php
class Animal{
	
	private $barkStrategy;
	
	public function __construct($mode='neko'){
		
		// 下記のストラテジー変更は一例に過ぎない。ストラテジーを変更する方法はいろいろある。
		$barkStrategy = new CatStrategy();
		if($mode == 'inu'){
			$this-&gt;setStrategy(new DogStrategy());
		}else if($mode=='buta'){
			$this-&gt;setStrategy(new PigStrategy());
		}else{
			$this-&gt;setStrategy(new CatStrategy());
		}
		
	}
	
	public function setStrategy(IBarkStrategy $barkStrategy){
		$this-&gt;barkStrategy = $barkStrategy;
	}
	
	public function bark(){
		$this-&gt;barkStrategy-&gt;bark();
	}
}

interface IBarkStrategy{
	public function bark();
}

class CatStrategy implements IBarkStrategy{
	public function bark(){
		echo 'ニャオーン';
	}
}

class DogStrategy implements IBarkStrategy{
	public function bark(){
		echo 'ワン ワン';
	}
}

class PigStrategy implements IBarkStrategy{
	public function bark(){
		echo 'キーキー';
	}
}

$animal = new Animal('inu');
$animal-&gt;bark(); // → ワン ワン
echo '&lt;br&gt;';

$animal-&gt;setStrategy(new PigStrategy());
$animal-&gt;bark(); // → キーキー
echo '&lt;br&gt;';

$animal-&gt;setStrategy(new CatStrategy());
$animal-&gt;bark(); // → ニャオーン
echo '&lt;br&gt;';
?&gt;
</code></pre>

<hr>
<p>出力</p>
<?php
class Animal{
	
	private $barkStrategy;
	
	public function __construct($mode='neko'){
		
		// 下記のストラテジー変更は一例に過ぎない。ストラテジーを変更する方法はいろいろある。
		$barkStrategy = new CatStrategy();
		if($mode == 'inu'){
			$this->setStrategy(new DogStrategy());
		}else if($mode=='buta'){
			$this->setStrategy(new PigStrategy());
		}else{
			$this->setStrategy(new CatStrategy());
		}
		
	}
	
	public function setStrategy(IBarkStrategy $barkStrategy){
		$this->barkStrategy = $barkStrategy;
	}
	
	public function bark(){
		$this->barkStrategy->bark();
	}
}

interface IBarkStrategy{
	public function bark();
}

class CatStrategy implements IBarkStrategy{
	public function bark(){
		echo 'ニャオーン';
	}
}

class DogStrategy implements IBarkStrategy{
	public function bark(){
		echo 'ワン ワン';
	}
}

class PigStrategy implements IBarkStrategy{
	public function bark(){
		echo 'キーキー';
	}
}

$animal = new Animal('inu');
$animal->bark(); // → ワン ワン
echo '<br>';

$animal->setStrategy(new PigStrategy());
$animal->bark(); // → キーキー
echo '<br>';

$animal->setStrategy(new CatStrategy());
$animal->bark(); // → ニャオーン
echo '<br>';
?>




<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li><a href="/sample/php/design_pattern">デザインパターンの検証</a></li>
	<li>ストラテジーパターンの検証</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-6-4</div>
</body>
</html>