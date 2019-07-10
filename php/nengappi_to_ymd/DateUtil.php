<?php

/**
 *
 *
 * 汎用的に使える日付操作関連のメソッド集。
 *
 * @author Kenji Uehara
 * 2010/10/22 	cale_date.phpとして新規作成
 * 2011/8/19	date_util.phpとして新規作成
 * 2013/8/4		DateFormatChangeからDateUtilに変更。メソッドも追加。
 * 2014/5/27	calcMonthLastDateを改良
 * 2014/6/4		cale_date.phpとdate_util.phpを統合してDateUtil.phpにする。α版
 *
 */
class DateUtil {
	var $m_year = 0;
	var $m_month = 1;
	var $m_day = 2;
	var $m_hour = 3;
	var $m_minuts = 4;
	var $m_seconds = 5;

	/**
	 * 日時を「yyyy/mm/dd hh:ii:ss」型に変換する。
	 *
	 * @param $v 「yyyymmddhhiiss」型の日時(数値以外の文字は削除する）
	 * @return フォーマット変換後の日時
	 */
	function cnvDatetime1($v) {

		// 文字列中に数値以外の文字があれば削除する。
		$v = $this->cnvDatetime2 ( $v );

		// 数値系であれば、以下処理を実行する。
		if (is_numeric ( $v ) == true) {

			// 文字を8桁分解し、年月日と時分秒に分解する。
			$ary = str_split ( $v, 8 );
			$ymd = $ary [0];
			$his = $ary [1];

			// 年月日のフォーマットを変換する
			$ymd = $this->cnvDate1 ( $ymd );

			// 時分秒のフォーマットを変換する。
			$his = $this->cnvTime1 ( $his );

			// 日時を組み立てる。
			$v = $ymd . ' ' . $his;
		}

		return $v;
	}

	/**
	 * 日時を「yyyymmddhhiiss」型に変換する。
	 * 文字列中から数値以外の文字列を削除。また14文字分を切り取る。
	 *
	 * @param $v 日時
	 * @return 「yyyymmddhhiiss」型の日時
	 */
	function cnvDatetime2($v) {

		// 文字列に対して、一文字ずつ処理を行う。
		for($i = 0; $i < strlen ( $v ); $i ++) {

			// 数値系であれば、新文字列に連結する。
			if (is_numeric ( $v [$i] ) == true) {
				$v2 .= $v [$i];
			}
		}

		// 左から１４文字を切り取る。
		$v2 = substr ( $v2, 0, 14 );

		return $v2;
	}

	/**
	 * 日付を「y/m/d」型にフォーマット変換する。
	 * 変換元の日付は「ymd」「y-m-d」に対応
	 *
	 * @param $d 変換対象の日付
	 * @return 変換後の日付
	 */
	function cnvDate1($d) {
		// トリミングをする。
		$d = trim ( $d );

		// 文字列に「-」が含まれている場合、「/」に置換する。
		if (strstr ( $d, '-' )) {
			$d = str_replace ( '-', '/', $d );
		}

		// 含まれていない場合。
		else {

			// 数値系であれば、以下処理を実行する。
			if (is_numeric ( $d ) == true) {

				// 文字を4桁ずつ分解して配列を作成。
				$ary = str_split ( $d, 4 );
				$yyyy = $ary [0];
				$mmdd = $ary [1];

				// 月と日に分解。
				$ary2 = str_split ( $mmdd, 2 );
				$mm = $ary2 [0];
				$dd = $ary2 [1];

				// 月、日がnullでなければ区切り文字をはさむ。
				if ($mm !== null && $mm !== '') {
					$mm = '/' . $mm;
				}
				if ($dd !== null && $dd !== '') {
					$dd = '/' . $dd;
				}

				// 年月日を組み立てる
				$d = $yyyy . $mm . $dd;
			}
		}

		return $d;
	}

	/**
	 * 時刻を「h:i:s」型にフォーマット変換する。
	 * 変換元の時刻は、his,h:i:s,hi,h:iに対応
	 *
	 * @param $t 変換元の時刻。
	 * @return 時刻（h:i:s)
	 */
	function cnvTime1($t) {

		// トリミングをする。
		$t = trim ( $t );

		// 文字列に「:」が含まれている場合、以下の処理を行う。
		if (strstr ( $t, ':' )) {
		}

		// 含まれていない場合。
		else {
			// 数値系であれば、以下処理を実行する。
			if (is_numeric ( $t ) == true) {
				// 文字を2桁ずつ分解して配列を作成。
				$ary = str_split ( $t, 2 );

				// 配列Ｊｏｉｎをして、h:i:sの時刻を作成する。
				$t = join ( ":", $ary );
			}
		}

		return $t;
	}

	/**
	 * エンティティ中の指定プロパティの日付フォーマットを変換する。
	 *
	 * @param $ent 変換対象エンティティ
	 * @param $jPrpName 変換対象のプロパティ名。コンマで複数指定可能。
	 * @param $dateFormat 日付フォーマット
	 * @return $ent
	 */
	function changeDateFormatForEnt(&$ent, $jPrpName, $dateFormat = 'Y/m/d') {

		// ▼プロパティ名リストを取得する。
		$prps = explode ( ',', $jPrpName );

		// ▼プロパティ名リストの件数分、以下の処理を繰り返し、日付フォーマット変換を行う。
		foreach ( $prps as $key ) {
			$val = $ent [$key];
			if (isSet ( $val )) {

				$ent [$key] = date ( $dateFormat, strtotime ( $val ) );
			}
		}

		return $ent;
	}
	/**
	 * データ中の指定プロパティの日付フォーマットを変換する。
	 *
	 * @param $data 変換対象データ
	 * @param $jPrpName 変換対象のプロパティ名。コンマで複数指定可能。
	 * @param $dateFormat 日付フォーマット
	 * @return $ent
	 */
	function changeDateFormatForData(&$data, $jPrpName, $dateFormat = 'Y/m/d') {

		// ▼プロパティ名リストを取得する。
		$prps = explode ( ',', $jPrpName );

		foreach ( ( array ) $data as $i => $ent ) {

			// ▼プロパティ名リストの件数分、以下の処理を繰り返し、日付フォーマット変換を行う。
			foreach ( $prps as $key ) {
				$val = $ent [$key];
				if (isSet ( $val )) {

					$ent [$key] = date ( $dateFormat, strtotime ( $val ) );
				}
			}
			$data [$i] = $ent;
		}

		return $data;
	}

	/**
	 * 日付から時刻部分を削除する。
	 *
	 * @param
	 *        	$ent
	 * @return Ambigous <string, 対象文字列>
	 */
	public function deleteTime($d) {
		$cs = CalcString::getInstance ();
		$d = $cs->stringLeft ( $d, ' ' );

		return $d;
	}

	/**
	 * ２つの日付を比較する。日付１が大きければ、＋の値を、同値なら０、小さければ負値を返す。
	 * ※日数差ではないので注意
	 *
	 * @param $strDate1 日付１
	 * @param $strDate2 日付２
	 * @return 比較結果
	 */
	function diffDay($strDate1, $strDate2) {
		$dtTm1 = new DateTime ( $strDate1 );
		$dtTm2 = new DateTime ( $strDate2 );
		$d1 = $dtTm1->format ( 'Ymd' );
		$d2 = $dtTm2->format ( 'Ymd' );
		$d0 = $d1 - $d2;
		return $d0;

		// $dtTm1->
	}

	/**
	 * 日時文字列を配列に分解する。
	 *
	 * @param unknown_type $strDateTime
	 * @return multitype:
	 */
	function getDate2($strDateTime) {
		$aryA = preg_split ( '|[ /:_-]|', $strDateTime );
		return $aryA;
	}

	/**
	 * 入力日付を入力日付の最終時間を付加します。（例：入力 2010/10/19→2010/10/19 23:59:59）
	 *
	 * @param 日時 $dte
	 * @return 最終時間が付加された日時
	 */
	function calcLastDateTime($dte) {
		if (! $dte) {
			return null;
		}

		$ary = $this->getDate2 ( $dte );
		$y = $ary [$this->m_year];
		$m = $ary [$this->m_month];
		$d = $ary [$this->m_day];
		$h = 23;
		$min = 59;
		$sec = 59;

		return ($y . '-' . $m . '-' . $d . ' ' . $h . ':' . $min . ':' . $sec);
	}

	/**
	 * 入力日付を入力日付の初期時間を付加します。（例：入力 2010/10/19→2010/10/19 00:00:00）
	 *
	 * @param 日時 $dte
	 * @return 初期時間が付加された日時
	 */
	function calcFirstDateTime($dte) {
		if (! $dte) {
			return null;
		}

		$ary = $this->getDate2 ( $dte );
		$y = $ary [$this->m_year];
		$m = $ary [$this->m_month];
		$d = $ary [$this->m_day];
		$h = 00;
		$min = 00;
		$sec = 00;
		return ($y . '-' . $m . '-' . $d . ' ' . $h . ':' . $min . ':' . $sec);
	}

	/**
	 * 本日初期時を返す。
	 *
	 * @return 本日初期時
	 */
	function calcTodayFirstDateTime() {
		// 現在日時を取得する。
		$today = date_format ( date_create ( 'now' ), "Y-m-d" );

		// 本日最初時間を算出する。
		$today = $this->calcFirstDateTime ( $today );

		return $today;
	}

	/**
	 * 本日最後時間日時を返す。
	 *
	 * @return 本日最後時間日時
	 */
	function calcTodayLastDateTime() {
		// 現在日時を取得する。
		$today = date_format ( date_create ( 'now' ), "Y-m-d" );

		// 本日最後時間日時を算出する。
		$today = $this->calcLastDateTime ( $today );

		return $today;
	}

	/**
	 * 今月末日 日時を取得する。
	 *
	 * @param
	 *        	時　省略した場合は23 $h
	 * @param
	 *        	日　省略した場合は59 $min
	 * @param
	 *        	分　省略した場合は59 $sec
	 * @return 今月の最終日最終時間。（例：2010/10/31 23:59:59）
	 */
	public function calcThisMonthLastDate($h = 23, $min = 59, $sec = 59) {
		$ts = mktime ( $h, $min, $sec, date ( "m" ) + 1, 0, date ( "Y" ) );
		return date ( 'Y-m-d H:i:s', $ts );

		$d = date_format ();
	}

	/**
	 * 月末日を取得する。
	 *
	 * @param 日付 $dte
	 * @param
	 *        	時　省略した場合は23 $h
	 * @param
	 *        	日　省略した場合は59 $min
	 * @param
	 *        	分　省略した場合は59 $sec
	 * @return 指定した日付の最終日最終時間。（例：2010/10/31 23:59:59）
	 */
	public function _calcMonthLastDate($dte, $h = 23, $min = 59, $sec = 59) {
		$ts = mktime ( $h, $min, $sec, date ( "m", $dte ) + 1, 0, date ( "Y", $dte ) );
		return date ( 'Y-m-d H:i:s', $ts );
	}

	/**
	 * 月末日を取得する。改良版
	 *
	 * @param $d 日付
	 * @return Ambigous <string, DateTime>
	 */
	public function calcMonthLastDate($d) {
		$type = gettype ( $d );

		if ($type == 'string') {
			$d2 = new DateTime ( $d );
		} else {
			$d2 = $d;
		}
		$year = $d2->format ( "Y" );
		$month = $d2->format ( "m" );
		$lastday = date ( 't', mktime ( 0, 0, 0, $month, 1, $year ) );

		$d3 = $year . "/" . $month . "/" . $lastday;

		if ($type != 'string') {
			$d3 = new DateTime ( $d3 );
		}

		return $d3;
	}

	/**
	 * 今月始め日付を取得する。
	 *
	 * @param
	 *        	時　省略した場合は00 $h
	 * @param
	 *        	日　省略した場合は00 $min
	 * @param
	 *        	分　省略した場合は00 $sec
	 * @return 今月初めの日時。（例：2010/10/1 00:00:00）
	 */
	public function calcThisMonthFirstDate($h = 00, $min = 00, $sec = 00) {
		$ts = mktime ( $h, $min, $sec, date ( "m" ), 1, date ( "Y" ) );
		return date ( 'Y-m-d H:i:s', $ts );
	}

	/**
	 * 月始め日付を取得する。
	 *
	 * @param 日時 $dte
	 * @param
	 *        	時　省略した場合は00 $h
	 * @param
	 *        	日　省略した場合は00 $min
	 * @param
	 *        	分　省略した場合は00 $sec
	 * @return 指定した日付の付の初日時。（例：2010/10/1 00:00:00）
	 */
	public function calcMonthFirstDate($dte, $h = 00, $min = 00, $sec = 00) {
		$ts = mktime ( $h, $min, $sec, date ( "m", $dte ), 1, date ( "Y", $dte ) );
		return date ( 'Y-m-d H:i:s', $ts );
	}

	/**
	 * 今週末を取得する
	 *
	 * @param
	 *        	時　省略した場合は23 $h
	 * @param
	 *        	日　省略した場合は59 $min
	 * @param
	 *        	分　省略した場合は59 $sec
	 * @return 今週末最終時間の日時。土曜日の23:59:59
	 */
	public function calcThisWeekLastDate($h = 23, $min = 59, $sec = 59) {
		$dte = time ();
		$ary = getDate ( $dte );
		$d = date ( "d", $dte ) + 6 - $ary ['wday'];
		$ts = mktime ( $h, $min, $sec, date ( "m", $dte ), $d, date ( "Y", $dte ) );
		return date ( 'Y-m-d H:i:s', $ts );
	}

	/**
	 * 週末を取得する
	 *
	 * @param 日時 $dte
	 * @param
	 *        	時　省略した場合は23 $h
	 * @param
	 *        	日　省略した場合は59 $min
	 * @param
	 *        	分　省略した場合は59 $sec
	 * @return 指定した日時の週末最終時間の日時。土曜日の23:59:59
	 */
	public function calcWeekLastDate($dte, $h = 23, $min = 59, $sec = 59) {
		$ary = getDate ( $dte );
		$d = date ( "d", $dte ) + 6 - $ary ['wday'];
		$ts = mktime ( $h, $min, $sec, date ( "m", $dte ), $d, date ( "Y", $dte ) );
		return date ( 'Y-m-d H:i:s', $ts );
	}

	// 週始を取得する
	/**
	 * Enter description here .
	 * ..
	 *
	 * @param 日時 $dte
	 * @param
	 *        	時　省略した場合は00 $h
	 * @param
	 *        	日　省略した場合は00 $min
	 * @param
	 *        	分　省略した場合は00 $sec
	 * @return 指定した日時の週の週始の日時。日曜日の00：00：00
	 */
	public function calcWeekFirstDate($dte, $h = 00, $min = 00, $sec = 00) {
		$ary = getDate ( $dte );
		$d = date ( "d", $dte ) - $ary ['wday'];
		$ts = mktime ( $h, $min, $sec, date ( "m", $dte ), $d, date ( "Y", $dte ) );
		return date ( 'Y-m-d H:i:s', $ts );
	}
	//
	/**
	 * 今週始を取得する
	 *
	 * @param
	 *        	時　省略した場合は00 $h
	 * @param
	 *        	日　省略した場合は00 $min
	 * @param
	 *        	分　省略した場合は00 $sec
	 * @return 今週始の日時。今週の日曜日の00：00：00
	 */
	public function calcThisWeekFirstDate($h = 00, $min = 00, $sec = 00) {
		$dte = time ();
		$ts = $this->calcWeekFirstDate ( $dte, $h, $min, $sec );
		return $ts;
	}

	/**
	 * 日付をY/m/d形式に変換する。
	 *
	 * @param 日時（UNIXタイプスタンプでも別形式でも可） $ts
	 * @return Y/m/d型日付
	 */
	public function convartYMD1($ts) {
		if (! $ts) {
			return null;
		}
		if (! (is_numeric ( $ts ))) {
			$t = strtotime ( $ts );
		}
		return date ( 'Y/m/d', $t );
	}

	/**
	 * 日付をY-m-d形式に変換する。
	 *
	 * @param 日時（UNIXタイプスタンプでも別形式でも可） $ts
	 * @return Y-m-d型日付
	 */
	public function convartYMD2($ts) {
		if (! $ts) {
			return null;
		}

		if (! (is_numeric ( $ts ))) {
			$t = strtotime ( $ts );
		}
		$t = strtotime ( $ts );
		return date ( 'Y-m-d', $t );
	}

	/**
	 * 日時チェック 閏年対応
	 *
	 * @param $strDate 日付文字列
	 * @return boolean
	 */
	public function isDatetime($strDateTime) {

		// トリミング
		$strDateTime = trim ( $strDateTime );

		// 空であればエラー
		if (! $strDateTime) {
			return false;
		}

		// 日時を　年月日時分秒に分解する。
		$aryA = preg_split ( '|[ /:_-]|', $strDateTime );
		foreach ( $aryA as $key => $val ) {

			// ▼正数以外が混じっているば、即座にfalseを返して処理終了
			if ($this->isPNum ( $val ) == false) {
				return false;
			}
			$aryA [$key] = trim ( $val );
		}

		// ▼グレゴリオ暦と整合正が取れてるかチェック。（閏年などはエラー）
		if (! checkdate ( $aryA [1], $aryA [2], $aryA [0] )) {
			return false;
		}

		// ▼時刻の整合性をチェック
		if ($this->checkTime ( $aryA [3], $aryA [4], $aryA [5] ) == false) {
			return false;
		}

		return true;
	}

	/**
	 * 日付チェック 閏年対応
	 *
	 * @param $strDate 日付文字列
	 * @return boolean
	 */
	public function isDate($strDate) {

		// トリミング
		$strDate = trim ( $strDate );

		// 空であればエラー
		if (! $strDate) {
			return false;
		}

		// 日時を　年月日時分秒に分解する。
		$aryA = preg_split ( '|[ /:_-]|', $strDate );
		foreach ( $aryA as $key => $val ) {

			// ▼正数以外が混じっているば、即座にfalseを返して処理終了
			if ($this->isPNum ( $val ) == false) {
				return false;
			}
			$aryA [$key] = trim ( $val );
		}

		// ▼グレゴリオ暦と整合正が取れてるかチェック。（閏年などはエラー）
		if (! checkdate ( $aryA [1], $aryA [2], $aryA [0] )) {
			return false;
		}

		return true;
	}

	/**
	 * 正数チェック
	 *
	 * @param $str 正数文字列
	 * @return boolean
	 */
	public function isPNum($str) {
		if (preg_match ( "/^[0-9]+$/", $str )) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * 時刻の整合性をチェック
	 *
	 * @param $hou 時
	 * @param $min 分
	 * @param $sec 秒
	 * @return boolean
	 */
	function checkTime($hou, $min, $sec) {
		if ($hou < 0 || $hou > 23) {

			return false;
		}
		if ($min < 0 || $min > 59) {

			return false;
		}
		if ($sec < 0 || $sec > 59) {

			return false;
		}

		return true;
	}


	/**
	 * 年月日表記の文字列からy/m/d型のデータにする。
	 * @param  $s	年月日表記の文字列
	 * @param  $sp	日付のセパレータ。「/」や「-」の部分
	 * @return ymd系の日付文字列。変換できない場合はnul
	 */
	public function cnvNgpToYmd($ngp,$sp='/'){

		$s=str_replace('年',$sp,$ngp);
		$s=str_replace('月',$sp,$s);
		$s=str_replace('日','',$s);

		return $s;

	}
}