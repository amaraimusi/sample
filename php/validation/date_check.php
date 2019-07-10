
<?php
require_once 'input_check.php';
$list=array(
	'2012/1/1',
	'2012-12-31',
	'2012-2-29',
	'2011-2-29',
	'2012-8-32',
	null,
	'',
	'20120101',
	'2012/12/12 00:00:00',
	'2012/12/12 12:12:12',
	'2012/12/12 12:12',
	'2012/12/12 12',
);

$ic=new InputCheck();
$data=null;
foreach($list as $d){
	$ent['d']=$d;
	$ent['rs']=$ic->isDate($d);//★日付チェック
	$data[]=$ent;
}


?>


<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>日付チェック</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />

		<script>


		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">日付チェック</h1>
		<div id="content" >
				<div class="sec1">

					<table border=1>
						<thead><tr><th>日付文字</th><th>入力チェック結果</th></tr></thead>
						<tbody>
							<?php
								foreach($data as $ent){
									echo "<tr>";
									echo "<td>{$ent['d']}</td><td>{$ent['rs']}</td>";
									echo "</tr>\n";
								}
							?>
						</tbody>
					</table>
<br />
<hr />
<strong>サンプル</strong><br />
<pre>
	require_once 'input_check.php';
	$list=array(
		'2012/1/1',
		'2012-12-31',
		'2012-2-29',
		'2011-2-29',
		'2012-8-32',
		null,
		'',
		'20120101',
		'2012/12/12 00:00:00',
		'2012/12/12 12:12:12',
		'2012/12/12 12:12',
		'2012/12/12 12',
	);

	$ic=new InputCheck();
	$data=null;
	foreach($list as $d){
		$ent['d']=$d;
		$ent['rs']=$ic->isDate($d);//★日付チェック
		$data[]=$ent;
	}

</pre>
<strong>input_check.php</strong><br />
<pre>

class InputCheck{





	/**
	 * 日時チェック 閏年対応
	 * @param  $strDate　日付文字列
	 * @return boolean　可否
	 */
	function isDate($strDateTime){


		//トリミング
		$strDateTime=trim($strDateTime);

		//空であればエラー
		if (!$strDateTime){return false;}


		//日時を　年月日時分秒に分解する。
		$aryA =preg_split( '|[ /:_-]|', $strDateTime );
		foreach ($aryA as $key => $val){

			//▼正数以外が混じっているば、即座にfalseを返して処理終了
			if ($this->isPNum($val)==false){
				return false;
			}
			$aryA[$key]=trim($val);
		}

		//▼グレゴリオ暦と整合正が取れてるかチェック。（閏年などはエラー）
		if(!checkdate($aryA[1],$aryA[2],$aryA[0])){
			return false;
		}


		//▼時刻の整合性をチェック
		if ($this->checkTime($aryA[3], $aryA[4], $aryA[5])==false){
			return false;
		}

		return true;


	}



	/**
	 * 時刻の整合性をチェック
	 * @param  $hou　時
	 * @param  $min　分
	 * @param  $sec　秒
	 * @return boolean　可否
	 */
	function checkTime($hou,$min,$sec){


		if($hou < 0 || $hou > 23){

			return false;
		}
		if($min < 0 || $min > 59){

			return false;
		}
		if($sec < 0 || $sec > 59){

			return false;
		}

		return true;
	}
}

</pre>
				</div><!-- sec1 -->
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/05/16</div>
		</div><!-- page1 -->
	</body>
</html>