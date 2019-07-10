<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>file_get_contentsによるクロスドメイン</title>

	<link href="/sample/style2/css/bootstrap.min.css" rel="stylesheet">
	<link href="/sample/style2/css/common2.css" rel="stylesheet">

	<script src="/sample/style2/js/jquery-1.11.1.min.js"></script>
	<script src="/sample/style2/js/bootstrap.min.js"></script>

</head>
<body>
<div id="header" ><h1>file_get_contentsによるクロスドメイン</h1></div>
<div class="container">



file_get_contents関数は、スクレイピング（外部サイトのコンテンツを取得）で よく使われる。<br>
コンテンツを取得するだけでなく、POSTデータを送信してレスポンスを受け取ることができる。いわゆるクロスドメインである。<br>
<br>

<p>検証</p>
<ol class="list_lg">
	<li><a href="file_get_contents_get.php">file_get_contentsによるクロスドメイン:GET</a></li>
	<li><a href="file_get_contents_post.php">file_get_contentsによるクロスドメイン:POST</a></li>
</ol>









<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">ＰＨＰ　｜　サンプル</a></li>
	<li>file_get_contentsによるクロスドメイン</li>
</ol>
</div><!-- container  -->
<div id="footer"  ><a href="/">(c)wacgance</a> 2016-7-20</div>
</body>
</html>