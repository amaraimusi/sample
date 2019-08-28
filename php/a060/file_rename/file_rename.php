<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>日本語ファイル名を半悪英数字に変更 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>日本語ファイル名を半悪英数字に変更 | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>

<pre><code>
$dp = 'test';
$res = jpFnRename($dp);

echo '&lt;pre&gt;';
var_dump($res);
echo '&lt;/pre&gt;';

/**
 * 日本語ファイル名を半悪英数字に変更 
 * 
 * @note
 * 指定ディレクトリ内の日本語ファイル名を日時から生成したファイル名に一括変更する。
 * 
 * @param string $dp ディレクトリパス
 * @param string $sep セパレータ（省略可）
 * @return array ファイル名変更情報
 */
function jpFnRename($dp, $sep='/'){
	
	$resData = []; // レスポンスデータ
	
	// ディレクトリパスの末尾にセパレータがなければ付け足す。
	$one = mb_substr($dp, -1);
	if($one != $sep) $dp .= $sep;
	
	$fns = scandir($dp);
	foreach($fns as $i =&gt; $fn){
		if($fn == '.' || $fn == '..') continue;
		if (!preg_match("/^[a-zA-Z0-9-_.]+$/", $fn)) {
			
			$old_fp = $dp . $fn; // 旧ファイルパス
			
			// 拡張子を取得
			$pi = pathinfo($fn);
			$ext = $pi['extension'];
			
			// 新ファイルパス
			$date_str = date('Ymd_his');
			$new_fp = "{$dp}{$date_str}_{$i}.{$ext}";
			
			rename ($old_fp, $new_fp); // ファイル名変更
			
			$ent = ['old_fp'=&gt;$old_fp, 'new_fp'=&gt;$new_fp,];
			$resData[] = $ent;
			
		}else{
			$old_fp = $dp . $fn;
			$ent = ['old_fp'=&gt;$old_fp, 'new_fp'=&gt;$old_fp,];
			$resData[] = $ent;
		}
	}
	
	return $resData;
}
</code></pre>
<p>出力</p>
<?php 

$dp = 'test';
$res = jpFnRename($dp);

echo '<pre class="console">';
var_dump($res);
echo '</pre>';

/**
 * 日本語ファイル名を半悪英数字に変更 
 * 
 * @note
 * 指定ディレクトリ内の日本語ファイル名を日時から生成したファイル名に一括変更する。
 * 
 * @param string $dp ディレクトリパス
 * @param string $sep セパレータ（省略可）
 * @return array ファイル名変更情報
 */
function jpFnRename($dp, $sep='/'){
	
	$resData = []; // レスポンスデータ
	
	// ディレクトリパスの末尾にセパレータがなければ付け足す。
	$one = mb_substr($dp, -1);
	if($one != $sep) $dp .= $sep;
	
	$fns = scandir($dp);
	foreach($fns as $i => $fn){
		if($fn == '.' || $fn == '..') continue;
		if (!preg_match("/^[a-zA-Z0-9-_.]+$/", $fn)) {
			
			$old_fp = $dp . $fn; // 旧ファイルパス
			
			// 拡張子を取得
			$pi = pathinfo($fn);
			$ext = $pi['extension'];
			
			// 新ファイルパス
			$date_str = date('Ymd_his');
			$new_fp = "{$dp}{$date_str}_{$i}.{$ext}";
			
			rename ($old_fp, $new_fp); // ファイル名変更
			
			$ent = ['old_fp'=>$old_fp, 'new_fp'=>$new_fp,];
			$resData[] = $ent;
			
		}else{
			$old_fp = $dp . $fn;
			$ent = ['old_fp'=>$old_fp, 'new_fp'=>$old_fp,];
			$resData[] = $ent;
		}
	}
	
	return $resData;
}

?>

<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>日本語ファイル名を半悪英数字に変更</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2019-8-28</div>
</body>
</html>