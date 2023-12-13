<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LINEリッチメニューをCURLで送信設定するphpコード | ワクガンス</title>
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
	
	<style>
		img{
			width:120px;
		}
	</style>
</head>
<body>
<div id="header" ><h1>LINEリッチメニューをCURLで送信設定するphpコード | ワクガンス</h1></div>
<div class="container">

<?php 

require_once 'Service.php';
$service = new Service();
$defRichMenuAreas = $service->createDefaultRichMenuAreas('A,B,C,D,E,F,G,H,I');
dump($defRichMenuAreas);//■■■□□□■■■□□□)

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
			<label for="line_rich_menu_id">LINEリッチメニューID</label>
			<input type="text" id="line_rich_menu_id" style="width:100%" />
		</div>
		<div style="display:flex;justify-content:space-around;flex-wrap:wrap;background-color:#ffd764">
			<div>
				<input type="radio" id="rich_menu_img1" name="rich_menu_img" value="13e04e03c.png" /><br>
				<label for="rich_menu_img1"><img src="img/13e04e03c.png" alt="" /></label>
			</div>
			<div>
				<input type="radio" id="rich_menu_img2" name="rich_menu_img" value="22_0915_02.png" checked /><br>
				<label for="rich_menu_img2"><img src="img/22_0915_02.png" alt="" /></label>
			</div>
			<div>
				<input type="radio" id="rich_menu_img3" name="rich_menu_img" value="22_0915.png" /><br>
				<label for="rich_menu_img3"><img src="img/22_0915.png" alt="" /></label>
			</div>
			<div>
				<input type="radio" id="rich_menu_img4" name="rich_menu_img" value="rich_menu_green_2.png" /><br>
				<label for="rich_menu_img4"><img src="img/rich_menu_green_2.png" alt="" /></label>
			</div>
		</div>
		<button type="button" class="btn btn-success btn-sm" onclick="exec();">テンプレートをLINEリッチメニューに登録</button>
		<button type="button" class="btn btn-success btn-sm" onclick="exec2();">画像を登録</button>
		<button type="button" class="btn btn-success btn-sm" onclick="exec3();">デフォルトとして登録</button>
		<button type="button" class="btn btn-info btn-sm" onclick="exec4();">LINEに登録しているリッチメニュー一覧を表示</button>
		<button type="button" class="btn btn-danger btn-sm" onclick="exec5();">リッチメニューIDで指定したリッチメニューを削除</button>
		
	</div>
	<div id="res" class="text-success"></div>
	<div id="err" class="text-danger"></div>
</div>



<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>LINEリッチメニューをCURLで送信設定するphpコード</li>
</ol>
</div><!-- content -->
<div id="footer">(C) amaraimusi 2023-12-2</div>
</body>
</html>