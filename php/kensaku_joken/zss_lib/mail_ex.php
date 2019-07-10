<?php
/**
 * メール送信
 * @author user01
 *2011/7/28　新規作成　ベータ版
 *2011/7/24　修正
 */
class MailEx{
	
	/**
	 * メール送信
	 * gmailにて日本語の文字化けしない。
	 * @param $fromMailAddress	送信元メールアドレス
	 * @param $toMailAddress		送信先メールアドレス
	 * @param $subject					メールタイトル
	 * @param $message					メール内容
	 * @return true:送信成功		false:送信失敗
	 */
	function sendType2($fromMailAddress,$toMailAddress,$subject,$message){
		
		mb_language("Japanese");
		mb_internal_encoding("UTF-8");
		$fromMailAddress="From: {$fromMailAddress}";
		if (mb_send_mail($toMailAddress, $subject, $message, $fromMailAddress)) {
		  $ret=true;
		} else {
		  $ret=false;
		}
		return $ret;
	}
	
	/**
	 * メール送信。
	 * @param  $fromMailAddress　送信元メールアドレス
	 * @param  $toMailAddress	送信先メールアドレス
	 * @param  $subject		メールタイトル
	 * @param  $message		メール内容メッセージ
	 * @return boolean		送信に成功した場合,TRUEを返す。
	 */
	function send($fromMailAddress,$toMailAddress,$subject,$message){
		
		//$strCode="ISO-2022-JP";

		//▼文字コード設定
		mb_language("ja");
		mb_internal_encoding ("UTF-8");

		
		//▼送り主メールアドレスから、ドメインを取得
		$domen=$this->pullupDomen($fromMailAddress);
		
		//▼ヘッダーを作成
//		$header = "MIME-Version: 1.0\r\n"
//			  . "Content-Transfer-Encoding: 7bit\r\n"
//			  . "Content-Type: text/plain; charset=".$strCode."\r\n"
//			  . "Message-Id: <" . md5(uniqid(microtime())) . $domen.">\r\n"
//			  . "From: DAMS <.$fromMailAddress.>\r\n";
		
			  
//		$header = mb_convert_encoding($header,$strCode,"utf-8");
//		$fromMailAddress = mb_convert_encoding($fromMailAddress,$strCode,"utf-8");
//		$toMailAddress = mb_convert_encoding($toMailAddress,$strCode,"utf-8");
//		$subject = mb_convert_encoding($subject,$strCode,"utf-8");
//		$subject = mb_encode_mimeheader($subject,"utf-8");
		//$message = base64_encode($message);//メール用エンコード
//		$message = mb_convert_encoding($message,$strCode,"utf-8");
	
	
		//▼送信元メールアドレス
		$fromMa='-f '.$fromMailAddress;

		//$ret=mb_send_mail($toMailAddress, $subject, $message, mb_encode_mimeheader($header), $fromMa);
		$ret=mb_send_mail($toMailAddress, $subject, $message, null, $fromMa);
		
		return $ret;

	}
	
	//▼ドメインを取得
	private function pullupDomen($fromMailAddress){
		$ary=explode('@', $fromMailAddress);
		$domen=$ary[count($ary)-1];
		return $domen;
	}
	
}