<?php
require_once 'common.php';
/**
 *ログインチェック
 * @author uehara
 * @date 2010/10/25
 */
class LoginCheck{
	var $m_userId;//ユーザーID
	var $m_groupId;//グループID
	var $m_userName;//ユーザー名
	
	/**
	 * ＤＢに入力したユーザーＩＤとパスワードが存在するか調べます。存在すればＴｒｕｅを返します。
	 * 
	 * @param  $userName　ユーザー名
	 * @param  $userPassword　パスワード
	 * @return boolean
	 */
	function check($userName,$userPassword){
		
		require_once('dao_for_mysql.php');
		$dao=new DaoForMySql();
		$conn=$dao->getDaoConnection();
		
		//▼SQLインジェクション対策
		$userName=mysql_real_escape_string($userName);
		$userPassword=mysql_real_escape_string($userPassword);
		
		$query="SELECT UserId,GroupId,UserName  FROM tbl_user WHERE UserName='$userName' AND Password='$userPassword'; ";
		$rs=mysql_query($query,$conn);
		$flg=false;
		while($row=mysql_fetch_assoc($rs)){
			$this->m_userId=$row['UserId'];
			$this->m_groupId=$row['GroupId'];
			$this->m_userName=$row['UserName'];
			$flg=true;
		}
		mysql_close($conn);
		
		return $flg;
	}
	
}
?>