<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>改行コードを\ltbr\gtタグに変換    nl2br()</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />


	</head>
	<body>
		<div id="page1">
		<h1 id="header">改行コードを\ltbr\gtタグに変換    nl2br()</h1>
		<div id="content" >

			<div class="sec1">

<?php

$str="いろはにほへとちりぬのを\nわかよたれそつねならむ\rうゐのおくやま けふこえて\n\rあさきゆめみしゑひもせす";
$str2=nl2br($str);

echo "<strong>変換前</strong><br>";
echo 'いろはにほへとちりぬのを\nわかよたれそつねならむ\rうゐのおくやま けふこえて\n\rあさきゆめみしゑひもせす';
echo "<br><br>";
echo "<strong>変換後</strong><br>";
echo $str2;
?>

			</div><!-- sec1 -->

		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/10/17</div>
		</div><!-- page1 -->
	</body>
</html>