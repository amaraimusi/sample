<?php

var_dump('test');//■■■□□□■■■□□□■■■□□□
var_dump(DIRECTORY_SEPARATOR);//■■■□□□■■■□□□■■■□□□



//▽▽▽ZIP内にディレクトリを追加する

// $zip = new ZipArchive();

// // ZIPファイルをオープン
// $root = $_SERVER['DOCUMENT_ROOT'];
// $zip_fp = $root.'sample\js\a005\zip_subdiv\zip_test\xxx3.zip'; // ZIPのパス   ※すでに存在するzipファイルを指定すると、そのzipにリソースファイルが追加される。

// $target_dir = "";
// $res = $zip->open($zip_fp, ZipArchive::CREATE);

// // zipファイルのオープンに成功した場合
// if ($res === true) {
	
// 	// ZIP内にディレクトリを追加
// 	$zip->addEmptyDir('yama\x1');
// 	$zip->addEmptyDir('yama\x2');
	
// 	// 圧縮するファイルを指定する
// 	$zip->addFile($root.'photos\travel\uhugusimui_2017\thum\2017-02-11_120439_DSC_0106.jpg','yama\x1\a.jpg');
// 	$zip->addFile($root.'photos\travel\uhugusimui_2017\thum\2017-02-11_120546_DSC_0107.jpg','yama\x2\c.jpg');

// 	// 閉じる
// 	$zip->close();
// 	echo '圧縮しました<br>';
// }


// $root = $_SERVER['DOCUMENT_ROOT']; 	// ルートパス

// // ファイルパスを組み立てる
// $fp = $root . 'photos\travel\uhugusimui_2017\thum\2017-02-11_115723_DSC_0105.jpg';
// $fp = mb_convert_encoding($fp, 'sjis', 'utf-8'); // 日本語ファイル名に対応

// $file_size=0;
// if(is_file($fp)){
	
// 	// ファイルサイズを取得する
// 	$file_size = filesize($fp);
// }
// var_dump('$file_size＝'.$file_size);// 出力→ '$file_size＝12377'


// $fps = [
// 		"/test/aaa.png",
// 		"\\test\\b.png",
// 		"\\test/c.png",
// 		"test\\あ.png",
// 		"eee.png",
// 		"/abc/xxx/",
// 		"abc/xxx",
// 		"",
// 		null,
// 		1,
// ];

// var_dump($fps);//■■■□□□■■■□□□■■■□□□


// $fps2 = array();
// foreach($fps as $fp){
// 	 $fp = _convSeparator($fp);
// 	 $fp = _headSeparator($fp,1);
// 	 $fp = _endSeparator($fp,1);
// 	 $fps2[] = $fp;
	
// }
// var_dump($fps2);//■■■□□□■■■□□□■■■□□□




// // $fp = "/note_prg/php\\note12.html";
// // $fp = _convSeparator($fp); // → \note_prg\php\note12.html
// // var_dump($fp);//■■■□□□■■■□□□■■■□□□

// /**
//  * パスのセパレータをシステム基準のセパレータに変換する（DIRECTORY_SEPARATORに変換）
//  * @param string $fp
//  * @return mixed
//  */
// function _convSeparator($fp){
	
// 	if(strpos($fp,"/")!==false){
// 		$fp =  str_replace("/", DIRECTORY_SEPARATOR, $fp);
// 	}
	
// 	if(strpos($fp,"\\")!==false){
// 		$fp =  str_replace("/", DIRECTORY_SEPARATOR, $fp);
// 	}
	
// 	return $fp;
// }

// /**
//  * パスの先頭にセパレータを付加あるいは削除を行う
//  * @param string $path パス
//  * @param int $flg 0:削除  , 1:付加
//  * @param string $sep セパレータ（省略時は基準セパレータ）
//  * @return パス
//  */
// function _headSeparator($path,$flg,$sep = DIRECTORY_SEPARATOR){
// 	if(empty($path)){
// 		return $path;
// 	}
	
// 	$s1 = mb_substr($path,0 ,1);
// 	if(empty($flg)){
// 		if($s1 == $sep){
// 			$path = mb_substr($path,1);
// 		}
// 	}else{
// 		if($s1 != $sep){
// 			$path = $sep . $path;
// 		}
// 	}
	
// 	return $path;
	
// }


// /**
//  * パスの末尾にセパレータを付加あるいは削除を行う
//  * @param string $path パス
//  * @param int $flg 0:削除  , 1:付加
//  * @param string $sep セパレータ（省略時は基準セパレータ）
//  * @return パス
//  */
// function _endSeparator($path,$flg,$sep = DIRECTORY_SEPARATOR){
// 	if(empty($path)){
// 		return $path;
// 	}
	
// 	$s1 = mb_substr($path, -1);
// 	if(empty($flg)){
// 		if($s1 == $sep){
// 			$path = mb_substr($path,0,mb_strlen($path)-1);// 末尾の一文字を削る
// 		}
// 	}else{
// 		if($s1 != $sep){
// 			$path .= $sep;
// 		}
// 	}
	
// 	return $path;
	
// }
