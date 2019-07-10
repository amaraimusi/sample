<?php

require_once 'DaoForSqlite.php';

/**
 * 不完全版。セキュリティがあまいので。
 * @author k-uehara
 *
 */
class LoginCheckForSqlite{


	var $m_userName="user_name";
	var $m_password="password";

	var $m_xxx=".";


	/**
	 * 認証
	 * @param unknown $pageUrl	呼び出し元
	 */
	public function auth($pageUrl){

		session_start();

		//簡易認証
		if($_SESSION['x']!=$this->m_xxx){
			$_SESSION['page_call']=$pageUrl;
			header("Location:login.php");
			exit;

		}

// 		//セッションからユーザー名とパスワードを取得する
// 		$userName=$_SESSION[$this->m_userName];
// 		$password=$_SESSION[$this->m_password];

// 		//DBをチェック
// 		if ($this->checkFromDb($userName,$password)){


// 		}else{
// 			$_SESSION['page_call']=$pageUrl;
// 			header("Location:login.php");
// 			exit;
// 		}

		//DBへ検索
		//レコードがない場合、
			//セッションをクリア
			//セッションに現在ページを詰め、ログイン画面にリダイレクト

		//レコードがある場合。
			//セッションにユーザー名とパスワードをセット





	}

	/**
	 * ログイン画面用の認証
	 * @param unknown $pageUrl	呼び出し元
	 */
	public function authX($userName,$password){


		//DBをチェック
		if ($this->checkFromDb($userName,$password)){

			session_start();
			$_SESSION['x']=$this->m_xxx;

			//元の画面にリダイレクト遷移
			if(empty($_SESSION['page_call'])){
				$pageCall='index.php';
			}else{
				$pageCall=$_SESSION['page_call'];
			}
			header("Location:{$pageCall}");

			exit;
		}




	}


	private function checkFromDb($userName,$password){

		if(empty($userName) || empty($password) ){
			return false;
		}

		//■■■□□□■■■□□□■■■□□□保留

		return true;
	}




}


?>