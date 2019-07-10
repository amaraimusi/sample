<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>位置指定して文字列の一部を置換する（マルチバイトに対応 mb_substr_replace） </title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
</head>
<body>
<div id="header" ><h1>位置指定して文字列の一部を置換する（マルチバイトに対応 mb_substr_replace） </h1></div>
<div class="container">












<a href="#" target="brank">公式サイト</a>

<h2>デモ</h2>
<?php 
$str = "赤いたぬきです。";
$str1 = mb_substr_replace($str, 'ネコ', 2,3);

echo $str . '<br>';
echo $str1 . '<br>';



/**
 * @param mixed $string The input string.
 * @param mixed $replacement The replacement string.
 * @param mixed $start If start is positive, the replacing will begin at the start'th offset into string.  If start is negative, the replacing will begin at the start'th character from the end of string.
 * @param mixed $length If given and is positive, it represents the length of the portion of string which is to be replaced. If it is negative, it represents the number of characters from the end of string at which to stop replacing. If it is not given, then it will default to strlen( string ); i.e. end the replacing at the end of string. Of course, if length is zero then this function will have the effect of inserting replacement into string at the given start offset.
 * @return string The result string is returned. If string is an array then array is returned.
 */
function mb_substr_replace($string, $replacement, $start, $length=NULL) {
	if (is_array($string)) {
		$num = count($string);
		// $replacement
		$replacement = is_array($replacement) ? array_slice($replacement, 0, $num) : array_pad(array($replacement), $num, $replacement);
		// $start
		if (is_array($start)) {
			$start = array_slice($start, 0, $num);
			foreach ($start as $key => $value)
				$start[$key] = is_int($value) ? $value : 0;
		}
		else {
			$start = array_pad(array($start), $num, $start);
		}
		// $length
		if (!isset($length)) {
			$length = array_fill(0, $num, 0);
		}
		elseif (is_array($length)) {
			$length = array_slice($length, 0, $num);
			foreach ($length as $key => $value)
				$length[$key] = isset($value) ? (is_int($value) ? $value : $num) : 0;
		}
		else {
			$length = array_pad(array($length), $num, $length);
		}
		// Recursive call
		return array_map(__FUNCTION__, $string, $replacement, $start, $length);
	}
	preg_match_all('/./us', (string)$string, $smatches);
	preg_match_all('/./us', (string)$replacement, $rmatches);
	if ($length === NULL) $length = mb_strlen($string);
	array_splice($smatches[0], $start, $length, $rmatches[0]);
	return join($smatches[0]);
}
?>









<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>位置指定して文字列の一部を置換する（マルチバイトに対応 mb_substr_replace） </li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-4-15</div>
</body>
</html>