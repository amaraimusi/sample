<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>期間を指定月間で分割</title>

		<link href="/sample/style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="/sample/style2/css/common2.css" rel="stylesheet">

		<script src="/sample/style2/js/jquery-1.11.1.min.js"></script>
		<script src="/sample/style2/js/bootstrap.min.js"></script>


		<style>

		</style>
	</head>

<body>
<div class="container">

	<div id="header" >
		<h1>期間を指定月間で分割</h1>
	</div>

	<h2>説明</h2>
	期間を指定した月数で分割し、日付リストとして返す。<br>
	<br>
	
	期間は開始日と終了日で指定する。<br>
	開始日に月末日を指定すると月がずれて分割されてしまう。<br>
	なので、開始日や終了日はなるべく第一日（月の初日）を指定する。<br>

	<h2>サンプル</h2>
	<pre>
	$first_date='2015-1-1';
	$end_date = date('Y-m-d');
	$month_range=4;
	$format='Y-m-d H:i:s';
	$res = <strong>splitByMonthRange</strong>($first_date,$end_date,$month_range,$format);
	echo var_dump($res);
	
	/**
	 * 期間を指定月間で分割
	 * 
	 * @param string/date $first_date 期間の開始日(月の第一日）
	 * @param string/date  $end_date 期間の終了日
	 * @param int  $month_range 指定月間
	 * @param string $format 返りデータの日付フォーマット（省略可、秒単位まで指定可）
	 * @return array 分割日付リスト
	 */
	function splitByMonthRange($first_date,$end_date,$month_range,$format='Y-m-d'){
		$start = new DateTime($first_date);
		$end = new DateTime($end_date);
		$interval = DateInterval::createFromDateString($month_range.' month');
		$period = new DatePeriod($start,$interval,$end);
		$dates = array();
		foreach($period as $d){
			$dates[] = $d-&gt;format($format);
		}
		return $dates;
	}
	</pre>
	<br>
	
	<p>出力</p>
<?php 

$first_date='2015-1-1';
$end_date = date('Y-m-d');
$month_range=4;
$format='Y-m-d H:i:s';
$res = splitByMonthRange($first_date,$end_date,$month_range,$format);
echo var_dump($res);




/**
 * 期間を指定月間で分割
 * 
 * @param string/date $first_date 期間の開始日(月の第一日）
 * @param string/date  $end_date 期間の終了日
 * @param int  $month_range 指定月間
 * @param string $format 返りデータの日付フォーマット（省略可、秒単位まで指定可）
 * @return array 分割日付リスト
 */
function splitByMonthRange($first_date,$end_date,$month_range,$format='Y-m-d'){
	$start = new DateTime($first_date);
	$end = new DateTime($end_date);
	$interval = DateInterval::createFromDateString($month_range.' month');
	$period = new DatePeriod($start,$interval,$end);
	$dates = array();
	foreach($period as $d){
		$dates[] = $d->format($format);
	}
	return $dates;
}
?>




	
	<a href="/" class="btn btn-link btn-xs">ホーム</a>


	<div id="footer"  >
		<a href="/">(c)wacgance</a> 2016-5-23 
	</div>
	

		


</div><!-- container  -->
</body>
</html>