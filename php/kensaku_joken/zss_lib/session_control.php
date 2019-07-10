<?php

//
/**
 * セッション制御クラス
 * @author uehara
 * @date 2010/10/25
 */
class SessionControl{


	/**
	 * セッションをクリアします。
	 */
	function deleteSession(){
		
		
		if(isSet($_SESSION)){
			//セッションを削除する。
			
			
			session_start();
			
			//セッション中のデータをクリアします。
			$_SESSION = array();
		
			//セッション名に該当するクッキーがあれば、削除する。
			if(isSet($_COOKIE[session_name()])){
				setCookie(session_name(),'',time()-3600,'/');
			}
	

			
			//session_regenerate_id();//セッションIDを変更する。
			$destroyed=session_destroy();
		}

		
	}
}
?>