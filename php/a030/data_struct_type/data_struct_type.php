<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>データ構造タイプを取得(0:空 , 1:プリミティブ型 ,2:エンティティ型 , 3:データ型) | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>
</head>
<body>
<div id="header" ><h1>データ構造タイプを取得(0:空 , 1:プリミティブ型 ,2:エンティティ型 , 3:データ型) | ワクガンス</h1></div>
<div class="container">




<h2>サンプル</h2>
<pre>
&lt;?php 
$data1 = null;
$data2 = 'cat';
$data3 = ['cat','dog'];
$data4 = [
		['name'=&gt;'cat','wamei'=&gt;'ネコ'],
		['name'=&gt;'dog','wamei'=&gt;'イヌ'],
		];
$data5 = array();
$data6 = 0;

$d_struct_type = getDataStructureType($data1);
echo '$data1 → ' . $d_struct_type . '&lt;br&gt;';

$d_struct_type = getDataStructureType($data2);
echo '$data2 → ' . $d_struct_type . '&lt;br&gt;';

$d_struct_type = getDataStructureType($data3);
echo '$data3 → ' . $d_struct_type . '&lt;br&gt;';

$d_struct_type = getDataStructureType($data4);
echo '$data4 → ' . $d_struct_type . '&lt;br&gt;';

$d_struct_type = getDataStructureType($data5);
echo '$data5 → ' . $d_struct_type . '&lt;br&gt;';

$d_struct_type = getDataStructureType($data6);
echo '$data6 → ' . $d_struct_type . '&lt;br&gt;';


/**
 * データ構造タイプを取得する。
 * 
 * @note
 * データ構造タイプは4種類(0:空 , 1:プリミティブ型 ,2:エンティティ型 , 3:データ型)
 * 
 * @param $value
 * @return int データ構造タイプ
 */
function getDataStructureType($data){
	if($data === null) return 0; // 空
	
	if(is_array($data)){
		if(count($data) == 0){
			return 2; // エンティティ型
		}else{
			$first = reset($data); // $first→猫
			if(is_array($first)){
				return 3; // データ型
			}else{
				return 2; // エンティティ型
			}
		}
	}
	return 1; // プリミティブ型
	
}
?&gt;
</pre>
<p>出力</p>
<?php 
$data1 = null;
$data2 = 'cat';
$data3 = ['cat','dog'];
$data4 = [
		['name'=>'cat','wamei'=>'ネコ'],
		['name'=>'dog','wamei'=>'イヌ'],
		];
$data5 = array();
$data6 = 0;

$d_struct_type = getDataStructureType($data1);
echo '$data1 → ' . $d_struct_type . '<br>';

$d_struct_type = getDataStructureType($data2);
echo '$data2 → ' . $d_struct_type . '<br>';

$d_struct_type = getDataStructureType($data3);
echo '$data3 → ' . $d_struct_type . '<br>';

$d_struct_type = getDataStructureType($data4);
echo '$data4 → ' . $d_struct_type . '<br>';

$d_struct_type = getDataStructureType($data5);
echo '$data5 → ' . $d_struct_type . '<br>';

$d_struct_type = getDataStructureType($data6);
echo '$data6 → ' . $d_struct_type . '<br>';


/**
 * データ構造タイプを取得する。
 * 
 * @note
 * データ構造タイプは4種類(0:空 , 1:プリミティブ型 ,2:エンティティ型 , 3:データ型)
 * 
 * @param $value
 * @return int データ構造タイプ
 */
function getDataStructureType($data){
	if($data === null) return 0; // 空
	
	if(is_array($data)){
		if(count($data) == 0){
			return 2; // エンティティ型
		}else{
			$first = reset($data); // $first→猫
			if(is_array($first)){
				return 3; // データ型
			}else{
				return 2; // エンティティ型
			}
		}
	}
	return 1; // プリミティブ型
	
}
?>



<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>データ構造タイプを取得(0:空 , 1:プリミティブ型 ,2:エンティティ型 , 3:データ型)</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-7-5</div>
</body>
</html>