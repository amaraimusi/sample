<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ブラウザ判定 | ワクガンス</title>
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
<div id="header" ><h1>ブラウザ判定 | ワクガンス</h1></div>
<div class="container">




<h2>Demo</h2>
<?php 
$browser_type = judgBrowser();
echo $browser_type;
/**
 * ブラウザ判定
 */
function judgBrowser(){
	
	// ユーザーエージェントを取得、および小文字化する。
	$browser = strtolower($_SERVER['HTTP_USER_AGENT']);

	// ユーザーエージェント文字列中のキーワードからブラウザを判定する
	if (strstr($browser , 'edge')) {
		return 'edge';
	} elseif (strstr($browser , 'trident') || strstr($browser , 'msie')) {
		return 'ie';
	} elseif (strstr($browser , 'chrome')) {
		if(strstr($browser , 'opr')){
			return 'opera';
		}else{
			return 'chrome';
		}
	} elseif (strstr($browser , 'firefox')) {
		return 'firefox';
	} elseif (strstr($browser , 'safari')) {
		return 'safari';
	} else {
		return 'none';
	}
}

?>




<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>ブラウザ判定</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2019-1-31</div>
</body>
</html>