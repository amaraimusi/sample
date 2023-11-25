<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SVG LINEリッチメニューテンプレート | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap-5.0.2-dist/font/css/open-iconic.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/css/bootstrap-5.0.2-dist/js/bootstrap.bundle.js"></script>
	<script src="/note_prg/js/vue.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/ImgCompactK.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>SVG LINEリッチメニューテンプレート | ワクガンス</h1></div>
<div class="container">

<?php 
require_once 'AreaTp.php';
$areaTp = new AreaTp();
$areaTps = $areaTp->createData();

?>
<h2>Demo</h2>

<div class="row">

	<div class="col-3">
		<?php echo $areaTps[0]['svg']; ?>
	</div>
	<div class="col-3">
		<?php echo $areaTps[1]['svg']; ?>
	</div>
	<div class="col-3">
		<?php echo $areaTps[2]['svg']; ?>
	</div>
	<div class="col-3">
		<?php echo $areaTps[3]['svg']; ?>
	</div>
</div>

<div class="row mt-4">

	<div class="col-3">
		<?php echo $areaTps[4]['svg']; ?>
	</div>
	<div class="col-3">
		<?php echo $areaTps[5]['svg']; ?>
	</div>
	<div class="col-3">
		<?php echo $areaTps[6]['svg']; ?>
	</div>
	<div class="col-3">
		<?php echo $areaTps[7]['svg']; ?>
	</div>
</div>




<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>SVG LINEリッチメニューテンプレート</li>
</ol>
</div><!-- content -->
<div id="footer">(C) amaraimusi 2023-11-25</div>
</body>
</html>