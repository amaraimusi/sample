<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>時刻（時分）の入力チェック</title>

		<link href="../../style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../style2/css/common2.css" rel="stylesheet">


		<script src="../../style2/js/jquery-1.11.1.min.js"></script>
		<script src="../../style2/js/bootstrap.min.js"></script>


		<style>
			.rs1{
				color:#7f007f;
			}
			.rs2{
				color:#143a7b;
			}
			.rs3{
				color:#e7443d;
			}
			.rs3_false{
				color:#646464;
			}
		</style>
	</head>

<body>
<div class="container">

	<div class="row">
		<div id="header" class="col-lg-12" >
			<h1>時刻（時分）の入力チェック</h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">
		<h2>ソースコード</h2>
<pre>
&lt?php

	$data[]='0:00';
	$data[]='00:00';
	$data[]='1:1';
	$data[]='0:59';
	$data[]='1:00';
	$data[]='9:59';
	$data[]='10:10';
	$data[]='13:10';
	$data[]='23:59';
	$data[]='08:08';
	$data[]='';
	$data[]=' ';
	$data[]=null;
	$data[]=' 8:5 ';
	$data[]=' 8 : 12 ';
	$data[]='12:12:12';
	$data[]='1234';
	$data[]='abc';
	$data[]='1：5';
	$data[]='2012/12/12 5:5';
	$data[]='9';
	$data[]='24:00';
	$data[]='0:60';
	$data[]='0.1:0.2';



	foreach($data as $i =&gt $v){
		$rs=is_time_hi($v);
		if($rs==true){
			echo "&ltspan class='rs1'&gt{$i}&lt/span&gt:&ltspan class='rs2'&gt{$v}&lt/span&gt:&ltspan class='rs3'&gttrue&lt/span&gt&ltbr&gt";
		}else{
			echo "&ltspan class='rs1'&gt{$i}&lt/span&gt:&ltspan class='rs2'&gt{$v}&lt/span&gt:&ltspan class='rs3_false'&gtfalse&lt/span&gt&ltbr&gt";
		}
	}

	//時分チェック（h:i形式）
	function is_time_hi($v){

		$v=trim($v);


		if(empty($v)){
			return true;
		}


		$ary=explode(':',$v);

		if(count($ary) != 2){
			return false;
		}

		$h=trim($ary[0]);
		$m=trim($ary[1]);

		if(!preg_match('/^[0-9]+$/', $h)){
			return false;
		}

		if(!preg_match('/^[0-9]+$/', $m)){
			return false;
		}

		if($h &lt 0 || $h &gt 23){
			return false;
		}

		if($m &lt 0 || $m &gt 59){
			return false;
		}

		return true;
	}
?&gt
</pre>

		<hr>
		<h4>実行結果</h4>


<?php

	$data[]='0:00';
	$data[]='00:00';
	$data[]='1:1';
	$data[]='0:59';
	$data[]='1:00';
	$data[]='9:59';
	$data[]='10:10';
	$data[]='13:10';
	$data[]='23:59';
	$data[]='08:08';
	$data[]='';
	$data[]=' ';
	$data[]=null;
	$data[]=' 8:5 ';
	$data[]=' 8 : 12 ';
	$data[]='12:12:12';
	$data[]='1234';
	$data[]='abc';
	$data[]='1：5';
	$data[]='2012/12/12 5:5';
	$data[]='9';
	$data[]='24:00';
	$data[]='0:60';
	$data[]='0.1:0.2';



	foreach($data as $i => $v){
		$rs=is_time_hi($v);
		if($rs==true){
			echo "<span class='rs1'>{$i}</span>:<span class='rs2'>{$v}</span>:<span class='rs3'>true</span><br>";
		}else{
			echo "<span class='rs1'>{$i}</span>:<span class='rs2'>{$v}</span>:<span class='rs3_false'>false</span><br>";
		}
	}

	//時分チェック（h:i形式）
	function is_time_hi($v){

		$v=trim($v);


		if(empty($v)){
			return true;
		}


		$ary=explode(':',$v);

		if(count($ary) != 2){
			return false;
		}

		$h=trim($ary[0]);
		$m=trim($ary[1]);

		if(!preg_match('/^[0-9]+$/', $h)){
			return false;
		}

		if(!preg_match('/^[0-9]+$/', $m)){
			return false;
		}

		if($h < 0 || $h > 23){
			return false;
		}

		if($m < 0 || $m > 59){
			return false;
		}

		return true;
	}
?>
	</div>



	<br><br>
	<a href="http://amaraimusi.sakura.ne.jp/" class="btn btn-link btn-xs">参考サイト</a>
	<br><br>

	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2014-11-05</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>