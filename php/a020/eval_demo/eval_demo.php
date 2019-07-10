<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>evalの使い方</title>
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>



	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>evalの使い方</h1></div>
<div class="container">









<p>検証0</p>
<pre><code>
	$str0 = "echo 'マンモス'; ";
	eval($str0);
</code></pre>
<?php 
$str0 = "echo 'マンモス'; ";
eval($str0);
?>
<hr>

<p>検証1</p>
eval実行する文字列にPHPコードやHTMLコードが混在している場合。
<pre><code>
	$str = "動物名：&lt;?php echo 'アフリカゾウ'; ?&gt;&lt;hr&gt;";
	eval(' ?&gt;'.$str.'&lt;?php ');
</code></pre>
<?php 
$str = "動物名：<?php echo 'アフリカゾウ'; ?><hr>";
eval(' ?>'.$str.'<?php ');
?>

<p>検証2</p>
evalの外で宣言している変数をeval内で実行する
<pre><code>
	$animal_name= 'インド象';
	$str2 = "動物名：&lt;?php echo &yen;$animal_name; ?&gt;&lt;br&gt;";
	eval(' ?&gt;'.$str2.'&lt;?php ');
</code></pre>
<?php 
	$animal_name= 'インド象';
	$str2 = "動物名：<?php echo \$animal_name; ?><br>";
	eval(' ?>'.$str2.'<?php ');
?>
<hr>

<p>検証2.1</p>
evalで実行する文字列を「"」で括った場合と、「'」で括った場合を検証する。
<pre><code>
	$animal_name= 'インド象';
	$str2 = "動物名：&lt;?php echo &yen;$animal_name; ?&gt;&lt;br&gt;";
	eval(' ?&gt;'.$str2.'&lt;?php ');
	$str2 = '動物名：&lt;?php echo $animal_name; ?&gt;&lt;hr&gt;';
	eval(' ?&gt;'.$str2.'&lt;?php ');
</code></pre>
<?php 
	$animal_name= 'インド象';
	$str2 = "動物名：<?php echo \$animal_name; ?><br>";
	eval(' ?>'.$str2.'<?php ');
	$str2 = '動物名：<?php echo $animal_name; ?><hr>';
	eval(' ?>'.$str2.'<?php ');
?>

<p>検証3</p>
eval内で宣言されている変数を、eval外で参照してみる。
<pre><code>
	$str3 = "&lt;?php &yen;$nauman='ナウマンゾウ&lt;hr&gt;'; ?&gt;";
	eval(' ?&gt;'.$str3.'&lt;?php ');
	echo $nauman;
</code></pre>
<?php 
	$str3 = "<?php \$nauman='ナウマンゾウ<hr>'; ?>";
	eval(' ?>'.$str3.'<?php ');
	echo $nauman;
?>

<p>検証4</p>
eval内でエラーが起きたときのエラー情報をキャッチする。
<pre><code>
&lt;?php 
	$str4 = "
		&lt;?php
			&yen;$a='大きな';
			&yen;$b='ゾウは';
			&yen;$c= 10 / 0; // ワザとエラーにする。
			&yen;$d='m あります。';
			echo &yen;$a . &yen;$b . &yen;$c . &yen;$d;
		?&gt;
		";	
	echo $str4;
	 $response = @eval(' ?&gt;'.$str4.'&lt;?php ');
	if (error_get_last()){
		echo '&lt;div style="color:red"&gt;eval内のエラーです&lt;br&gt;';
		print_r(error_get_last());
		echo '&lt;/div&gt;';
	}
?&gt;
</code></pre>
<?php 
	$str4 = "
		<?php
			\$a='大きな';
			\$b='ゾウは';
			\$c= 10 / 0; // ワザとエラーにする。
			\$d='m あります。';
			echo \$a . \$b . \$c . \$d;
		?>
		";	
	echo $str4;
	 $response = @eval(' ?>'.$str4.'<?php ');
	if (error_get_last()){
		echo '<div style="color:red">eval内のエラーです<br>';
		print_r(error_get_last());
		echo '</div>';
	}
?>








<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>evalの使い方</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2017-6-8</div>
</body>
</html>