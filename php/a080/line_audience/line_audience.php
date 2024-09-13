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
			<button type="button" class="btn btn-info btn-sm" onclick="changeMode('list')">一覧</button>
			<button type="button" class="btn btn-info btn-sm" onclick="changeMode('reg')">登録</button>
			<button type="button" class="btn btn-info btn-sm" onclick="changeMode('delete')">削除</button>
		</div>
		<div>
			<label for="access_token">アクセストークン (一覧表示、登録、削除)</label>
			<input type="text" id="access_token" style="width:100%" />
		</div>
		<div class="reg">
			<label for="description">オーディエンス名(登録)</label>
			<input type="text" id="description" name="description" style="width:100%" />
		</div>
		<div class="reg">
			<label for="request_id">ブロードキャストメッセージとナローキャストメッセージのリクエストID(登録)</label>
			<input type="text" id="request_id" name="request_id" style="width:100%" />
		</div>
		<div class="reg">
			<label for="click_url">ユーザーがクリックしたURL(登録)</label>
			<input type="text" id="click_url" name="click_url" style="width:100%" />
		</div>
		<div class="reg">
			<label for="audiences">ユーザーIDまたはIFAの配列(登録)</label>
			<input type="text" id="audiences" name="audiences" style="width:100%" />
		</div>
		<div class="delete">
			<label for="line_audience_group_id">LINEオーディエンスID（削除）</label>
			<input type="text" id="line_audience_group_id" style="width:100%" />
		</div>

		<button type="button" class="btn btn-success btn-sm list" onclick="exec();">一覧表示 実行</button>
		<button type="button" class="btn btn-success btn-sm reg" onclick="exec2();">登録 実行</button>
		<button type="button" class="btn btn-danger btn-sm delete" onclick="exec5();">削除 実行</button>
		
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