<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>strtotimeをいろいろな日付文字列で試す | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery.min.js"></script>	
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/vue.min.js"></script>
	<script src="script.js"></script>

</head>
<body>
<div id="header" ><h1>strtotimeをいろいろな日付文字列で試す | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>


<table class="tbl2">
	<tbody>
		<tr><td>strtotime('2022-11-8');</td><td><?php echo strtotime('2022-11-8'); ?></td><td></td></tr>
		<tr><td>strtotime('2022-11');</td><td><?php echo strtotime('2022-11'); ?></td><td></td></tr>
		<tr><td>strtotime('2022');</td><td><?php echo strtotime('2022'); ?></td><td></td></tr>
		<tr><td>strtotime('11');</td><td><?php echo strtotime('11'); ?></td><td></td></tr>
		<tr><td>strtotime('8');</td><td><?php echo strtotime('8'); ?></td><td></td></tr>
		<tr><td>strtotime('');</td><td><?php echo strtotime(''); ?></td><td></td></tr>
		<tr><td>strtotime(0);</td><td><?php echo strtotime(0); ?></td><td></td></tr>
		<tr><td>strtotime(null);</td><td><?php echo strtotime(null); ?></td><td></td></tr>
		<tr><td>strtotime('2022-11-8 12:12:12');</td><td><?php echo strtotime('2022-11-8 12:12:12'); ?></td></tr>
		<tr><td>strtotime('2022-11-8 12:12');</td><td><?php echo strtotime('2022-11-8 12:12'); ?></td></tr>
		<tr><td>strtotime('2022-11-8 12');</td><td><?php echo strtotime('2022-11-8 12'); ?></td></tr>
		<tr><td>strtotime('abc');</td><td><?php echo strtotime('abc'); ?></td></tr>
		<tr><td>strtotime('2022/11/8 12:12:12');</td><td><?php echo strtotime('2022/11/8 12:12:12'); ?></td><td>スラッシュ区切り</td></tr>
		<tr><td>strtotime('8-11-2022 12:12:12');</td><td><?php echo strtotime('8-11-2022 12:12:12'); ?></td><td>米国式の日付記述</td></tr>
	</tbody>
</table>
<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>strtotimeをいろいろな日付文字列で試す</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2022-11-8</div>
</body>
</html>