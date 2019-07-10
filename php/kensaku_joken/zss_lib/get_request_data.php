<?php
require_once 'common.php';
require_once 'i_entity_info.php';


/**
 * リクエストからエンティティ情報に関連するデータのみ取得する。<br />
 * エンティティタイプとデータタイプ（エンティティリスト）の２種類に対応。<br />
 * @author uehara
 * 2011/7/22	新規作成<br />
 * 2011/9/15	貨幣タイプに対応<br />
 * 
 */
class GetRequestData{
	
	public static function getInstance(){
		
		
		if(!$_REQUEST['GetRequestData']){
			$obj=new GetRequestData();
			$_REQUEST['GetRequestData']=&$obj;
		}else{
			$obj=&$_REQUEST['GetRequestData'];
		}
		
		return $obj;

	}
	
	/**
	 * スコープ（POST,GET,SESSIONのいずれか）からエンティティ情報に紐づくエンティティを取得する。
	 * @param IEntityInfo $eiObj　エンティティ情報オブジェクト
	 * @param  $scopeType　スコープタイプ（post,get,sessionのいずれかを指定。省略時はpost)
	 * @return エンティティ
	 */
	function getEntity(IEntityInfo &$eiObj,$scopeType='post'){
		
		//▼スコープ（POST,GET,SESSIONのいずれかの参照を取得）
		$Scope=&$this->getScope($scopeType);

		//▼エンティティ情報を取得する。
		$eiData=&$eiObj->getEntityInfo();

		
		//▼リクエストの値をエンティティにコピー
		foreach ($eiData as $ei){
			$key=$ei['htmlName'];
			if($key==null){
				$key=$ei['name'];
			}
			
			$val=$Scope[$key];
			if (!is_object($val)){
				$val=htmlspecialchars($val);//サニタイズ。HTML用の記号を無効化にする。
				
				$val=stripslashes($val);//サニタイズ￥解除。特定の記号から\マークを削除する。
				
				//貨幣タイプであれば、3桁区切りをしているカンマを削除
				if ($ei['money']!=null){
					$val=str_replace(',', '', $val);
				}
				
				$ent[$ei['name']]=$val;
			}
			
			
			
		}

		return $ent;
		
	}
	
	/**
	 * スコープ（POST,GET,SESSIONのいずれか）からエンティティ情報に紐づくデータ（エンティティリスト）を取得する。
	 * @param IEntityInfo $eiObj　エンティティ情報オブジェクト
	 * @param  $scopeType　スコープタイプ（post,get,sessionのいずれかを指定。省略時はpost)
	 * @return データ
	 */
	function getData(IEntityInfo &$eiObj,$scopeType='post'){
		
		
		//▼スコープ（POST,GET,SESSIONのいずれかの参照を取得）
		$Scope=&$this->getScope($scopeType);
		
		//▼エンティティ情報を取得する。
		$eiData=&$eiObj->getEntityInfo();

		foreach ($eiData as  $ei){
			
			$key=$ei['htmlName'];
			if($key==null){
				$key=$ei['name'];
			}

			if(is_array($Scope[$key])){
				foreach ($Scope[$key] as $i => $val){
					
					
					$val=htmlspecialchars($val);//サニタイズ。HTML用の記号を無効化にする。
					$val=stripslashes($val);//サニタイズ￥解除。特定の記号から\マークを削除する。
				
					//貨幣タイプであれば、3桁区切りをしているカンマを削除
					if ($ei['money']!=null){
						$val=str_replace(',', '', $val);
					}
					
					$list[$i][$ei['name']]=$val;
				}
			}

		}
		
		return $list;
			
	}
	
	//▼スコープ（POST,GET,SESSIONのいずれかの参照を取得）
	private function getScope($scopeType){
		switch($scopeType){
			case 'post':
				$scope=&$_POST;
				break;
			case 'get':
				$scope=&$_GET;
				break;
			case 'session':
				$scope=&$_SESSION;
				break;
				
		}
		
		return $scope;
	}
	
	
}
?>