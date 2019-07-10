<?php require_once 'HtmlCreateTable.php';?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>2次元配列のソート</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script>

			$(document).ready(function(){

			});

		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">2次元配列のソート</h1>
		<div id="content" >

			<div class="sec1">

<?php
	$data=array(
		array(
			'id'=>3,
			'name'=>'オオヒラタクワガタ',
			'kind'=>'クワガタ',
			'date'=>'2012/12/12',
		),
		array(
				'id'=>2,
				'name'=>'リュウキュウカブト',
				'kind'=>'カブト',
				'date'=>'2012/12/15',
		),
		array(
				'id'=>1,
				'name'=>'タイワンカブト',
				'kind'=>'カブト',
				'date'=>'2012/12/2',
		),
		array(
				'id'=>5,
				'name'=>'ノコギリクワガタ',
				'kind'=>'クワガタ',
				'date'=>'2012/12/3',
		),
		array(
				'id'=>6,
				'name'=>'アカアシクワガタ',
				'kind'=>'クワガタ',
				'date'=>'2012/12/22',
		),
	);

	echo 'ソート前のデータ<br>';
	$keys=array('id','name','kind','date');
	$hct=new HtmlCreateTable();
	$html=$hct->createHtml1($data,$keys,"border='1'");
	echo $html;
	echo "<hr>\n";


	echo 'IDで昇順ソート<br>';
	$ids=array();
	foreach($data as $key=> $ent){
		$ids[$key]=$ent['id'];
	}
 	array_multisort($ids,SORT_ASC,$data);
	$html=$hct->createHtml1($data,$keys,"border='1'");
	echo $html;
	echo "<hr>\n";


	echo 'kindで降順ソート且つ、dateで昇順ソート<br>';
	$kinds=array();
	$dates=array();
	foreach($data as $key=> $ent){
		$kinds[$key]=$ent['kind'];
		$dates[$key]=$ent['date'];
	}
 	array_multisort($kinds,SORT_DESC,$dates,SORT_ASC,$data);
	$html=$hct->createHtml1($data,$keys,"border='1'");
	echo $html;
	echo "<hr>\n";
	//※注意 1番目の並び順をSORT_DESC,2番目の並び順をSORT_ASCにした場合、2番目の並び順は降順になる。


?>



			</div><!-- sec1 -->

		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/08/04</div>
		</div><!-- page1 -->
	</body>
</html>