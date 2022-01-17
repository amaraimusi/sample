<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>テンプレート | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap-4.3.1-dist/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap-4.3.1-dist/font/css/open-iconic.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap-4.3.1-dist/bootstrap.bundle.min.js"></script>
	<script src="/note_prg/js/vue.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/ImgCompactK.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>テンプレート | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
ブラウザをリロードするたびにトークンを更新します。<br>
８桁のトークン：
<?php 

echo makeToken();

/**
 * トークンを生成する
 * @param number $length
 * @return string
 */
function makeToken($length = 8)
{
    return base_convert(mt_rand(pow(36, $length - 1), pow(36, $length) - 1), 10, 36);
}
?>
<br>

<div class="yohaku"></div>

</div><!-- content -->
<div id="footer">(C) kenji uehara 2022-1-4</div>
</body>
</html>