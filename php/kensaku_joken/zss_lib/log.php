<?php
require_once 'common.php';
require_once 'config/config.php';
/**
 * ログ出力をする。
 * @author uehara
 * @date 2010/10/25
 */
class Log{
	
	var $logAdminPath;
	var $logExifPath;
	var $logXmlPath;
	
	public function Log(){
		
		$cfg=Config::getInstance();
		$this->logAdminPath=$cfg->m_logAddminPath;
		$this->logExifPath=$cfg->m_logExifPath;
		$this->logXmlPath=$cfg->m_logXmlPath;
		
	}
	
	public static function getInstance(){
		
		
		if($_REQUEST['Log_']==null){
			$_REQUEST['Log_']=new Log();
		}
		
		return $_REQUEST['Log_'];

	}

	/**
	 * メンテナンスシステム用ログ出力
	 * @param String $msg	メッセージ
	 * @param String $idStr ID
	 */
	public function log_adm($msg,$idStr){
		$fn=$this->logAdminPath.'adm'.date(Ymd).'.log';
		$this->log_common($msg,$idStr,$fn);
	}
	
	
	/**
	 * Exif用ログ出力
	 * @param String $msg	メッセージ
	 * @param String $idStr ID
	 */
	public function log_exif($exifFileName,$excType=null){
		if($excType=="insert"){
			$strExcType="新規追加";
		}else if($excType=="update"){
			$strExcType="上書更新";
		}
		
		$fn=$this->logExifPath.'exif'.date(Ymd).'.log';
		$this->log_common($strExcType,$exifFileName,$fn);
	}
	
	
	/**
	 * ＸＭＬ用ログ出力
	 * @param String $msg	メッセージ
	 * @param String $idStr ID
	 */
	public function log_xml($xmlFileName){
		$fn=$this->logXmlPath.'xml'.date(Ymd).'.log';
		$this->log_common('登録',$xmlFileName,$fn);
	}
	
	
	/**
	 * 共通ログ出力処理
	 * @param String $msg	メッセージ
	 * @param String $idStr ID
	 */
	private function log_common($msg,$aaa,$fn){
		
		session_start();
	
		$ary[0]=date_format(date_create('now'), "Y/m/d H:i:s");//本日日付を取得する。
		$ary[1]=$_SESSION['user_name'];
		$ary[2]=$_SESSION['user_id'];
		$ary[3]=$_SESSION['group_id'];
		$ary[4]=$msg;
		$ary[5]=$aaa;
		$msg2=join(" ",$ary);

		error_log("$msg2\r\n", 3, $fn);

	}
	

}
?>
