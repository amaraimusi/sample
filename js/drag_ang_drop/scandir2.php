<?php

$dir_name="tmp2";

$files = scandir2($dir_name);

echo var_dump($files);

/**
 * scandir関数の拡張。「.」「..」となっているファイル名は除外する。
 * @param  $dir_name	ディレクトリ名
 * @return ファイル配列
 */
function scandir2($dir_name){
	$files = scandir($dir_name);
	$files = array_filter($files, function ($file) {
		return !in_array($file, array('.', '..'));
	});

	return $files;
}



