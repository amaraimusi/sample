<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>郵便番号変換 | ワクガンス</title>
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
<div id="header" ><h1>郵便番号変換 | ワクガンス</h1></div>
<div class="container">


<pre><code>
	$post_no = 1234567;
	var_dump($post_no);
	$post_no = convPostNo($post_no);
	var_dump($post_no);
	/**
	 * 郵便番号変換 123-4567形式にする
	 * @param int $post_no 数字羅列の郵便番号
	 * @return string 変換後の郵便番号
	 */
	function convPostNo($post_no){
		
		$post_no_str = $post_no . ''; // 文字列にキャストする
		$post_no_str = trim($post_no_str);
		if(strlen($post_no_str) != 7) return $post_no_str;
		
		$str1 = substr($post_no_str, 0,3); // 先頭の3文字を取得
		$str2 = substr($post_no_str,-4); // 末尾の4文字を取得
		$post_no_str = $str1 . '-' . $str2;
		
		return $post_no_str;
		
	}
</code></pre>

<p>出力</p>
<?php 
	$post_no = 1234567;
	var_dump($post_no);
	$post_no = convPostNo($post_no);
	var_dump($post_no);
	/**
	 * 郵便番号変換 123-4567形式にする
	 * @param int $post_no 数字羅列の郵便番号
	 * @return string 変換後の郵便番号
	 */
	function convPostNo($post_no){
		
		$post_no_str = $post_no . ''; // 文字列にキャストする
		$post_no_str = trim($post_no_str);
		if(strlen($post_no_str) != 7) return $post_no_str;
		
		$str1 = substr($post_no_str, 0,3); // 先頭の3文字を取得
		$str2 = substr($post_no_str,-4); // 末尾の4文字を取得
		$post_no_str = $str1 . '-' . $str2;
		
		return $post_no_str;
		
	}
?>



<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>郵便番号変換</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2019-1-26</div>
</body>
</html>