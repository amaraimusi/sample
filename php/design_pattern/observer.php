<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>オブザーバーパターン | ワクガンス</title>
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
<div id="header" ><h1>オブザーバーパターン | ワクガンス</h1></div>
<div class="container">





<pre><code>
interface IObserver{
	public function update($data);
}

class LogObserver implements IObserver{
	
	public function update($data){
		echo 'ログ出力を行いました。（ダミー）'.$data['date1'].'&lt;br&gt;';
	}
}

class MailObserver implements IObserver{
	
	public function update($data){
		echo 'メール送信を行いました。（ダミー）'.$data['date1'].'&lt;br&gt;';
	}
}

class TwitterObserver implements IObserver{
	
	public function update($data){
		echo 'Twitterへ投稿しました。（ダミー）'.$data['date1'].'&lt;br&gt;';
	}
}

class SubjectBase{
	
	public $observers = array();
	
	public function addObserver(IObserver $observer){
		$this-&gt;observers[] = $observer;
	}
	
	public function notifyObservers($data){
		for($i=0; $i&lt;count($this-&gt;observers); $i++){
			$observer = $this-&gt;observers[$i];
			$observer-&gt;update($data);
		}
	}
}

class AnimalSubject extends SubjectBase{
	
	public function __construct(){
		$this-&gt;addObserver(new LogObserver());
		$this-&gt;addObserver(new MailObserver());
		$this-&gt;addObserver(new TwitterObserver());
	}
	
	public function action(){
		
		$data = array('date1' =&gt; date('Y-m-d H:i:s'));
		
		$this-&gt;notifyObservers($data);
	}
}


// 検証
$animal = new AnimalSubject();
$animal-&gt;action();
</code></pre>

<hr>
<p>出力</p>


<?php 

interface IObserver{
	public function update($data);
}

class LogObserver implements IObserver{
	
	public function update($data){
		echo 'ログ出力を行いました。（ダミー）'.$data['date1'].'<br>';
	}
}

class MailObserver implements IObserver{
	
	public function update($data){
		echo 'メール送信を行いました。（ダミー）'.$data['date1'].'<br>';
	}
}

class TwitterObserver implements IObserver{
	
	public function update($data){
		echo 'Twitterへ投稿しました。（ダミー）'.$data['date1'].'<br>';
	}
}

class SubjectBase{
	
	public $observers = array();
	
	public function addObserver(IObserver $observer){
		$this->observers[] = $observer;
	}
	
	public function notifyObservers($data){
		for($i=0; $i<count($this->observers); $i++){
			$observer = $this->observers[$i];
			$observer->update($data);
		}
	}
}

class AnimalSubject extends SubjectBase{
	
	public function __construct(){
		$this->addObserver(new LogObserver());
		$this->addObserver(new MailObserver());
		$this->addObserver(new TwitterObserver());
	}
	
	public function action(){
		
		$data = array('date1' => date('Y-m-d H:i:s'));
		
		$this->notifyObservers($data);
	}
}


// 検証
$animal = new AnimalSubject();
$animal->action();

?>




<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php/">PHP</a></li>
	<li><a href="/sample/php/design_pattern">デザインパターン</a></li>
	<li>オブザーバーパターン</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-6-5</div>
</body>
</html>