<?php

/**
 * SQLite用DAO
 * ★履歴
 * 2014/5/2	新規作成
 * 2014/7/7 insData,getNewIdを追加
 * @author k-uehara
 *
 */
class DaoForSqlite{

	var $m_dsn='sqlite:cross_link.sqlite';

	var $m_pdo;








	/**
	 * エンティティをINSERTする。ID自動生成
	 * エンティティの並び順がDBのフィールド順と一致しない場合
	 *
	 * @param $ent 		エンティティ
	 * @param $tbl_name	テーブル名
	 * @param $id_name	ID名（省略可）
	 * @return 登録件数。登録失敗時は空白
	 *
	 */
	public function insData($ent,$tbl_name,$id_name='id'){

		//IDが空なら新IDを主としセットする。
		if(empty($ent[$id_name])){
			$ent[$id_name]=$this->getNewId($tbl_name,$id_name);
		}

		//キーリストと値リストを作成
		$keys=null;
		$vals=null;
		foreach($ent as $key => $val){
			$keys[]=$key;
			$vals[]="'" . $val ."'";
		}
		$strKeys=join($keys,",");
		$strVals=join($vals,",");

		$sql="INSERT INTO {$tbl_name}({$strKeys}) VALUES($strVals)";

		return $this->exec($sql);

	}

	/**
	 * 新IDを取得する。
	 * @param string $tbl_name	テーブル名
	 * @param string $id		IDフィールド名
	 */
	public function getNewId($tbl_name,$id_name='id'){
		$sql="SELECT MAX({$id_name}) as max_id FROM {$tbl_name}";
		$data=$this->find($sql);

		$newId=0;
		if(isset($data)){
			$newId=$data[0]['max_id']+1;
		}
		return $newId;
	}




	//★UPDATEする。
	public function updDataWhiteList($data,$tbl_name,$whiteList,$id_name='id'){

		$rs0=0;
		foreach($data as $ent){
			$id=null;
			$prps=null;
			foreach($whiteList as $i=> $key){

				if($key==$id_name){

					$id=$ent[$i];
				}else{
					$val=$ent[$i];
					$prps[]="{$key} = '{$val}'";
				}

			}
			$s_prps=join($prps,',');
			$sql="UPDATE {$tbl_name} SET {$s_prps} WHERE {$id_name} = '{$id}'";

			a_debug($sql);//■■■□□□■■■□□□■■■□□□

			//SQL実行
			$rs= $this->exec($sql);
			$rs0+=$rs;
		}

		return $rs0;
	}












	public function find($sql){
		$pdo = $this->getPdo();

		$entries = $pdo->query($sql);

		$data=null;
		if(!empty($entries)){
			foreach ($entries as  $row) {
				$ent=null;
				foreach($row as $key =>$val){
					$ent[$key]=$val;
				}
				$data[]=$ent;

			}
		}

		return $data;
	}


	public function exec($sql){
		$pdo = $this->getPdo();
		$rtn=$pdo->exec($sql);
		if(empty($rtn)){
			a_debug('$rtn='.$rtn);
		}
		return $rtn;
	}

	private function  getPdo(){
		if($this->m_pdo==null){
			$this->m_pdo=new PDO($this->m_dsn);
		}
		return $this->m_pdo;
	}




}



