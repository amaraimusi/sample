
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>年月日からYMD系に変換</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script>



		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">年月日からYMD系に変換</h1>
		<div id="content" >

			<div class="sec1">
<?php
require_once 'DateUtil.php';

$test="2014年6月4日";
$util=new DateUtil();
$ret=$util->cnvNgpToYmd($test,'-');

echo $test;
echo '<br>';
echo $ret;



?>

<br><br><br>

ソースコード<br >
<pre>

$test="2014年6月4日";
$ret=cnvNgpToYmd($test,'-');

echo $test;
echo '&ltbr>';
echo $ret;

/**
 * 年月日表記の文字列からy/m/d型のデータにする。
 * @param  $s	年月日表記の文字列
 * @param  $sp	日付のセパレータ。「/」や「-」の部分
 * @return ymd系の日付文字列。変換できない場合はnul
 */
function cnvNgpToYmd($ngp,$sp='/'){

	$s=str_replace('年',$sp,$ngp);
	$s=str_replace('月',$sp,$s);
	$s=str_replace('日','',$s);

	return $s;

}
</pre>

			</div><!-- sec1 -->

		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/06/04</div>
		</div><!-- page1 -->
	</body>
</html>