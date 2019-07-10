<?php

/**
 * ログ出力を行います。
 * 日付が変わると、新しくログファイルを作成します。
 * @author user01
 *
 */
class LoggerEveryDay{
	var $m_iniFlg;
	
	public static function getInstance(){
		
		
		if(!$_REQUEST['LoggerEveryDay']){
			$obj=new LoggerEveryDay();
			$_REQUEST['LoggerEveryDay']=$obj;
		}else{
			$obj=$_REQUEST['LoggerEveryDay'];
		}
		
		return $obj;

	}
	
	/**
	 * ログ出力。
	 * @param  $msg　メッセージ
	 * @param  $logFileName　ログファイル名（拡張子不要）
	 */
	function prints($msg,$logFileName){
		
		//▼ログファイル名を取得する。スクリプト実行で最初の処理であるか調べる
		$lfn=$_REQUEST[$logFileName];

		
		if(!$lfn){
			//▼ログファイル名が空である場合の処理。
			
			//▼ログファイルが存在するか調べる
			$today=date_format(date_create('now'), "Ymd");
			$lfn=$logFileName.$today.'.log';
			
			if(!is_file($lfn)){
				
				//▼新しく本日のログファイルを作成し、日にちを出力します。
				$newDayMsg='■■■■■■■■'.date_format(date_create('now'), "Y-m-d");
				error_log("$newDayMsg\n", 3, $lfn);
				
			}
			
			//▼時刻を出力します。
			$msg2='□□□□'.date_format(date_create('now'), "H:i:s");
			error_log("\n$msg2\n", 3, $lfn);
			
			$_REQUEST[$logFileName]=$lfn;
		}
		
		//▼メッセージを出力します。
		error_log("$msg\n", 3, $lfn);

	}
	
}