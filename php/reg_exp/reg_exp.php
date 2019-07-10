<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>正規表現</title>

		<link href="../../style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../style2/css/common2.css" rel="stylesheet">

		<script src="../../style2/js/jquery-1.11.1.min.js"></script>
		<script src="../../style2/js/bootstrap.min.js"></script>


		<style>

		</style>
	</head>

<body>
<div class="container">


	<div class="row">
		<div id="header" class="col-lg-12" >
			<h1>正規表現</h1>
			<p></p>
		</div>
	</div>


	<div class="sec3">
		<h2>検証</h2>
		<a href="http://php.net/manual/ja/function.preg-match.php">preg_match</a>
		関数に様々な正規表現を指定して、それぞれの一致を検証する。<br>
		<br>
<?php 
	$str = "あいうえお9aabbc123";
	echo "<pre>{$str}</pre>";
?>
		<table class="tbl2">
			<thead><tr><th>x:正規表現</th><th>一致</th><th>説明</th></tr></thead>
			<tbody>
<?php 

	$data = [
			['reg_exp'=>'あ','note'=>'「あ」が文字列中に含まれているか'],
			['reg_exp'=>'い','note'=>'「い」が文字列中に含まれているか'],
			['reg_exp'=>'12','note'=>'「12」が文字列中に含まれているか'],
			['reg_exp'=>'^あ','note'=>'先頭は「あ」であるか'],
			['reg_exp'=>'^い','note'=>'先頭は「い」であるか'],
			['reg_exp'=>'3$','note'=>'末尾は「3」であるか'],
			['reg_exp'=>'2$','note'=>'末尾は「2」であるか'],
			['reg_exp'=>'\\d[1]$','note'=>'末尾は数値か（1連続)'],
			['reg_exp'=>'\\d[2]$','note'=>'末尾は2連続の数値か'],
			['reg_exp'=>'\\d[3]$','note'=>'末尾は3連続の数値か'],
			['reg_exp'=>'\\d[4]$','note'=>'末尾は4連続の数値か'],
			['reg_exp'=>'\\d[1,2]$','note'=>'末尾の1-2番目に数値が含まれているか'],
			['reg_exp'=>'\\d[1,3]$','note'=>'末尾の1-3番目に数値が含まれているか'],
			['reg_exp'=>'\\d[1,4]$','note'=>'末尾の1-4番目に数値が含まれているか'],
			['reg_exp'=>'^\\d[1,4]','note'=>'先頭の1-4番目に数値が含まれているか'],
			['reg_exp'=>'a[2]','note'=>'「aa」が含まれているか'],
			['reg_exp'=>'a[3]','note'=>'「aaa」が含まれているか'],
			['reg_exp'=>'\\w','note'=>'「A-Za-z0-9_」が含まれているか'],
			['reg_exp'=>'^\\d+$','note'=>'すべて数値か'],
			['reg_exp'=>'^\\w+$','note'=>'すべて半角英数字か'],
			['reg_exp'=>'^[ぁ-んァ-ン]+\\w+$','note'=>'前半はかな（カタカナも含む）で後半は半角英数字であるか'],
			['reg_exp'=>'(^あい)(.*)(23$)','note'=>'「あい」と「23」で挟まれているか？'],
				
	];
	

	
	foreach ($data as $ent){
		
		$reg_exp = "/".$ent['reg_exp']."/";
		$note = $ent['note'];
		
		$res="×";
		if( preg_match($reg_exp, $str)){
			$res = "○";
		}
		
		echo "<tr><td>{$reg_exp}</td><td>{$res}</td><td>{$note}</td></tr>";
	}

	
?>
			</tbody>
		</table>

	</div>

	<hr>

	<div class="sec3">
		<h2>検証2</h2>


		<table class="tbl2">
<?php 

	$reg_exp1 = "/^insert\s/i";
	$reg_exp2 = "/;$/";
	$reg_exp3 = "/(^INSERT\s)(.*)(;$)/i";
	
	echo "<thead><tr><th>文字列</th><th>{$reg_exp1}</th><th>{$reg_exp2}</th><th>{$reg_exp3}</th></tr></thead><tbody>";
			

	
	$data2[] = "INSERT id,name,val (111,'test',9);";
	$data2[] = "INSERT id,name,val (111,'test',9)";
	$data2[] = "(222,'test',9);";
	
	foreach ($data2 as $str){
		
		$res1="×";
		$res2="×";
		$res3="×";
		if( preg_match($reg_exp1, $str)){
			$res1 = "○";
		}
		if( preg_match($reg_exp2, $str)){
			$res2 = "○";
		}
		if( preg_match($reg_exp3, $str)){
			$res3 = "○";
		}
		
		echo "<tr><td>{$str}</td><td>{$res1}</td><td>{$res2}</td><td>{$res3}</td></tr>";
	}
	
	
?>
			</tbody>
		</table>
	</div>
	<hr>

	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2016-4-4</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>