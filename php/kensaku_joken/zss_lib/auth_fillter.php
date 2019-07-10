<?php
define('SUPER_USER',0);
/**
 * ユーザー権限フィルター。
 * ユーザーのグループIDが、データのグループIDと一致するデータのIDだけ抽出。
 * @author uehara
 * @date 2010/10/27
 */
class AuthFillter{
	///エラーIDリスト
	var $m_errIdList;
	/**
	 * ユーザーのグループIDが、データのグループIDと一致するデータのIDだけ抽出。異なる場合はエラーリストにIDを追加。
	 * @param  $conn　DBコネクション
	 * @param  $marks　チェックした項目のIDリスト
	 * @param  $tblName　テーブル名
	 * @param  $groupId		ユーザーのグループID
	 * @return 更新IDリストとエラーIDリスト
	 */
	public function fillGroupId($conn,$marks,$tblName){
		
		//▼ユーザーIDとグループIDをセッションから取得します。
		$userId=$_SESSION['user_id'];
		$groupId=$_SESSION['group_id'];
		
		//▼ユーザーがマスターユーザーである場合、そのまま$marksを返す。
		if($userId==SUPER_USER){
			return $marks;
		}
		
		
		//▼POIデータを取得
		$wh = join(",", $marks); 
		$sql=sprintf("SELECT id,groupid  FROM %s WHERE id IN(%s);",$tblName,$wh);
		$rs=mysql_query($sql,$conn);	
		if($rs){
			while($row=mysql_fetch_assoc($rs)){
				foreach ($row as $key => $val){
					$data[$i][$key]=$val;
				}
				$i++;
			}
		}else{//異常SQLを実行、あるいは該当データが０件である場合の処理
			errLog($sql);
		}
		
		//▼現在ログインしているユーザーのグループIDと、データのグループIDが同じであれば、更新IDリストに追加。異なればエラーIDリストに追加。
		foreach ((array)$data as $key => $ent){
			if($ent['groupid']==$groupId){
				$upIds[sizeof($upIds)]=$ent['id'];
			}else{
				$errIds[sizeof($errIds)]=$ent['id'];
			}
		}

		$this->m_errIdList=$errIds;//エラーIDリストをメンバへセット
		
		return $upIds;
	}
}
?>