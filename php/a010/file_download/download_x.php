<?php 
$filepath = 'test/xxx2.zip'; // ダウンロードするファイルのパス
$filename = 'xxx3.zip';// ダウンロード時のファイル名

header('Content-Type: application/force-download'); // コンテンツタイプを指定する
header('Content-Length: '.filesize($filepath));// 進捗を表示
header('Content-Disposition: attachment; filename="'.$filename.'"'); // ダウンロード時のファイル名をセット
readfile($filepath);// ファイル読込とダウンロードの実行
?>