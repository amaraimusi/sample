<?php

/**
 * ログ出力をします。
 * 一回のリクエストごとに一旦、ログファイルはクリアされます。
 * @author user01
 *
 */
class LoggerOne{
	
	
	//var $m_iniFlg;
	var $m_iniFlgs;
	
	public static function getInstance(){
		
		
		if($_REQUEST['LoggerOne']==null){
		
			$_REQUEST['LoggerOne']=new LoggerOne();

		}
		
		return $_REQUEST['LoggerOne'];

	}
	public function __construct(){
		
		$this->m_iniFlg='false';
	}
	
	public function prints($msg,$logFn){
	
		
		if($this->m_iniFlgs[$logFn]==null){
		
			
			$this->m_iniFlgs[$logFn]=true;
	
			
				
			if(file_exists($logFn)){
	
			
				$handle = fopen($logFn, "w");
				//▼PHP ver 5.2以上用
				$now=date_format(date_create('now'), "Y-m-d H:i:s"."\n");//本日日付を取得する。
				
				//▼PHP　ver 5.1以下用
				//$now=date("Y-m-d H:i:s")."\n";//本日日付を取得する。
				
				
				fwrite($handle, '■'.$now);
				fclose($handle);
		
			}
		}
		error_log("$msg\n", 3, $logFn);
	}
	
}
?>