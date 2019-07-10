<?php

class DaoForSqlite{

	var $m_dsn='sqlite:cross_link.sqlite';

	var $m_pdo;



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
		return $rtn;
	}

	private function  getPdo(){
		if($this->m_pdo==null){
			$this->m_pdo=new PDO($this->m_dsn);
		}
		return $this->m_pdo;
	}


}



