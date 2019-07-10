<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ツリー構造データ</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>

</head>
<body>
<div id="header" ><h1>ツリー構造データ</h1></div>
<div class="container">












<h2>デモ</h2>
<?php 
$data = [
		['id'=>1,'name'=>'ネコ','par_id'=>6],
		['id'=>2,'name'=>'生物','par_id'=>0],
		['id'=>3,'name'=>'動物','par_id'=>2],
		['id'=>4,'name'=>'脊椎動物','par_id'=>3],
		['id'=>5,'name'=>'無脊椎動物','par_id'=>3],
		['id'=>6,'name'=>'哺乳類','par_id'=>4],
		['id'=>7,'name'=>'爬虫類','par_id'=>4],
		['id'=>8,'name'=>'魚類','par_id'=>4],
		['id'=>9,'name'=>'昆虫','par_id'=>4],
		['id'=>10,'name'=>'ムカデ','par_id'=>5],
		['id'=>11,'name'=>'カマキリ','par_id'=>9],
		['id'=>12,'name'=>'UMA','par_id'=>2],
		['id'=>13,'name'=>'カッパ','par_id'=>12],
		['id'=>14,'name'=>'ライオン','par_id'=>6],
		['id'=>15,'name'=>'イグアナ','par_id'=>7],
		['id'=>16,'name'=>'植物','par_id'=>2],
		['id'=>17,'name'=>'ダイコン','par_id'=>16],
		['id'=>18,'name'=>'キャベツ','par_id'=>16],
		['id'=>19,'name'=>'テラピア','par_id'=>8],
		['id'=>20,'name'=>'ガーラ','par_id'=>8],
		['id'=>21,'name'=>'カブトムシ','par_id'=>9],
		['id'=>22,'name'=>'タイワンカブト','par_id'=>21],
		['id'=>23,'name'=>'ヘラクレス','par_id'=>21],
		['id'=>24,'name'=>'ブタ','par_id'=>6],
];

require_once 'TreeStructureData.php';
$treeStructureData = new TreeStructureData();

$option = array(
		'res_structure'=>'normal,html_table',
		'sort_field'=>'name',
		'html_tbl_class' => 'tbl2',
		'html_tbl_fields' => array('id','name'),
);
// 子ノードリストをセットする
$res = $treeStructureData->tree($data,$option);

echo $res['html_table'];
debug($res['normal']);



function debug($var){
	echo '<pre>';
	var_dump($var);
	echo '</pre>';
}
?>










<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>ツリー構造データ</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-4-17</div>
</body>
</html>