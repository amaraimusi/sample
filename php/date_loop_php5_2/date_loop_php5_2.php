<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>日付ループ（DateIntervalを使わない）</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script>


		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">日付ループ（DateIntervalを使わない）</h1>
		<div id="content" >

			<div class="sec1">

<?php


$d1 = new DateTime("2011-12-30 00:00:00");
$d2 = new DateTime("2012-3-1 00:00:00");
echo $d1->format("Y-m-d")."<br>";
echo $d2->format("Y-m-d")."<br>";

//それぞれのUNIXタイムスタンプを取得
$u1=$d1->format("U");
$u2=$d2->format("U");

echo $u1."<br>";
echo $u2."<br>";

//一日の秒数
$a=86400;


echo "☆日付ループ( 'U = Y-m-d H:i:s')<br>";

//☆日付ループ
for($u=$u1;$u<=$u2;$u+=$a){

	//setTimestampが使えない場合の代替コード。Datetime::setTimestamp(UNIXタイムスタンプ);
	$y      = date("Y", $u);
	$m      = date("m", $u);
	$d      = date("d", $u);
	$h      = date("H", $u);
	$i      = date("i", $u);
	$s      = date("s", $u);
	echo "{$y}-{$m}-{$d} {$h}:{$i}:{$s}<br>";


}
echo "終了<br>";

?>


			</div><!-- sec1 -->

		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/07/17</div>
		</div><!-- page1 -->
	</body>
</html>