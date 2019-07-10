<?php

require_once '../../../zss_lib/common.php';
require_once '../../../zss_lib/dao_for_mysql.php';

/**
 * 拡張DAO
 * ☆概要
 * 接続情報が記述されている。
 * ☆履歴
 * 2012/6/9	新規作成
 * 2013/8/20 auth_baseテスト用にする。
 * @author k.uehara
 *
 */
class DaoEx extends DaoForMysql{
	
	/**
	 * 当クラスのインスタンスを返す。<br>
	 * 不完全なシングルトンパターンを適用。（インスタンスは一回のリクエスト中でしか保持されない。）<br>
	 * @return DaoForMySql2
	 */
	public static function getInstance(){
		
		
		if(!$_REQUEST['DaoEx']){
			$obj=new DaoEx();
			$_REQUEST['DaoEx']=&$obj;
		}else{
			$obj=&$_REQUEST['DaoEx'];
		}
		
		return $obj;

	}
	/* 
	 * DBコネクションを取得する。
	 */
	function getConnectionEx(){
	
		$config['db_type']='mysql';
		$config['db_host']='localhost';
		$config['db_name']='my_sample';
		$config['db_user']='root';
		$config['db_pass']='neko';
		

		return $this->getConnection($config);
	}
}