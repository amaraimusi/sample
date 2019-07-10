<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>JSONをPHPでエンコードしJavaScriptでパース（デコード）する</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>


</head>
<body>
<div id="header" ><h1>JSONをPHPでエンコードしJavaScriptでパース（デコード）する</h1></div>
<div class="container">













<h2>検証</h2>
<div class="sec1">
	<h3>検証1</h3>
	は<>記号と改行を含むデータのJSONエンコードとパースを検証する。<br>
	catは通常文字、dogは<>記号を含む文字、iguanaは改行を含む文字である。
<?php 
	$data1 = array('cat'=>'猫','dog'=>'犬','iguana'=>'イグアナ');
	$data2 = array('cat'=>'大猫','dog'=>'big_doc<input />','iguana'=>"big\niguana");
	
	$json1 = json_encode($data1,true);
	$json2 = json_encode($data2,true);
	
?>

	<pre>
	&lt;?php 
		$data1 = array('cat'=&gt;'猫','dog'=&gt;'犬','iguana'=&gt;'イグアナ');
		$data2 = array('cat'=&gt;'大猫','dog'=&gt;'big_doc&lt;input /&gt;','iguana'=&gt;"big&yen;niguana");
		
		$json1 = json_encode($data1,true);
		$json2 = json_encode($data2,true);
		
	?&gt;
	</pre>
	
	<p>JSON1</p>
	<div><?php echo var_dump($data1);//■■■□□□■■■□□□■■■□□□?></div>
	<div id="json1"><?php echo $json1?></div><br>
	<p>JSON2</p>
	<div><?php echo var_dump($data2);//■■■□□□■■■□□□■■■□□□?></div>
	<div id="json2"><?php echo $json2?></div><br>
	
	<script>
	$(function(){
		

		var json1 = $('#json1').html();
		var data1 = JSON.parse(json1);
		console.log(data1);//■■■□□□■■■□□□■■■□□□
		output(data1);

		var json2 = $('#json2').html();
		var data2 = JSON.parse(json2);
		console.log(data2);//■■■□□□■■■□□□■■■□□□
		output(data2);

	});

	function output(data){
		var msgs = "";
		for(var key in data){
			var v = data[key];
			var msg = key + ' = ' + v + '<br>';
			msgs += msg;
		}
		$('#res1').append(msgs);
	}
	</script>
	
	<div id="res1" class="text-success"></div>
</div>

















<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>JSONをPHPでエンコードしJavaScriptでパース（デコード）する</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2017-2-8</div>
</body>
</html>