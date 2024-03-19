<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LINEオーディエンスの一覧表示、登録、削除| ワクガンス</title>
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
	<script src="script.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>

</head>
<body>
<div id="header" ><h1>LINEオーディエンスの一覧表示、登録、削除| ワクガンス</h1></div>
<div class="container">

<?php 




function dump($var){
	echo '<pre>';
	var_dump($var);
	echo '</pre>';
	
}
?>
<div>
	
	
	<div>
		<div>
			<label for="access_token">アクセストークン</label>
			<input type="text" id="access_token" style="width:100%" />
		</div>
		<div>
			<label for="line_audience_group_id">LINEオーディエンスID</label>
			<input type="text" id="line_audience_group_id" style="width:100%" />
		</div>

		<button type="button" class="btn btn-success btn-sm" onclick="exec();">一覧表示</button>
		<button type="button" class="btn btn-success btn-sm" onclick="exec2();">登録</button>
		<button type="button" class="btn btn-danger btn-sm" onclick="exec5();">削除</button>
		
	</div>
	<div id="audience_list"></div>
	<div id="res" class="text-success"></div>
	<div id="err" class="text-danger"></div>
</div>



<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">php ｜ サンプル</a></li>
	<li>LINEオーディエンスの一覧表示、登録、削除</li>
</ol>
</div><!-- content -->
<div id="footer">(C) amaraimusi 2024-3-15</div>
</body>
</html>