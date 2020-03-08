<?php 
// if(!empty($_POST['submit_send_mail'])){
// 	$to = "amaraimusi@gmail.com";
// 	$subject = "テストメールのタイトル";
// 	$message = "こんにちは　テストメールです。\n本日の天気はいかがですか。";
// 	$headers = "";
// 	mb_send_mail($to, $subject, $message, $headers);
// }


				

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>メール送信 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/ImgCompactK.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>メール送信 | ワクガンス</h1></div>
<div class="container">

		
<form action="mail.php" method="post">
	メールテスト開始
	<input name="submit_send_mail" type="submit" value="送信する" />
</form>

<pre><code>
	$to = "amaraimusi@gmail.com";
	$subject = "テストメールのタイトル";
	$message = "こんにちは　テストメールです。\n本日の天気はいかがですか。";
	$headers = "";
	mb_send_mail($to, $subject, $message, $headers);
</code></pre>
				


<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>メール送信</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2013-8-13 | 2020-3-8</div>
</body>
</html>