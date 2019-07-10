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
interface IState{
	public function reservation();
	public function checkin();
	public function checkout();
}


class ReservState implements IState{
	private $subject;
	
	public function __construct(Hotel $subject){
		$this-&gt;subject = $subject;
	}
	
	public function reservation(){
		echo '予約済みです。&lt;br&gt;';
	}
	
	public function checkin(){
		echo 'チェックインし、滞在状態になりました。&lt;br&gt;';
		$this-&gt;subject-&gt;changeState(new StayState($this-&gt;subject));
	}
	
	public function checkout(){
		echo '予約状態でチェックアウトはできません。&lt;br&gt;';
	}
}


class StayState implements IState{
	private $subject;
	
	public function __construct(Hotel $subject){
		$this-&gt;subject = $subject;
	}
	
	public function reservation(){
		echo '別件で予約状態にします。&lt;br&gt;';
	}
	
	public function checkin(){
		echo 'チェックイン済みです。&lt;br&gt;';
	}
	
	public function checkout(){
		echo 'チェックアウトして、未予約状態になりました。&lt;br&gt;';
		$this-&gt;subject-&gt;changeState(new UnreservState($this-&gt;subject));
	}
}


class UnreservState implements IState{
	private $subject;
	
	public function __construct(Hotel $subject){
		$this-&gt;subject = $subject;
	}
	
	public function reservation(){
		echo '予約して、予約状態になりました。&lt;br&gt;';
		$this-&gt;subject-&gt;changeState(new ReservState($this-&gt;subject));
	}
	
	public function checkin(){
		echo '空き室があれば滞在状態になります。空き室がなければ未予約状態のままです。&lt;br&gt;';
	}
	
	public function checkout(){
		echo 'チェックインしていないのでチェックアウトできません。&lt;br&gt;';
	}
}


class Hotel{
	
	private $state; // &lt;IState&gt;
	public function __construct(){
		$this-&gt;state = new UnreservState($this); // 未予約状態
	}
	
	/**
	 * 状態を変更する
	 * @param IState $state 状態クラスのインスタンス
	 */
	public function changeState(IState $state){
		$this-&gt;state = $state;
	}
	
	public function reserveAction(){
		$this-&gt;state-&gt;reservation();
	}
	
	public function checkinAction(){
		$this-&gt;state-&gt;checkin();
	}
	
	public function checkoutAction(){
		$this-&gt;state-&gt;checkout();
	}
}

$hotel = new Hotel();
$hotel-&gt;reserveAction();
$hotel-&gt;checkinAction();
$hotel-&gt;checkinAction();
$hotel-&gt;checkoutAction();

</code></pre>

<hr>
<p>出力</p>
<?php

interface IState{
	public function reservation();
	public function checkin();
	public function checkout();
}


class ReservState implements IState{
	private $subject;
	
	public function __construct(Hotel $subject){
		$this->subject = $subject;
	}
	
	public function reservation(){
		echo '予約済みです。<br>';
	}
	
	public function checkin(){
		echo 'チェックインし、滞在状態になりました。<br>';
		$this->subject->changeState(new StayState($this->subject));
	}
	
	public function checkout(){
		echo '予約状態でチェックアウトはできません。<br>';
	}
}


class StayState implements IState{
	private $subject;
	
	public function __construct(Hotel $subject){
		$this->subject = $subject;
	}
	
	public function reservation(){
		echo '別件で予約状態にします。<br>';
	}
	
	public function checkin(){
		echo 'チェックイン済みです。<br>';
	}
	
	public function checkout(){
		echo 'チェックアウトして、未予約状態になりました。<br>';
		$this->subject->changeState(new UnreservState($this->subject));
	}
}


class UnreservState implements IState{
	private $subject;
	
	public function __construct(Hotel $subject){
		$this->subject = $subject;
	}
	
	public function reservation(){
		echo '予約して、予約状態になりました。<br>';
		$this->subject->changeState(new ReservState($this->subject));
	}
	
	public function checkin(){
		echo '空き室があれば滞在状態になります。空き室がなければ未予約状態のままです。<br>';
	}
	
	public function checkout(){
		echo 'チェックインしていないのでチェックアウトできません。<br>';
	}
}


class Hotel{
	
	private $state; // <IState>
	public function __construct(){
		$this->state = new UnreservState($this); // 未予約状態
	}
	
	/**
	 * 状態を変更する
	 * @param IState $state 状態クラスのインスタンス
	 */
	public function changeState(IState $state){
		$this->state = $state;
	}
	
	public function reserveAction(){
		$this->state->reservation();
	}
	
	public function checkinAction(){
		$this->state->checkin();
	}
	
	public function checkoutAction(){
		$this->state->checkout();
	}
}

$hotel = new Hotel();
$hotel->reserveAction();
$hotel->checkinAction();
$hotel->checkinAction();
$hotel->checkoutAction();

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