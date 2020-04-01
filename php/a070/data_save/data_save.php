<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>データ保存 | save | saveAll | ワクガンス</title>
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
<div id="header" ><h1>データ保存 | save | saveAll | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<?php 

$data = [
	['id'=>'1', 'kani_val'=>'1', 'kani_name'=>'大猫', 'kani_date'=>'2014-04-01', 'kani_group'=>'2', 'kani_dt'=>'2014-12-12 00:00:00', 'note'=>'', 'delete_flg'=>'0', 'update_user'=>'test', 'ip_addr'=>'::1', 'created'=>'2012-12-12'],
	['id'=>2, 'kani_val'=>'99', 'kani_name'=>'kani', 'kani_date'=>'', 'dummy'=>'エラー'],
	['id'=>'4', 'kani_val'=>'4', 'kani_name'=>'buta', 'kani_date'=>'2014-04-04', 'kani_group'=>'2', 'kani_dt'=>'2014-12-12 00:00:03', 'note'=>'AA\r\nBBB\r\n<input />', 'delete_flg'=>'0', 'update_user'=>'kani'],
	['id'=>'', 'kani_val'=>'3', 'kani_name'=>'ニューレコード', 'kani_date'=>'2015-09-17', 'kani_group'=>'2', 'kani_dt'=>'2014-12-12 00:00:02', 'note'=>'', 'delete_flg'=>'0', 'update_user'=>'kani', 'ip_addr'=>'::1', 'created'=>'2012-12-13', 'modified'=>'2012-12-14'],
];



// require_once 'SaveData.php';
// $saveData = new SaveData();

// // データDB登録テスト
// $res = $saveData->saveAll('kanis', $data);
// debug($res['rData']);
// debug($res['err_msg']);

// // エンティティDB登録テスト
// $ent = $data[3];
// $res = $saveData->save('kanis', $ent);
// debug($res['rEnt']);
// debug($res['err_msg']);

// // 行削除テスト
// $saveData->delete('kanis', 20);


// function debug($value){
// 	echo '<pre>';
// 	var_dump($value);
// 	echo '</pre>';
// }

?>

<pre><code>
$data = [
	['id'=&gt;'1', 'kani_val'=&gt;'1', 'kani_name'=&gt;'大猫', 'kani_date'=&gt;'2014-04-01', 'kani_group'=&gt;'2', 'kani_dt'=&gt;'2014-12-12 00:00:00', 'note'=&gt;'', 'delete_flg'=&gt;'0', 'update_user'=&gt;'test', 'ip_addr'=&gt;'::1', 'created'=&gt;'2012-12-12'],
	['id'=&gt;2, 'kani_val'=&gt;'99', 'kani_name'=&gt;'kani', 'kani_date'=&gt;'', 'dummy'=&gt;'エラー'],
	['id'=&gt;'4', 'kani_val'=&gt;'4', 'kani_name'=&gt;'buta', 'kani_date'=&gt;'2014-04-04', 'kani_group'=&gt;'2', 'kani_dt'=&gt;'2014-12-12 00:00:03', 'note'=&gt;'AA&yen;r&yen;nBBB&yen;r&yen;n&lt;input /&gt;', 'delete_flg'=&gt;'0', 'update_user'=&gt;'kani'],
	['id'=&gt;'', 'kani_val'=&gt;'3', 'kani_name'=&gt;'ニューレコード', 'kani_date'=&gt;'2015-09-17', 'kani_group'=&gt;'2', 'kani_dt'=&gt;'2014-12-12 00:00:02', 'note'=&gt;'', 'delete_flg'=&gt;'0', 'update_user'=&gt;'kani', 'ip_addr'=&gt;'::1', 'created'=&gt;'2012-12-13', 'modified'=&gt;'2012-12-14'],
];



require_once 'SaveData.php';
$saveData = new SaveData();

// データDB登録テスト
$res = $saveData-&gt;saveAll('kanis', $data);
debug($res['rData']);
debug($res['err_msg']);

// エンティティDB登録テスト
$ent = $data[3];
$res = $saveData-&gt;save('kanis', $ent);
debug($res['rEnt']);
debug($res['err_msg']);

// 行削除テスト
$saveData-&gt;delete('kanis', 20);


function debug($value){
	echo '&lt;pre&gt;';
	var_dump($value);
	echo '&lt;/pre&gt;';
}
</code></pre>


<br>
<a href="data_info_tool.php">DB情報ツール(開発用ためオンラインでは仕様できません)</a><br>


<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>データ保存 | save | saveAll</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2020-3-31</div>
</body>
</html>