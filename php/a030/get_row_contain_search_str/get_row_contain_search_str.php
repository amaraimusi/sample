<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>検索する文字を含む行を取得する</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/livipage.js"></script>

</head>
<body>
<div id="header" ><h1>検索する文字を含む行を取得する</h1></div>
<div class="container">












<h2>デモ</h2>
<?php 
$text = "猫いろはにほへと\nちりノライヌぬるを\n馬わかよたれそつねならむ馬\nうゐのおく馬やまけふこえて\nあさきゆめみしゑひもせすん牛";

$data = array('猫','ノライヌ','馬','牛','UMA');

echo '<pre>' . $text . '</pre>';
echo '<p>出力</p>';
echo "<table class='tbl2'><thead><tr><th>検索文字</th><th>offset(先頭)</th><th>offset(末尾)</th><th>取得行</th></tr></thead><tbody>";

foreach($data as $str){
	$info = getRowContainSearchStr($str,$text);
	$offset1 = $info['offset1'];
	$offset2 = $info['offset2'];
	$row_str = $info['row_str'];
	echo "<tr><td>{$str}</td><td>{$offset1}</td><td>{$offset2}</td><td>{$row_str}</td></tr>";
}

echo "</tbody></table>";

/**
 * 検索する文字を含む行を取得する
 * 
 * @note
 * 検索する文字を含む改行コードにはさまれた文字列を取得する
 * 
 * @param string $search 検索文字
 * @param string $subject 対象文字列
 * @param int $offset 検索開始位置
 * @param int $mode モード  0:行文字列のみ取得 , 1:行文字列や位置情報も取得する
 * @param string $nl_code 改行コード
 * @return string 検索文字を含む行
 */
function getRowContainSearchStr($search,$subject,$offset=0,$mode=0,$nl_code="\n"){
	$len = mb_strlen($subject);
	$a1 = mb_strpos($subject,$search,$offset);
	if($a1 === false){
		return array(
				'offset1' => null,
				'offset2' => null,
				'row_str' => null,
		);
	}
	$offset2 = mb_strpos($subject,$nl_code,$a1);
	if($offset2 === false) $offset2 = $len;
	$a2 = $offset2 - $len -1;
	$offset1 = mb_strripos($subject,$nl_code,$a2);
	if($offset1 === false) $offset1 = 0;
	$row_str = mb_substr($subject,$offset1,$offset2 - $offset1);
	
	return array(
			'offset1' => $offset1,
			'offset2' => $offset2,
			'row_str' => $row_str,
	);
}

?>










<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>検索する文字を含む行を取得する</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-4-12</div>
</body>
</html>