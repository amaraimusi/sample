<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>期間月分割 | 開始日から終了日までの期間を月ごとに分割するアルゴリズム</title>

		<link href="../../style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../style2/css/common2.css" rel="stylesheet">

		<script src="../../style2/js/jquery-1.11.1.min.js"></script>
		<script src="../../style2/js/bootstrap.min.js"></script>


		<style>

			.result{
				font-size:0.8em;
				color:#133776;
			}
		</style>
	</head>

<body>
<div class="container">

	<div class="row">
		<div id="header" class="col-lg-12" >
			<h1>期間月分割 </h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">
		<h2>開始日から終了日までの期間を月ごとに分割するアルゴリズム</h2>


	<pre>
&lt?php
	$samples=array();

	//サンプル日付
	$samples[]=array('2012/12/25','2015/5/12');
	$samples[]=array('2012/12/12','2013/5/12');
	$samples[]=array('2012/5/12','2012/9/13');
	$samples[]=array('2012/11/12','2012/11/13');
	$samples[]=array('2012/11/12','2012/11/12');
	$samples[]=array('2012/12/12','2012/11/12');


	$interval=3;

	foreach($samples as $sample){

		$start=$sample[0];
		$end=$sample[1];
		$rs=termMonthSplit($start,$end,$interval);

		//結果出力
		output($rs,$start,$end,$interval);

	}

	//結果出力
	function output($rs,$start,$end,$interval){
		echo "&lthr&gt";
		echo "{$start}　～　{$end}　間隔：{$interval}月毎&ltbr&gt";

		if(empty($rs)){
		echo "&ltdiv class='result'&gtNull&lt/div&gt";
		}else{
		foreach($rs as $i=&gt $ent){
		echo "&ltdiv class='result'&gt{$i}:　　{$ent[0]}　～　{$ent[1]}&lt/div&gt";
		}


		}

	}

	/**
	 * 開始日から終了日までの期間を月ごとに分割する。
	 * 月間隔を指定するなら季節ごとの分割も再現できる。(1月を基準とし、月間隔値の倍数で分割）
	 * @param $start 開始日
	 * @param $end 終了日
	 * @param $interval 月間隔
	 * @return 期間分割リスト
	 */
	function termMonthSplit($start,$end,$interval){

		//Y-m-d形式にする。
		$start=date('Y-m-d',strtotime($start));
		$end=date('Y-m-d',strtotime($end));

		// 開始日を年月日に分割
		$start_y=date('Y', strtotime($start));
		$start_m=date('m', strtotime($start));


		// 終了日を年月日に分割
		$end_y=date('Y', strtotime($end));
		$end_m=date('m', strtotime($end));


		$m1=0;	// 月値1
		$m2=0;	// 月値2
		$list=array();
		// 開始年から終了年までの年ループ
		for($y=$start_y ; $y &lt= $end_y ; $y++){

			// 年ループは初周回であるか？
			if($y == $start_y){
				$m1 = $start_m; // 月ループの月値1に開始月をセット

			}else{
				$m1 = 1;	// 月ループの月値1に1をセット
			}

			// 年ループは最周回であるか？
			if($y == $end_y){
				$m2 = $end_m;// 月ループの月値2に終了月をセット

			}else{
				$m2 = 12; // 月ループの月値2に12
			}

			// 月ループ	月値1から月値2までループ
			for($m=$m1 ; $m &lt= $m2 ; $m++){


				// 年ループの初周回且つ、月ループの初周回であるか？
				if($y == $start_y && $m == $m1){
					$list[]=$start; // リストに開始日を追加
				}

				// 年ループの最周回且つ、月ループの最周回であるか？
				if($y == $end_y && $m == $m2 ){
					$list[]=$end;// リストに最終日を追加
				}

				// 月値は月間隔の倍数であるか？
				if(($m % $interval) == 0){

 					$str_ym1=$y.'-'.$m.'-1';

					// 月値の月末を取得し、リストに追加
					$yml = date('Y-m-t',strtotime($str_ym1));

 					$list[]=$yml;

					// 次月の月初を取得し、リストに追加
					if($m == 12){
						$str_ym2=($y + 1).'-1-1';
					}else{
						$str_ym2=$y.'-'.($m + 1).'-1';
					}
					$ym1=date('Y-m-d',strtotime($str_ym2));
					$list[]=$ym1;

				}

			}
		}

		$list2=array_chunk($list,2);//開始年と終了年のリストになるよう構造変換

		return $list2;
	}


?&gt
	</pre>

<h3>結果出力</h3>
<?php
	$samples=array();

	//サンプル日付
	$samples[]=array('2012/12/25','2015/5/12');
	$samples[]=array('2012/12/12','2013/5/12');
	$samples[]=array('2012/5/12','2012/9/13');
	$samples[]=array('2012/11/12','2012/11/13');
	$samples[]=array('2012/11/12','2012/11/12');
	$samples[]=array('2012/12/12','2012/11/12');


	$interval=3;

	foreach($samples as $sample){

		$start=$sample[0];
		$end=$sample[1];
		$rs=termMonthSplit($start,$end,$interval);

		//結果出力
		output($rs,$start,$end,$interval);

	}

	//結果出力
	function output($rs,$start,$end,$interval){
		echo "<hr>";
		echo "{$start}　～　{$end}　間隔：{$interval}月毎<br>";

		if(empty($rs)){
		echo "<div class='result'>Null</div>";
		}else{
		foreach($rs as $i=> $ent){
		echo "<div class='result'>{$i}:　　{$ent[0]}　～　{$ent[1]}</div>";
		}


		}

	}

	/**
	 * 開始日から終了日までの期間を月ごとに分割する。
	 * 月間隔を指定するなら季節ごとの分割も再現できる。(1月を基準とし、月間隔値の倍数で分割）
	 * @param $start 開始日
	 * @param $end 終了日
	 * @param $interval 月間隔
	 * @return 期間分割リスト
	 */
	function termMonthSplit($start,$end,$interval=1){

		//Y-m-d形式にする。
		$start=date('Y-m-d',strtotime($start));
		$end=date('Y-m-d',strtotime($end));

		// 開始日を年月日に分割
		$start_y=date('Y', strtotime($start));
		$start_m=date('m', strtotime($start));


		// 終了日を年月日に分割
		$end_y=date('Y', strtotime($end));
		$end_m=date('m', strtotime($end));


		$m1=0;	// 月値1
		$m2=0;	// 月値2
		$list=array();
		// 開始年から終了年までの年ループ
		for($y=$start_y ; $y <= $end_y ; $y++){

			// 年ループは初周回であるか？
			if($y == $start_y){
				$m1 = $start_m; // 月ループの月値1に開始月をセット

			}else{
				$m1 = 1;	// 月ループの月値1に1をセット
			}

			// 年ループは最周回であるか？
			if($y == $end_y){
				$m2 = $end_m;// 月ループの月値2に終了月をセット

			}else{
				$m2 = 12; // 月ループの月値2に12
			}

			// 月ループ	月値1から月値2までループ
			for($m=$m1 ; $m <= $m2 ; $m++){


				// 年ループの初周回且つ、月ループの初周回であるか？
				if($y == $start_y && $m == $m1){
					$list[]=$start; // リストに開始日を追加
				}

				// 年ループの最周回且つ、月ループの最周回であるか？
				if($y == $end_y && $m == $m2 ){
					$list[]=$end;// リストに最終日を追加
				}

				// 月値は月間隔の倍数であるか？
				if(($m % $interval) == 0){

 					$str_ym1=$y.'-'.$m.'-1';

					// 月値の月末を取得し、リストに追加
					$yml = date('Y-m-t',strtotime($str_ym1));

 					$list[]=$yml;

					// 次月の月初を取得し、リストに追加
					if($m == 12){
						$str_ym2=($y + 1).'-1-1';
					}else{
						$str_ym2=$y.'-'.($m + 1).'-1';
					}
					$ym1=date('Y-m-d',strtotime($str_ym2));
					$list[]=$ym1;

				}

			}
		}

		$list2=array_chunk($list,2);//開始年と終了年のリストになるよう構造変換

		return $list2;
	}







?>

	</div>






	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2014-11-05</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>