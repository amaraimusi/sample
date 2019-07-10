<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>文字列から連続する数値部分を抽出する</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/livipage.js"></script>

</head>
<body>
<div id="header" ><h1>文字列から連続する数値部分を抽出する</h1></div>
<div class="container">













<h2>デモ</h2>
<?php 
$data = array(
		'abcde',
		'abc1',
		'abc12',
		'abc1234',
		'あいう1234',
		'あいう8765neko5678x',
		'abc1234def',
		'1234def',
		'abc123456789',
		'',
);

echo '<p>出力</p>';
echo "<table class='tbl2'><thead><tr><th>対象文字列</th><th>抽出した数字列</th></tr></thead><tbody>";

foreach($data as $str){
	$nums = extractNumber($str);
	$num_str='';
	foreach($nums as $num) $num_str .= $num . '<br>';
	echo "<tr><td>{$str}</td><td>{$num_str}</td></tr>";
}

echo "</tbody></table>";

/**
 * 文字列から連続する数字列を抽出する
 * 
 * @note
 * マッチする数字列すべてを数字列リスト（配列）で返す。
 * マッチする数字列が存在しない場合、空配列を返す。
 * 
 * @param string $str 対象文字列
 * @param number $min_digit 最小桁数
 * @param number $max_digit 最大桁数
 * @return array 数字列リスト    
 */
function extractNumber($subject,$min_digit=2,$max_digit=8){

 	$pattern = '/\d{' . $min_digit . ',' . $max_digit . '}/';
	preg_match_all ($pattern, $subject, $matches);
	if(!empty($matches)){
		return $matches[0];
	}else{
		return array();
	}

}
?>









<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>文字列から連続する数値部分を抽出する</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-4-13</div>
</body>
</html>