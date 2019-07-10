<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Enterキーを押してイベントを発動する</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>



</head>
<body>
<div id="header" ><h1>Enterキーを押してイベントを発動する</h1></div>
<div class="container">









<div id="demo1" class="sec4">
	<h3>EnterキーによるSubmitの挙動</h3>
	テキストボックスにフォーカスが当てられている時にEnterキーを押すとSubmitされる。<br>
	ただし、form要素外のテキストボックスである場合、Enterキーを押してもSubmitは行われない。<br>
	<p>デモ</p>
	<form action="#" method="post">
		
	<?php 
	if(!empty($_POST)){
		echo 'いろは';
	}
	?>
		<br>
		
		<input type="text" name="aaa" value="Form内のテキストボックス"/>
		<input type="submit" name="submit1" value="TEST1"/>
	</form>
	<input type="text" name="aaa2" value="Form外のテキストボックス"/>
	<br>
</div>


<div id="demo2" class="sec4" style="margin-top:300px">
	<h3>onkeypressを組み込める要素</h3>
	onkeypress属性、onkeydown属性、onkeyup属性はフォーカスを当てられる要素にしか指定できない。<br>
	input要素やtextarea要素などフォーカスできる要素に指定可能である。<br>
	しかし、DIV要素などフォーカスできない要素には指定してもイベントは発生しない。<br>
	
	<script>
	function test1(){
		var keyCode = window.event.keyCode;
		console.log(keyCode);
		if(keyCode == 13){
			alert('Enterキーが押されました。');
		}
	}
	</script>
	<div onkeypress="test1()" style="width:200px;height:200px;background-color:#eaf0fb">
		DIV要素にonkeypressを組み込んでも、イベントは発動しない。
	</div>
	
	<input type="text" value="" onkeypress="test1()" />
	<aside>テキストボックスにフォーカスを当ててEnterを押してください。</aside>
	
</div>









<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>Enterキーを押してイベントを発動する</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2016-12-14</div>
</body>
</html>