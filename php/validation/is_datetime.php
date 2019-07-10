<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">

		<title>日時入力チェックのバリデーション</title>

	</head>

<body>

<h1>日時入力チェックのバリデーション</h1>

<table border="1">
<?php 
	
	
	testIsDatetimeEx('2012/12/12 12:34:56',true);
	testIsDatetimeEx('2012/12/12 12:34:60',true);
	testIsDatetimeEx('2012-12-12 12:34:59',true);
	testIsDatetimeEx('2012-2-29 12:34:59',true);
	testIsDatetimeEx('2015-2-29 12:34:59',true);
	testIsDatetimeEx('1800-01-01 00:00:00',true);
	testIsDatetimeEx('2999-01-01 00:00:00',true);
	testIsDatetimeEx('2999-01-01 23:59:59',true);
	testIsDatetimeEx('2000-12-31 23:59:59',true);
	testIsDatetimeEx('2000-12-31',true);
	testIsDatetimeEx('23:59:59',true);
 	testIsDatetimeEx(null,false);
 	testIsDatetimeEx(null,true);
 	testIsDatetimeEx('あいうえお',true);

	
	//日時入力チェックテストメソッド
	function testIsDatetimeEx($v,$reqFlg){
		
		$ret=isDatetime($v,$reqFlg);
		
		echo "<tr><td>{$v}</td><td>{$ret}</td></tr>";
	}

	/**
	 * 日時入力チェックのバリデーション
	 * ※日付のみあるいは時刻は異常と見なす。
	 * @param $strDateTime	日時文字列
	 * @param $reqFlg	必須許可フラグ
	 * @return boolean	true:正常　　　false:異常
	 */
	function isDatetime($strDateTime,$reqFlg){

		//空値且つ、必須入力がnullであれば、trueを返す。
		if(empty($strDateTime) && empty($reqFlg)){
			return true;
		}
		
		//空値且つ、必須入力がtrueであれば、falseを返す。
		if(empty($strDateTime) && !empty($reqFlg)){
			return false;
		}
	
	
		//日時を　年月日時分秒に分解する。
		$aryA =preg_split( '|[ /:_-]|', $strDateTime );
		if(count($aryA)!=6){
			return false;
		}
		
		foreach ($aryA as $key => $val){
				
			//▼正数以外が混じっているば、即座にfalseを返して処理終了
			if (!preg_match("/^[0-9]+$/", $val)) {
				return false;
			}
			
		}
		
		//▼グレゴリオ暦と整合正が取れてるかチェック。（閏年などはエラー） ※さくらサーバーではemptyでチェックするとバグになるので注意。×→if(empty(checkdate(12,11,2012))){・・・}
		if(checkdate($aryA[1],$aryA[2],$aryA[0])==false){
			return false;
		}

	
		//▼時刻の整合性をチェック
		if($aryA[3] < 0 || $aryA[3] > 23){
			return false;
		}
		if($aryA[4] < 0 ||  $aryA[4] > 59){
			return false;
		}
		if($aryA[5] < 0 || $aryA[5] > 59){
			return false;
		}
		
		return true;
	}
	

	
?>
</table>


<hr>
<pre>
	/**
	 * 日時入力チェックのバリデーション
	 * ※日付のみあるいは時刻は異常と見なす。
	 * @param $strDateTime	日時文字列
	 * @param $reqFlg	必須許可フラグ
	 * @return boolean	true:正常　　　false:異常
	 */
	function isDatetime($strDateTime,$reqFlg){

		//空値且つ、必須入力がnullであれば、trueを返す。
		if(empty($strDateTime) &amp;&amp; empty($reqFlg)){
			return true;
		}
		
		//空値且つ、必須入力がtrueであれば、falseを返す。
		if(empty($strDateTime) &amp;&amp; !empty($reqFlg)){
			return false;
		}
	
	
		//日時を　年月日時分秒に分解する。
		$aryA =preg_split( '|[ /:_-]|', $strDateTime );
		if(count($aryA)!=6){
			return false;
		}
		
		foreach ($aryA as $key =&gt $val){
				
			//▼正数以外が混じっているば、即座にfalseを返して処理終了
			if (!preg_match("/^[0-9]+$/", $val)) {
				return false;
			}
			
		}
		
		//▼グレゴリオ暦と整合正が取れてるかチェック。（閏年などはエラー） ※さくらサーバーではemptyでチェックするとバグになるので注意。×→if(empty(checkdate(12,11,2012))){・・・}
		if(empty(checkdate($aryA[1],$aryA[2],$aryA[0]))){
			return false;
		}
	
		//▼時刻の整合性をチェック
		if($aryA[3] &lt 0 || $aryA[3] &gt 23){
			return false;
		}
		if($aryA[4] &lt 0 ||  $aryA[4] &gt 59){
			return false;
		}
		if($aryA[5] &lt 0 || $aryA[5] &gt 59){
			return false;
		}
		
		return true;
	}
</pre>
<p style="font-size:0.8em;color:#bc99fd">(c)wacgance 2015-10-05</p>
</body>
</html>