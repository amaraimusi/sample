<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>zipの圧縮 | ZipArchive</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>


</head>
<body>
<div id="header" ><h1>PHPによるzip操作 | ZipArchive</h1></div>
<div class="container">











<div id="test1" class="sec4">
	<h3>zipの圧縮</h3>


<?php

if($_SERVER['SERVER_NAME']=='localhost'){
	
	
	if(!empty($_POST['btn_zip_test'])){
		
		$zip = new ZipArchive();
		// ZIPファイルをオープン
		$res = $zip->open('xxx2.zip', ZipArchive::CREATE);
		
		// zipファイルのオープンに成功した場合
		if ($res === true) {
		
			// 圧縮するファイルを指定する
			$zip->addFile('tmp/xxx/icon_kabuto.jpg');
			$zip->addFile('tmp/xxx/icon_tilapia.jpg');
		
			// ZIPファイルをクローズ
			$zip->close();
			echo '圧縮しました<br>';
		}
	

	}
	
	if(!empty($_POST['btn_clear'])){
		if(file_exists('xxx2.zip')){
			unlink('xxx2.zip');
			echo "削除しました。";
		}
		

	}
	
	$fileNames = getAllFileNamesInDir('tmp');
	var_dump($fileNames);
	

}else{
	echo 'localhostで動くサンプルです';
}
?>

	<form action="#" method="post">

		<input type="submit" name='btn_zip_test' value="zipの圧縮" />
		<input type="submit" name='btn_clear' value="btn_clear" />
	</form>
	


	<br><br>
	<br><time>2016-11-28</time>
</div>

<?php
/**
 * ディレクトリごとファイルを削除する。（階層化のファイルまで削除可能）
 * @param string $dir 削除対象ディレクトリ
 * @link http://kidokorock.com/php%E3%81%A7%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E7%AD%89%E3%81%8C%E5%86%85%E5%8C%85%E3%81%95%E3%82%8C%E3%81%9F%E3%83%87%E3%82%A3%E3%83%AC%E3%82%AF%E3%83%88%E3%83%AA%EF%BC%88%E3%83%95%E3%82%A9/
 */
function removeDirectory($dir) {
	if ($handle = opendir("$dir")) {
		while (false !== ($item = readdir($handle))) {
			if ($item != "." && $item != "..") {
				if (is_dir("$dir/$item")) {
					removeDirectory("$dir/$item");
				} else {
					unlink("$dir/$item");
				}
			}
		}
		closedir($handle);
		rmdir($dir);
	}
}


/**
 * ディレクトリ階層化の全ファイル名を取得する
 * @param string $dir ディレクトリ
 * @param array $list ファイル名リスト（内部処理用なのでセット不要)
 * @return ファイル名リスト
 */
function getAllFileNamesInDir($dir,$list=array()) {
	if ($handle = opendir("$dir")) {
		while (false !== ($item = readdir($handle))) {
			if ($item != "." && $item != "..") {
				if (is_dir("$dir/$item")) {
					$list = getAllFileNamesInDir("$dir/$item",$list);
				} else {
					//unlink("$dir/$item");
					$list[] = "$dir/$item";
				}
			}
		}
		closedir($handle);
		
	}
	return $list;
}
?>
















<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>zipの圧縮 | ZipArchive</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2016-11-28</div>
</body>
</html>