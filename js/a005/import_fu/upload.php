<?php



$file1  = current($_FILES);

$fp = $file1['tmp_name'];

// ファイルからテキストを取得する
$text = file_get_contents($fp);

// BOMを除去する
$text = deleteBom($text);

// UTF8に変換する
$text = mb_convert_encoding($text, 'utf-8', 'utf-8,sjis,euc_jp,jis');

// XSSサニタイズ
xss_escape($text);

echo $text;

/**
 * UTF8ファイルのテキストに付いているBOMを除去する
 * @param string $str UTF8ファイルから取得したテキストの文字列
 * @return string BOMを除去した文字列
 */
function deleteBom($str){
	if (($str == NULL) || (mb_strlen($str) == 0)) {
		return $str;
	}
	if (ord($str{0}) == 0xef && ord($str{1}) == 0xbb && ord($str{2}) == 0xbf) {
		$str = substr($str, 3);
	}
	return $str;
}

/**
 * XSSエスケープ（XSSサニタイズ）
 *
 * @note
 * XSSサニタイズ
 * 記号「<>」を「&lt;&gt;」にエスケープする。
 * 高速化のため、引数は参照（ポインタ）にしており、返値もかねている。
 *
 * @param any $data 対象データ | 値および配列を指定
 * @return void
 */
function xss_escape(&$data){
	
	if(is_array($data)){
		foreach($data as &$val){
			xss_escape($val);
		}
		unset($val);
	}elseif(gettype($data)=='string'){
		$data = str_replace(array('<','>'),array('&lt;','&gt;'),$data);
	}else{
		// 何もしない
	}
}