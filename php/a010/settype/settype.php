<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>型をセットする | settype</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>



</head>
<body>
<div id="header" ><h1>型をセットする | settype</h1></div>
<div class="container">










<h2>デモ</h2>

<form action="#" method="post">
	
<?php 
$a = 4;
output($a);
settype($a,'string');
output($a);
settype($a,'bool');
output($a);
settype($a,'int');
output($a);
settype($a,'double');
output($a);


function output($a){
	
	echo $a;
	echo '<br>';
	echo gettype($a);
	echo '<br>';
	echo '-----<br>';
}
?>
	<br>
</form>
<br>









<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>型をセットする | settype</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2016-11-21</div>
</body>
</html>