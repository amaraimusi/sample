<?php

require_once 'dao_for_mysql.php';
require_once 'common.php';

/**
 * 更新系SQL実行の基本クラス
 * @author uehara
 * @date 2010/11/02
 */
abstract class SqlExcuteBase{
	///エラーメッセージリスト
	var $m_errMsgs;
	
	///エラーストップフラグ。trueである場合、DBエラーが発生した場合、エラーを表示して全体的な処理を強制終了
	var $m_errStopFlg;
	
	///テーブル毎フィールドリスト
	var $m_tblFields;
	
	/**
	 * コネクションを取得する。
	 * 引数のコネクションがnullでない場合は、このコネクションを利用し、
	 * nullである場合は、新たにコネクションを生成する。
	 * @param unknown_type $prm_conn
	 * @return unknown
	 */
	protected function open(&$prm_conn){
		if ($prm_conn){
			$conn=$prm_conn;
		}else{
			$dao=new DaoForMySql();
			$conn=$dao->getDaoConnection();

		}
		return $conn;
	}
	
	/**
	 * コネクションと閉じる。ただし引数のコネクションがnullではない場合は閉じない。
	 * @param unknown_type $prm_conn
	 * @param unknown_type $conn
	 */
	protected function close(&$prm_conn,&$conn){
		if(!$prm_conn){
			mysql_close($conn);
		}
	}
	
	
	/**
	 * SQL実行エラーがあれば、エラーメッセージを作成します。
	 */
	protected function setErrMsg($sql,$conn){
			
			if(mysql_errno($conn)){
				
				
				$errMsg='SQLの実行エラーです。  '
					.'Error No:      '.mysql_errno($conn).'\n  '
					.'Error Mesage:  '.mysql_error($conn).'\n  '
					.'Error SQL:     '.$sql;
				$this->m_errMsgs[sizeof($this->m_errMsgs)]=$errMsg;
				
				errLog($sql);
				if($this->m_errStopFlg==true){
					echo 'DBエラー：'.$sql;
					exit;
				}
			}
			
	}
	
	/**
	 * サニタイジングと更新用のデータを作成。
	 */
	protected function convertForRegValue(&$prm_ent){
		//▼サニタイジングとデータ加工

		foreach ($prm_ent as $key => $val){

			
			if($val===null || $val===''){//null値である場合、nullを設定。 0と''はnullとして扱われず
				$ent[$key]='null';
			}else{
				
//				if(is_numeric($val)){//数値である場合、シングルクォートでくくらず//電話番号など0から始まる文字列で倫理エラー
//					$ent[$key]=mysql_real_escape_string($val);
//				}else{
					$ent[$key]="'".mysql_real_escape_string($val)."'";
//				}
			}

			
		}
		return $ent;
	}
	
	
	/**
	 * DBに存在するフィールドのみを抽出。
	 * このメソッドはgetDataメソッドを実行した後に実行すること。
	 * @param  $ent　DBに存在するフィールドのみ抽出する。
	 */
	protected function fillingDbField($ent,$tableName,DaoForMysqlEx $daoEx,$conn){


		//▼DBからフィールド名を取得する。
		if(!$this->m_tblFields[$tableName]){
			$sql='SHOW COLUMNS FROM '.$tableName;
			$data=$daoEx->getData($sql,$conn);
			foreach ((array)$data as $i => $fent){
				$fields[$fent['Field']]=$fent['Field'];
			}
			$this->m_tblFields[$tableName]=$fields;
			
		}else{
			$fields=$this->m_tblFields[$tableName];
		}
	

		//▼抽出する。
		foreach ($ent as $key => $val){ 
			if(array_key_exists($key, $fields)){
				$ent2[$key]=$ent[$key];
			}
		}
		

		
		return $ent2;
	}
	
}
?>