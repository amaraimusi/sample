<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>億万円表記 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>億万円表記 | ワクガンス</h1></div>
<div class="container">


<pre><code>
$tests = array(
		-1200000000,
		-120,
		0,
		120,
		1600,
		1400,
		12000,
		120000,
		1200000,
		12000000,
 		123456789,
		1200000000,
		12000000000,
		120000000001,
		120000100500,
);

echo "&lt;table class='tbl2'&gt;&lt;tbody&gt;";
foreach($tests as $test){
	$res = convOkuman($test);
	echo "&lt;tr&gt;&lt;td&gt;{$test}&lt;/td&gt;&lt;td&gt;{$res}&lt;/td&gt;&lt;/tr&gt;";
}
echo "&lt;/tbody&gt;&lt;/table&gt;";

/**
 * 億万円表記  例　150000000 → 1億5000万
 * @param int $value 数値
 * @return string 億万円表記
 */
function convOkuman($value){

	$unitList = array('','万', '億', '兆', '京', );

	// 4桁リストの作成
	$int_str = $value . ''; // 整数部分
	$rev_str = strrev($int_str);
	$keta4List = str_split($rev_str,4);

	// 億万表記を組み立てる
	$res = ''; // 億万表記の文字列
	foreach($keta4List as $i =&gt; $keta4){
		
		$k = strrev($keta4);
		$k = $k + 0;
		if(!empty($k)){
			$unit = '';
			if(!empty($unitList[$i])) $unit = $unitList[$i];
			$k = $k . '';
			$res = $k . $unit . $res;
		}
	}

	return $res;
	
}
</code></pre>

<p>出力</p>
<?php 

$tests = array(
		-1200000000,
		-120,
		0,
		120,
		1600,
		1400,
		12000,
		120000,
		1200000,
		12000000,
 		123456789,
		1200000000,
		12000000000,
		120000000001,
		120000100500,
);

echo "<table class='tbl2'><tbody>";
foreach($tests as $test){
	$res = convOkuman($test);
	echo "<tr><td>{$test}</td><td>{$res}</td></tr>";
}
echo "</tbody></table>";


	/**
	 * 億万円表記  例　150000000 → 1億5000万
	 * @param int $value 数値
	 * @return string 億万円表記
	 */
	function convOkuman($value){

		$unitList = array('','万', '億', '兆', '京', );

		// 4桁リストの作成
		$int_str = $value . ''; // 整数部分
		$rev_str = strrev($int_str);
		$keta4List = str_split($rev_str,4);

		// 億万表記を組み立てる
		$res = ''; // 億万表記の文字列
		foreach($keta4List as $i => $keta4){
			
			$k = strrev($keta4);
			$k = $k + 0;
			if(!empty($k)){
				$unit = '';
				if(!empty($unitList[$i])) $unit = $unitList[$i];
				$k = $k . '';
				$res = $k . $unit . $res;
			}
		}

		return $res;
		
	}
?>



<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>億万円表記</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2019-1-27</div>
</body>
</html>