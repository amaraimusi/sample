<?php
require_once 'common.php';

/**
 * 指定のＵＲＬがWEB上に存在するかチェックする。
 * 日本語ファイル名は不正確
 * @author uehara
 * @date 2010/10/25
 */
class UrlPreChecker{

	/**
	 * 指定のＵＲＬがWEB上に存在するかチェックする。
	 * @param string $url URL
	 * @return boolean
	 */
	public function check($url){
	
		$flg=false;
		$x=@get_headers($url);
		if(preg_match("/OK$/",$x[0])){
			$flg=true;
		
		}
		return $flg;
	}
}
?>