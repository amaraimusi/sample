<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>初期値をセットする際の1行簡易記述 | ワンライナー | ?? !! | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>
</head>
<body>
<div id="header" ><h1>初期値をセットする際の1行簡易記述 | ワンライナー | ?? !! | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<?php 

$data = ['neko'=>'猫'];
$neko = $data['neko'] ?? '犬';
$dog = $data['dog'] ?? '犬';
echo $neko;
echo $dog;

echo '<br>-------フラグ変換-------<br>';
$list = [1,99,'あ',true,0,'',null];
$flg = 0;
$flg = !!$flg;
echo $flg;

?>


<?php 
?>


<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>初期値をセットする際の1行簡易記述 | ワンライナー | ?? !!</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2020-12-12</div>
</body>
</html>