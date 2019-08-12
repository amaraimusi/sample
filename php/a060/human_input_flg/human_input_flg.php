<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>手入力フラグの自動変換 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>

</head>
<body>
<div id="header" ><h1>手入力フラグの自動変換 | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<table class="tbl2"><thead>
	<tr><th>手入力日時</th><th>結果</th></tr></thead>
<tbody>
<?php 
$tests = [
	'なし',
	'0件',
	false,
	'false',
	'ナシ',
	'無し',
	'無効',
	'     無効　　',
	'空',
	'0',
	'',
	null,
	'     none',
	1,
	'1',
	'100',
	'あいうえお',
	true,
	'true'
];

foreach($tests as $value){
	
	$res = humanInputFlg($value);

	
	echo "<tr><td>{$value}</td><td>{$res}</td></tr>";
}

/**
 * 
 */
/**
 * 手入力フラグの自動変換
 *
 * @note
 *「なし」などの表現をBool型に自動変換する。
 *
 * @param string $flg_str フラグ文字列
 * @return boolean 
 */
function humanInputFlg($flg_str){
	
	$flg_str = mb_convert_kana($flg_str, 'n'); // 全角を半角に変換する
	$flg_str = mb_convert_kana($flg_str, 's'); // 全角スペースを半角に変換する
	$flg_str = mb_convert_kana($flg_str, 'a'); // 全角記号半角に変換する
	$flg_str = trim($flg_str);
	$flg_str = preg_replace('/\s(?=\s)/', '', $flg_str); // 連続スペースを一つにする
	
	if(empty($flg_str)) return false;
	
	$fs = ['なし', '無し', '無効', 'false', 'ナシ', 'ﾅｼ', '空', 'none'];
	if(in_array($flg_str, $fs)){
		return false;
	}
	
	return true;
}
?>
</tbody></table>

<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>手入力フラグの自動変換</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2019-8-12</div>
</body>
</html>