<?php

require_once 'input_check_ex.php';
require_once 'i_entity_info.php';



/**
 * データの入力チェック。（データはエンティティのリスト）
 * @author user01
 *2011/7/22	新規作成
 */
class InputCheckEx2{
	

	
	//▼拡張入力チェックオブジェクト
	var $ice;
	
	public static function getInstance(){
		
		
		if(!$_REQUEST['InputCheckEx2']){
			$obj=new InputCheckEx2();
			$_REQUEST['InputCheckEx2']=&$obj;
		}else{
			$obj=&$_REQUEST['InputCheckEx2'];
		}
		
		return $obj;

	}
	
	function InputCheckEx2(){
		$this->ice=new InputCheckEx();
	}
	
	

	/**
	 * エンティティをエンティティ情報を元に入力チェックする。
	 * @param unknown_type $ent　　入力対象エンティティ
	 * @param IEntityInfo $eiObj	エンティティ情報		
	 * @return 入力エラーがあった場合、エラーメッセージを返す。
	 */
	function checkEntity(&$ent,IEntityInfo &$eiObj){
		
		
		$ice=&$this->ice;
		if($ice->checkEntity($ent, $eiObj)==false){
			
			$errMsg=join('<br>',$ice->m_errMsgList);
			
			return $errMsg;
			
			
		}else{
		
			return null;
		}
	}
	
	

	/**
	 * データの入力チェックを行う。
	 * @param  $data　入力チェック対象データ
	 * @param IEntityInfo $eiObj　エンティティ情報オブジェクト
	 * @param  $dataName　データの名称。エラーメッセージに利用。省略可
	 * @return エラーメッセージ（入力エラーがあった場合）
	 */
	public function checkData(&$data,IEntityInfo &$eiObj,$dataName=null){
		
	
		
	
		//▼構成品エンティティリストの件数分、以下の処理を繰り返す。
		$i=1;
		foreach ((array)$data as $key => $ent){
			
			//▽構成品エンティティを入力チェックオブジェクトに渡し、入力チェックを行う。エラーメッセージリストを取得する。
			$errMsg=$this->checkEntity($ent,$eiObj);
			
			//▽エラーメッセージリストがnullでなければ、以下の処理を行う。
			if(isSet($errMsg)==true){
				//◇エラーメッセージリストからエラーメッセージを作成。
				$errMsg=$dataName.$i.'行目：'.$errMsg;
				
				//◇エラーメッセージリスト２にエラーメッセージを追加。
				$errMsgList2[$key]=$errMsg;
				
			}
			
			$i++;
		
		}
		
		//▼エラーメッセージリスト2がnullである場合、trueを返す。
		if(isSet($errMsgList2)==null){
			return null;
			
		
		//▼エラーメッセージリスト2がnullでない場合、以下の処理を行う。	
		}else{
			
			//▽エラーメッセージリストを<br />で連結する。（エラーメッセージ２の作成）
			$errMsg2=join('<br />',$errMsgList2);
			
			//▽エラーメッセージ２を返す。
			return $errMsg2;
		}
		
		
		
	}
}