<?php
# エラー時に出力するメッセージ
# Java　Script の方と同じエラーメッセージにしてください。
$ERROR_COMMENT = "ReadingFileErrorOccurred";

# 全てのエラーを errorHandler で処理するように設定します。
error_reporting(0);
function errorHandler ($errno, $errstr, $errfile, $errline){
    global $ERROR_COMMENT;
        echo $ERROR_COMMENT."　:　".$errstr;
}
set_error_handler("errorHandler");

# Ajax から渡された URL データを読み込みます。
if ($_GET{'url'}) {
  $url = urldecode($_GET{'url'});
} else {
  $url = urldecode($_POST{'url'});
}

if( is_url($url) ) {
    # Ajax での データ入出力の文字コードは UTF-8 なので UTF-8に変換
    # 読み込む最大ファイルサイズを指定しない場合は
    # file_get_contents($url, FALSE, NULL)
    # としてください。
    echo mb_convert_encoding(
    file_get_contents($url, FALSE, NULL, 0, 10000),
    "UTF-8",
    "auto");
} else {
    trigger_error("URLが不正です。", E_USER_WARNING);
}

# $text がURLとして正しい形式かどうかをチェック
#
function is_url($text) {
//    if (preg_match('/^(https?|ftp)(://[-_.!~*'()a-zA-Z0-9;/?:@&=+$,%#]+)$/', $text)) {
//        return TRUE;
//    } else {
//        return FALSE;
//    }
	return true;
}

?>