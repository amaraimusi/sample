<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>scandirの拡張関数 | 日本語以外のファイルにも対応</title>
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/ImgCompactK.js"></script>


	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>scandirの拡張関数 | 日本語以外のファイルにも対応</h1></div>
<div class="container">




<h3>検証</h3>
半角性数字、中国語（繁体字）、日本語、ヘブライ語、ベンガル語、ハングルのファイル名で検証する。
<pre><code>
&lt;?php 
$list = scandir2('sample');
echo '&lt;pre&gt;';
var_dump($list);
echo '&lt;/pre&gt;';

function scandir2($dp){
	$files = scandir($dp);
	
	$enclist = array(
	'UTF-8','SJIS','ASCII' ,
	);	
	
	$code_str = join(',', $enclist);

	echo "&lt;table class='tbl2'&gt;&lt;tbody&gt;";

	foreach($files as $file){
		if($file=='.' || $file=='..'){
			continue;
		}

		echo '&lt;tr&gt;';
		echo '&lt;td&gt;' . urlencode($file) . '&lt;/td&gt;';
	
		$enc = mb_detect_encoding($file,$code_str);
		$file= mb_convert_encoding($file,"UTF-8",$enc);
		$enc2 = mb_detect_encoding($file);

		echo '&lt;td&gt;' . $enc . '&lt;/td&gt;';
		echo '&lt;td&gt;' . $enc2 . '&lt;/td&gt;';
		echo '&lt;td&gt;' . $file . '&lt;/td&gt;';

		$files2[] = $file;
		
		echo '&lt;/tr&gt;';
	}
	echo '&lt;/tbody&gt;&lt;/table&gt;';
	return $files2;
}
?&gt;
</code></pre>
<p>出力</p>
<?php 
$list = scandir2('sample');
echo '<pre>';
var_dump($list);
echo '</pre>';

function scandir2($dp){
	$files = scandir($dp);
	
	$enclist = array(
	'UTF-8','SJIS','ASCII' ,
	);	
	
	$code_str = join(',', $enclist);

	echo "<table class='tbl2'><tbody>";

	foreach($files as $file){
		if($file=='.' || $file=='..'){
			continue;
		}

		echo '<tr>';
		echo '<td>' . urlencode($file) . '</td>';
	
		$enc = mb_detect_encoding($file,$code_str);
		$file= mb_convert_encoding($file,"UTF-8",$enc);
		$enc2 = mb_detect_encoding($file);

		echo '<td>' . $enc . '</td>';
		echo '<td>' . $enc2 . '</td>';
		echo '<td>' . $file . '</td>';

		$files2[] = $file;
		
		echo '</tr>';
	}
	echo '</tbody></table>';
	return $files2;
}
?>




<hr>
<h3 id="demo2">scandirEx関数</h3>
<pre><code>
&lt;?php 
$list = scandirEx('sample');
echo '&lt;pre&gt;';
var_dump($list);
echo '&lt;/pre&gt;';

/**
 * ディレクトリ内のファイル一覧を取得（外国語ファイル名に対応）
 * 
 * @note
 * さくらサーバー（スタンダードプラン）である場合、ファイル名が外国語でも取得可能。半角英数字はASCII、他言語はUTF-8として取得される。
 * 一般的なローカル環境（Windows）である場合、半角英数字はASCII、日本語はUTF-8、多言語は文字化けする。
 * 
 * 外国語のファイル名を取得したい場合、サーバーのOSレベルでの設定が必要になってくる。
 * 
 * @param unknown $dp
 * @param string $str_code
 * @return string
 */
function scandirEx($dp,$str_code='UTF-8,SJIS,ASCII'){
	$files = scandir($dp);
	
	foreach($files as $file){
		if($file=='.' || $file=='..'){
			continue;
		}
		
		$enc = mb_detect_encoding($file,$str_code);
		$file= mb_convert_encoding($file,"UTF-8",$enc);
		
		$files2[] = $file;
		
	}
	return $files2;
}
?&gt;
</code></pre>
<p>出力</p>
<?php 
$list = scandirEx('sample');
echo '<pre>';
var_dump($list);
echo '</pre>';

/**
 * ディレクトリ内のファイル一覧を取得（外国語ファイル名に対応）
 * 
 * @note
 * さくらサーバー（スタンダードプラン）である場合、ファイル名が外国語でも取得可能。半角英数字はASCII、他言語はUTF-8として取得される。
 * 一般的なローカル環境（Windows）である場合、半角英数字はASCII、日本語はUTF-8、多言語は文字化けする。
 * 
 * 外国語のファイル名を取得したい場合、サーバーのOSレベルでの設定が必要になってくる。
 * 
 * @param unknown $dp
 * @param string $str_code
 * @return string
 */
function scandirEx($dp,$str_code='UTF-8,SJIS,ASCII'){
	$files = scandir($dp);
	
	foreach($files as $file){
		if($file=='.' || $file=='..'){
			continue;
		}
		
		$enc = mb_detect_encoding($file,$str_code);
		$file= mb_convert_encoding($file,"UTF-8",$enc);
		
		$files2[] = $file;
		
	}
	return $files2;
}
?>











<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>scandirの拡張関数 | 日本語以外のファイルにも対応</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2017-11-9</div>
</body>
</html>