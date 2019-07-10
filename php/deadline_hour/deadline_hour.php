<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>指定日時が締切になっているか判定する関数</title>

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
			<h1>指定日時が締切になっているか判定する関数</h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">
		<h2>説明</h2>
		指定日時が締切になっているか判定する。<br>
		締切情報は締切日と締切前時間。<br>

		<hr>
		<h2>ソースコード</h2>
		<pre>
	//▽サンプルデータ
	$deadline_date = '2015-2-10';	//締切日
	$deadline_hour = 5;				//締切時間
	//$now='2015-02-09 19:00:00';		//現在日時のサンプル
	$now='2015-02-09 18:59:59';		//現在日時のサンプル


	$flg=checkDeadline($deadline_date,$deadline_hour,$now);

	if($flg){
		echo "間に合います&ltbr>";

	}else{
		echo "締切になりました&ltbr>";
	}

	/**
	 * 指定日時が締切になっているか判定する。
	 * 締切情報は締切日と締切前時間。
	 * @param $deadline_date	締切日
	 * @param $deadline_hour	締切前時間
	 * @param $now	現在の日時。もしくは確かめる日時
	 * @return boolean true:間に合います   false:締切です。
	 */
	function checkDeadline($deadline_date,$deadline_hour,$now){

		//UNIX締切時間
		$u_deadline_date = strtotime($deadline_date.' 00:00:00');

		//UNIX現在日時を取得
		$u_now = strtotime($now);

		//UNIX締切時間を算出
		$u_deadline_hour = $deadline_hour * 3600;

		//UNIX締切日時を算出
		$u_deadline_dt=$u_deadline_date - $u_deadline_hour;

		if($u_now < $u_deadline_dt){
			return true;
		}else{
			return false;
		}
	}

		</pre>


		<br><br>▽出力<br><br>
<?php

//▽サンプルデータ
$deadline_date = '2015-2-10';	//締切日
$deadline_hour = 5;				//締切時間
//$now='2015-02-09 19:00:00';		//現在日時のサンプル
$now='2015-02-09 18:59:59';		//現在日時のサンプル


$flg=checkDeadline($deadline_date,$deadline_hour,$now);

if($flg){
	echo "間に合います<br>";
	//strtotime('+1days');

}else{
	echo "締切になりました<br>";
}



// //▽サンプルデータ
// //$rsv_date = '2015-2-11';	//締切日
// $deadline_hour =71;				//締切時間

// $limitDate=getDeadlineDate($deadline_hour);

// //echo '$rsv_date＝'.$rsv_date.'<br>';//■■■□□□■■■□□□■■■□□□
// echo '$deadline_hour＝'.$deadline_hour.'<br>';//■■■□□□■■■□□□■■■□□□
// echo '$limitDate＝'.$limitDate.'<br>';//■■■□□□■■■□□□■■■□□□







function getDeadlineDate($deadline_hour){


	if(empty($deadline_hour)){
		$deadline_hour = 0;
	}

	//現在日時を取得
	$now=date('Y-m-d H:i:s');



	// 締切時間から締切日数を算出
	$d_cnt=floor($deadline_hour / 24);

	echo '$d_cnt＝'.$d_cnt.'<br>';//■■■□□□■■■□□□■■■□□□

	// 締切時間から締切時間2を算出
	$hour2=$deadline_hour % 24;

	echo '$hour2＝'.$hour2.'<br>';//■■■□□□■■■□□□■■■□□□


	// 現在日から翌日0時を基準日として取得
	$base_date = date("Y-m-d", strtotime($now." 1 day"  ));

	echo '$base_date＝'.$base_date.'<br>';//■■■□□□■■■□□□■■■□□□

	// 基準日に日数を加算
	if($d_cnt > 0){

		$base_date = date("Y-m-d", strtotime($base_date." ".$d_cnt." day"  ));
	}

	echo '$base_date2＝'.$base_date.'<br>';//■■■□□□■■■□□□■■■□□□

	//UNIX基準日
	$u_base_date=strtotime($base_date);

	//UNIX締切時間2
	$u_hour2 = $hour2 * 3600;


	// 基準日から締切時間2を減算して締切日時を取得
	$u_deadline_dt = $u_base_date - $u_hour2;


	echo '現在日時＝'.$now.'<br>';//■■■□□□■■■□□□■■■□□□
	echo '締切日時＝'.date('Y-m-d H:i:s',$u_deadline_dt).'<br>';//■■■□□□■■■□□□■■■□□□


	// 締切日時の時間部分だけ締切時刻として取得
	$deadline_time = date('H:i:s',$u_deadline_dt);

	echo '$deadline_time＝'.$deadline_time.'<br>';//■■■□□□■■■□□□■■■□□□

	// 現在時刻を取得
	$now_time=date('H:i:s');


	echo '$now_time＝'.$now_time.'<br>';//■■■□□□■■■□□□■■■□□□

	// 締切時刻 <= 現在時刻
	if(strtotime($deadline_time) <= strtotime($now_time) && $deadline_hour > 0){

		// 	基準日に1日加算
		$base_date = date("Y-m-d", strtotime($base_date." 1 day"  ));
	}

	// 基準日をリミット日付として返す。
	return $base_date;
}




// }

/**
 * 指定日時が締切になっているか判定する。
 * 締切情報は締切日と締切前時間。
 * @param $deadline_date	締切日
 * @param $deadline_hour	締切前時間
 * @param $now	現在の日時。もしくは確かめる日時
 * @return boolean true:間に合います   false:締切です。
 */
function checkDeadline($deadline_date,$deadline_hour,$now){

	//UNIX締切時間
	$u_deadline_date = strtotime($deadline_date.' 00:00:00');

	//UNIX現在日時を取得
	$u_now = strtotime($now);

	//UNIX締切時間を算出
	$u_deadline_hour = $deadline_hour * 3600;

	//UNIX締切日時を算出
	$u_deadline_dt=$u_deadline_date - $u_deadline_hour;

	if($u_now < $u_deadline_dt){
		return true;
	}else{
		return false;
	}
}






function getDeadlineDate2($rsv_date,$deadline_hour){

	//UNIX予約日
	$u_rsv_date = strtotime($rsv_date.' 00:00:00');

	//UNIX締切時間を算出
	$u_deadline_hour = $deadline_hour * 3600;

	//UNIX締切日時を算出
	$u_deadline_dt=$u_rsv_date - $u_deadline_hour;

	//締切日を取得
	$deadline_date =  date("Y-m-d",$u_deadline_dt);


	echo '締切日時＝'.date("Y-m-d H:i:s",$u_deadline_dt).'<br>';//■■■□□□■■■□□□■■■□□□
	//echo '$deadline_date＝'.$deadline_date.'<br>';//■■■□□□■■■□□□■■■□□□

	//UNIX現在日時を取得
	$now=date('Y-m-d H:i:s');
	$u_now = strtotime($now);

	echo '現在日時＝'.$now.'<br>';//■■■□□□■■■□□□■■■□□□

	if($u_now < $u_deadline_dt){
		$deadline_date = date("Y-m-d", strtotime($deadline_date." 1 day"  ));

	}else{
		$deadline_date = date("Y-m-d", strtotime($deadline_date." 2 day"  ));
	}

	return $deadline_date;
}


//現在日時から明日日時（0時）を取得

//UNIX明日0時

//UNIX締切日時＝UNIX明日0時 - UNIX締切時間

//UNIX現在日時がUNIX締切日時を超える場合。
//締切日付に明後日をセット
//Else
//締切日に明日をセット


function debug(&$v){
	echo strval($v).' = '.$v.'<br>'."\n";
}
?>

		<hr>
	</div>






	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2015-02-10</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>