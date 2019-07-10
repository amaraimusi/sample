<?php 
	require_once '../../../zss_lib/common.php';
	require_once '../../../zss_lib/mail_ex.php';
	
	
			//送信ボタンが押された時の処理。
			if($_POST['submit_send_mail']!=null){
				if($_POST['pw']=='norisuke'){
					$fromMailAddress=$_POST['from_mail'];
					$toMailAddress=$_POST['to_mail'];
					$subject=$_POST['subject'];
					$message=$_POST['message'];
					$me=new MailEx();
					$ret=$me->send($fromMailAddress,$toMailAddress,$subject,$message);
					
					if($ret==true){
						$m_ret="メール送信成功";
					}else{
						$m_ret="メール送信失敗";
					}
				}else{
					$m_ret="動作確認パスワードが違います。";
				}


				//■■■□□□■■■□□□
//			mb_language("Japanese");
//			mb_internal_encoding("UTF-8");
//			
//			if (mb_send_mail("amaraimusi@gmail.com", "take4 テストメール", "これはテストです。", "From: amaraimusi@gmail.com")) {
//			  $ret=true;
//			} else {
//			  $ret=false;
//			}

				
			}
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" /><!-- 髢ｾ�ｪ陷肴��ｿ�ｻ髫ｪ�ｳ邵ｺ霈披雷邵ｺ�ｪ邵ｺ�ｽ-->
		<title>PHP | メール送信</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script>

		</script>
		
		<style type="text/css">
			
		</style>
		
	</head>
	<body>
		<div id="page1">
		<div id="header">PHP | メール送信</div>
		<div id="content" >
		
			<div class="sec1">
				<div style="color:red"><?php echo($m_ret);?></div>
				<form action="mail.php" method="post">
				  件名：<br />
				  <input type="text" name="subject" size="30" value="テスト件名" /><br />
				  送信元メールアドレス：<br />
				  <input type="mail" name="from_mail" size="30" value="amaraimusi@gmail.com" /><br />
				  送信先メールアドレス：<br />
				  <input type="mail" name="to_mail" size="30" value="amaraimusi@gmail.com" /><br />
				  本文：<br />
				  <textarea name="message" cols="30" rows="5">
 いろはにほへと　ちりぬるを
わかよたれそ　つねならむ
うゐのおくやま　けふこえて
あさきゆめみし　ゑひもせす
				  </textarea><br />
				  <br />
				  動作確認パスワード：臆茶犬<br />
				  <input type="password" name="pw" size="30" value="" /><br />
				  <input name="submit_send_mail" type="submit" value="送信する" />
				</form>
				
				<hr/>
				■テスト済み<br/>
				gmail→gmail<br/>
				gmail→yahooMail<br/>
			</div><!-- sec1 -->
			
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/08/13</div>
		</div><!-- page1 -->
	</body>
</html>