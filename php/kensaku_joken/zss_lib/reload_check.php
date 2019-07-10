<?php

require_once 'common.php';

/*■■■このクラスを使う上での準備
1.以下のJavaScriptをページに埋め込むこと。
	 //▼リロード対策（サブミット時に呼び出す）
	function token(){
		document.form1['reload'].value=new Date;
	}
2.サブミット時に上記のtoken()を呼び出すこと。
	例：<input type="submit" value="実行" onclick="token();"/>
3.ページのform1内に、以下のコードを埋め込むこと
	<input type="hidden" name="reload" value="<?php echo $_POST['reload'];?>" />
*/

/**
 * リロードされたかをチェックする。
 * @author user01
 *2011/7/21	新規作成
 */
class ReloadCheck{
	
	
	/**
	 * リロードチェック。0:リロード,1:リロード以外のアクション
	 */
	public function check(){
	
		session_start();
		$tk=$_SESSION['token'];
		if ($tk==null){

			$_SESSION['token']=$_POST['reload'];
			return 1;
		}
		
		if($tk==$_POST['reload']){
			
	
			$_SESSION['token']=$_POST['reload'];
			return 0;
		}else{
	
			$_SESSION['token']=$_POST['reload'];
			return 1;
		}
	}
}