<?php
require_once 'session_control.php';
require_once 'common.php';
/**
 * BASIC認証チェック制御
 * @author uehara
 * @date 2010/10/22
 */
class AuthPoi{
	
	
	/**
	 * Basice認証を行います。
	 * 認証されていない場合は自動的に認証ダイアログが表示されます。
	 * 認証に失敗した場合は、再度認証ダイアログが表示されます。
	 * ダイアログを閉じると不正遷移と画面に表示されます。
	 */
	function auth(){
		
		
		$failMsg='認証できませんでした。';
		if (!isset($_SERVER['PHP_AUTH_USER'])){
			//■■■キャンセルボタンを押すか、認証ダイアログを閉じたときの処理
			
		    header('WWW-Authenticate: Basic realm=Application');
		    header('HTTP/1.0 401 Unauthorized');
		    
		    //セッションを削除します。
			$sesCon =new SessionControl();
			$sesCon->deleteSession();
			
		    die($failMsg);
		}else{
			//■■■OKボタンを押したときの処理
			
			require_once 'login_check.php';
			
			//▼ユーザーIDとパスワードを取得します。
			$user = $_SERVER['PHP_AUTH_USER'];
			$password = $_SERVER['PHP_AUTH_PW'];
			
			//▼入力チェックを行う。
			if($this->inputChecks($userId,$userPassword)==false){
				//▼認証失敗の処理
		        header('WWW-Authenticate: Basic realm=Application');
		        header('HTTP/1.0 401 Unauthorized');
		        die($failMsg);
			}
			
			//▼DBにアクセスして認証チェックを行います。
			$lc =new LoginCheck();
			if($lc->check($user, $password)==false){

		
				//▼認証失敗の処理
		        header('WWW-Authenticate: Basic realm=Application');
		        header('HTTP/1.0 401 Unauthorized');
		        die($failMsg);
			}
			
			//▼▼▼認証成功時の処理
			//session_start();//セッション開始
			//session_regenerate_id();//セッションIDを変更する。
							session_start();
			//▼セッションへユーザー名、ユーザーID,グループIDをセットする。
			$userName=$lc->m_userName;
			$userId=$lc->m_userId;
			$groupId=$lc->m_groupId;
			$_SESSION['user_name']=$userName;
			$_SESSION['user_id']=$userId;
			$_SESSION['group_id']=$groupId;

		}
		
	}
	
	//▼入力チェックを行う。
	private function inputChecks($userId,$userPassword){
	
		$icFlg=true;
		//▽ユーザーIDが半角英数字以外であればFalse
		if(preg_match("[^0-9a-zA-Z]",$userId)){
			$icFlg=false;
		}
	
		//▽パスワードのチェックを行う。
		if(preg_match("[^0-9a-zA-Z]",$userPassword)){
		    //********半角英数字以外を含む
		    $icFlg=false;
		}
		else{
		    //********半角英数字のみ
		}
		return $icFlg;
	}
}
?>
