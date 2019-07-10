<?php
require_once 'calc_string.php';
define(YEAR, 0);
define(MONTH, 1);
define(DAY, 2);
define(HOUR, 3);
define(MINUTS, 4);
define(SECONDS, 5);
/**
 * 日付計算メソッド群
 * @author uehara
 * @date 2010/10/22
 */
class CalcDate{
	
	public static function getInstance(){
		
		
		if(!$_REQUEST['CalcDate']){
			$obj=new CalcDate();
			$_REQUEST['CalcDate']=$obj;
		}else{
			$obj=$_REQUEST['CalcDate'];
		}
		
		return $obj;

	}
	
	/**
	 * 日付から時刻部分を削除する。
	 * @param  $ent
	 * @return Ambigous <string, 対象文字列>
	 */
	public function deleteTime($d){
		
		$cs=CalcString::getInstance();
		$d=$cs->stringLeft($d, ' ');

		return $d;
	}
	
	/**
	 * ２つの日付を比較する。日付１が大きければ、＋の値を、同値なら０、小さければ負値を返す。
	 * ※日数差ではないので注意
	 * @param  $strDate1　日付１
	 * @param  $strDate2　日付２
	 * @return 比較結果
	 */
	function  diffDay($strDate1,$strDate2){
		$dtTm1 = new DateTime($strDate1);
		$dtTm2 = new DateTime($strDate2);
		$d1 =$dtTm1->format('Ymd');
		$d2 =$dtTm2->format('Ymd');
		$d0=$d1-$d2;
		return $d0;
		
		//$dtTm1->
		
	}
	
	/**
	 * 日時文字列を配列に分解する。
	 * @param unknown_type $strDateTime
	 * @return multitype:
	 */
	function getDate2($strDateTime){
		$aryA =preg_split( '|[ /:_-]|', $strDateTime );
		return $aryA;
	}
	
	/**
	 * 入力日付を入力日付の最終時間を付加します。（例：入力 2010/10/19→2010/10/19 23:59:59）
	 * @param 日時 $dte
	 * @return 最終時間が付加された日時
	 */
	function calcLastDateTime($dte){
		if(!$dte){
			return null;
		}

		$ary=$this->getDate2($dte);
		$y=$ary[YEAR];
		$m=$ary[MONTH];
		$d=$ary[DAY];
		$h=23;
		$min=59;
		$sec=59;

		return ($y.'-'.$m.'-'.$d.' '.$h.':'.$min.':'.$sec);
		
	}
	
	/**
	 * 入力日付を入力日付の初期時間を付加します。（例：入力 2010/10/19→2010/10/19 00:00:00）
	 * @param 日時 $dte
	 * @return 初期時間が付加された日時
	 */
	function calcFirstDateTime($dte){
		if(!$dte){
			return null;
		}
		
		$ary=$this->getDate2($dte);
		$y=$ary[YEAR];
		$m=$ary[MONTH];
		$d=$ary[DAY];
		$h=00;
		$min=00;
		$sec=00;
		return ($y.'-'.$m.'-'.$d.' '.$h.':'.$min.':'.$sec);
	}
	

	/**
	 * 本日初期時を返す。
	 * @return 本日初期時
	 */
	function calcTodayFirstDateTime(){
		//現在日時を取得する。
		$today=date_format(date_create('now'), "Y-m-d");
		
		//本日最初時間を算出する。
		$today=$this->calcFirstDateTime($today);
		
		return $today;
	}
	
	/**
	 * 本日最後時間日時を返す。
	 * @return 本日最後時間日時
	 */
	function calcTodayLastDateTime(){
		//現在日時を取得する。
		$today=date_format(date_create('now'), "Y-m-d");
		
		//本日最後時間日時を算出する。
		$today=$this->calcLastDateTime($today);
		
		return $today;
	}

	
	/**
	 * 今月末日 日時を取得する。
	 * @param 時　省略した場合は23 $h
	 * @param 日　省略した場合は59 $min
	 * @param 分　省略した場合は59 $sec
	 * @return 今月の最終日最終時間。（例：2010/10/31 23:59:59）
	 */
	public function calcThisMonthLastDate($h=23,$min=59,$sec=59){
		$ts = mktime($h, $min, $sec, date("m")+1, 0, date("Y"));
		return date('Y-m-d H:i:s', $ts);
		
		$d=date_format();
	}


	
	/**
	 * 月末日 日時を取得する。
	 * @param 日付 $dte
	 * @param 時　省略した場合は23 $h
	 * @param 日　省略した場合は59 $min
	 * @param 分　省略した場合は59 $sec
	 * @return 指定した日付の最終日最終時間。（例：2010/10/31 23:59:59）
	 */
	public function calcMonthLastDate($dte,$h=23,$min=59,$sec=59){
		$ts = mktime($h, $min, $sec, date("m",$dte)+1, 0, date("Y",$dte));
		return date('Y-m-d H:i:s', $ts);
	}
	
	
	/**
	 * 今月始め日付を取得する。
	 * @param 時　省略した場合は00 $h
	 * @param 日　省略した場合は00 $min
	 * @param 分　省略した場合は00 $sec
	 * @return 今月初めの日時。（例：2010/10/1 00:00:00）
	 */
	public function calcThisMonthFirstDate($h=00,$min=00,$sec=00){
		$ts = mktime($h, $min, $sec, date("m"),1, date("Y"));
		return date('Y-m-d H:i:s', $ts);
	}
	
	/**
	 * 月始め日付を取得する。
	 * @param 日時 $dte
	 * @param 時　省略した場合は00 $h
	 * @param 日　省略した場合は00 $min
	 * @param 分　省略した場合は00 $sec
	 * @return 指定した日付の付の初日時。（例：2010/10/1 00:00:00）
	 */
	public function calcMonthFirstDate($dte,$h=00,$min=00,$sec=00){
		$ts = mktime($h, $min, $sec, date("m",$dte),1, date("Y",$dte));
		return date('Y-m-d H:i:s', $ts);
	}
	

	/**
	 * 今週末を取得する
	 * @param 時　省略した場合は23 $h
	 * @param 日　省略した場合は59 $min
	 * @param 分　省略した場合は59 $sec
	 * @return 今週末最終時間の日時。土曜日の23:59:59
	 */
	public function calcThisWeekLastDate($h=23,$min=59,$sec=59){
		$dte=time();
		$ary=getDate($dte);
		$d=date("d",$dte)+6-$ary['wday'];
		$ts = mktime($h, $min, $sec, date("m",$dte), $d, date("Y",$dte));
		return date('Y-m-d H:i:s', $ts);
	}
	
	
	/**
	 * 週末を取得する
	 * @param 日時 $dte
	 * @param 時　省略した場合は23 $h
	 * @param 日　省略した場合は59 $min
	 * @param 分　省略した場合は59 $sec
	 * @return 指定した日時の週末最終時間の日時。土曜日の23:59:59
	 */
	public function calcWeekLastDate($dte,$h=23,$min=59,$sec=59){
		$ary=getDate($dte);
		$d=date("d",$dte)+6-$ary['wday'];
		$ts = mktime($h, $min, $sec, date("m",$dte), $d, date("Y",$dte));
		return date('Y-m-d H:i:s', $ts);
	}
	
	//週始を取得する
	/**
	 * Enter description here ...
	 * @param 日時 $dte
	 * @param 時　省略した場合は00 $h
	 * @param 日　省略した場合は00 $min
	 * @param 分　省略した場合は00 $sec
	 * @return 指定した日時の週の週始の日時。日曜日の00：00：00
	 */
	public function calcWeekFirstDate($dte,$h=00,$min=00,$sec=00){
		$ary=getDate($dte);
		$d=date("d",$dte)-$ary['wday'];
		$ts = mktime($h, $min, $sec, date("m",$dte), $d, date("Y",$dte));
		return date('Y-m-d H:i:s', $ts);
	}
	//
	/**
	 * 今週始を取得する
	 * @param 時　省略した場合は00 $h
	 * @param 日　省略した場合は00 $min
	 * @param 分　省略した場合は00 $sec
	 * @return 今週始の日時。今週の日曜日の00：00：00
	 */
	public function calcThisWeekFirstDate($h=00,$min=00,$sec=00){
		$dte=time();
		$ts=$this->calcWeekFirstDate($dte,$h, $min, $sec);
		return $ts;
	}
	
	
	
	/**
	 *日付をY/m/d形式に変換する。
	 * @param 日時（UNIXタイプスタンプでも別形式でも可） $ts
	 * @return Y/m/d型日付
	 */
	public function convartYMD1($ts){
		if(!$ts){
			return null;
		}
		if (!(is_numeric($ts))){
			$t=strtotime($ts);
			
		}
		return date('Y/m/d',$t);
	}
	
	/**
	 *日付をY-m-d形式に変換する。
	 * @param 日時（UNIXタイプスタンプでも別形式でも可） $ts
	 * @return Y-m-d型日付
	 */
	public function convartYMD2($ts){
		if(!$ts){
			return null;
		}
	
		if (!(is_numeric($ts))){
			$t=strtotime($ts);
			
		}
		$t=strtotime($ts);
		return date('Y-m-d',$t);
	}
	
	


	
}
?>