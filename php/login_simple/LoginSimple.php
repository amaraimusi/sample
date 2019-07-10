<?php

/**
 *シンプルログイン
 *DBを使わないシンプルなログイン。
 *アカウント情報はコード内に埋め込むタイプ。
 *★セキュリティ
 *セッション側には暗号化したアカウントを保存
 *PHPコード内にアカウント情報を記述するため、PHPコードを見られてしまうとアウト。
 *
 * @author uehara
 * 2014/8/13	LoginSimpleを作成
 * 2010/10/25	新規作成
 */
class LoginSimple{


	var $m_cpw="OU0zVcYV/QU=";//ハコガメ
	var $m_key="metaboric";
	var $m_loginUrl="login_zss.php";
	var $m_topUrl="login_simple.php";

	function login(){


		if(!empty($_POST['pw'])){
			// POSTからパスワードを取得する。
			$pw=$_POST['pw'];
			$pw=trim($pw);
			if(empty($pw)){
				return "";
			}

			echo $pw;

			// パスワードを暗号化して、ユーザー暗号パスワードとする。
			$upw=$this->ango($pw,$this->m_key);

			// ユーザー暗号パスワードとあらかじめ定義している定義暗号パスワードを比較
			if($upw==$this->m_cpw){
				// 一致する場合
				// 	セッションから遷移元URLを取得する。
				session_start();
				$uri=$_SESSION['login_zss_uri'];
				//$_SESSION['login_zss_uri']=null;// 	セッション内の遷移元URLをクリアする。

				// 	遷移元URLがない場合は、デフォルトURLをセット
				if(empty($uri)){
					$uri=$this->m_topUrl;
				}
				// 	ユーザー暗号パスワードをセッションに保持
				$_SESSION['login_zss_upw']=$upw;

				// 	遷移元URLにリダイレクトする。
				header("Location: ".$uri);
				exit();


			// 一致しない場合
			}else{
				return "パスワードが違います。";
			}
		}
		return "";
	}

	/**
	 * 認証を行い、認証が無効ならログイン画面にリダイレクトする。
	 */
	function check(){

		// セッションからユーザー暗号パスワードを取得
		session_start();
		$upw=$_SESSION['login_zss_upw'];



		// ユーザー暗号パスワードと定義暗号パスワードを比較する。
		if($this->m_cpw==$upw){
			return;
		}else{

			// 現在のURLを取得し、セッションにセット
			$uri=$_SERVER["REQUEST_URI"];
			$_SESSION['login_zss_uri']=$uri;

			// ログイン画面にリダイレクトする。
			header("Location: ".$this->m_loginUrl);
			exit();
		}

	}

	/**
	 * ログアウト
	 */
	function logout(){

		session_start();

		// 	ユーザー暗号パスワードをセッションからクリア
		$_SESSION['login_zss_upw']=null;

		// ログイン画面にリダイレクトする。
		header("Location: ".$this->m_loginUrl);
		exit();


	}


	/**
	 * 暗号化
	 * 暗号に変換
	 * @param  $str	文字列
	 * @param  $kagi	鍵
	 * @return string	暗号文字列
	 */
	private function ango($str,$kagi){

		$td  = mcrypt_module_open('des', '', 'ecb', '');
		$kagi = substr($kagi, 0, mcrypt_enc_get_key_size($td));
		$iv  = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		if (mcrypt_generic_init($td, $kagi, $iv) < 0) {
			exit('error.');
		}
		$xxx = base64_encode(mcrypt_generic($td, $str));
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);

		return $xxx;
	}

	/**
	 * 複合化
	 * 暗号文字列を復元する。
	 * @param  $str 暗号文字列
	 * @param  $kagi　鍵
	 * @return string　文字列
	 */
	private function hukugo($str,$kagi){


		$td  = mcrypt_module_open('des', '', 'ecb', '');
		$kagi = substr($kagi, 0, mcrypt_enc_get_key_size($td));
		$iv  = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		if (mcrypt_generic_init($td, $kagi, $iv) < 0) {
			exit('error.');
		}
		$xxx = mdecrypt_generic($td, base64_decode($str));
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);

		return $xxx;
	}


}
?>