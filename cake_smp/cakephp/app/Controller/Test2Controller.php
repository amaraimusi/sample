<?php
App::uses('AppController', 'Controller');
/**
 * テスト2
 * 小規模サンプルの集まり
 * 
 * @date 2016-6-9	新規作成
 * @author k-uehara
 *
 */
class Test2Controller extends AppController {
	public $name = 'Test2';
	public $uses=null;//モデルを使わない。

	public function s1_delete_all() {

		if(empty($this->Neko)){
			App::uses('Neko','Model');
			$this->Neko=ClassRegistry::init('Neko');
		}
		
		$data = $this->Neko->query('SELECT * FROM `nekos` WHERE 1');
		$this->Neko->begin();//トランザクション開始
		$this->Neko->query("INSERT INTO `nekos` ( `val1`, `text1`, `test_date`, `test_dt`) VALUES
				(3, 'wani', '2014-04-03', '2014-12-12 00:00:02'),
				( 3, 'wani', '2014-04-03', '2014-12-12 00:00:02');");
		$this->Neko->deleteAll(array('text1'=>'wani'));
		$this->Neko->commit();
		
	}
	
	
	public function change_db(){
		
		if($_SERVER['SERVER_NAME'] != 'localhost'){
			echo 'NO PAGE';
		}

		$dbName = "cake_smp";//←切り替えるデータベース名
		App::uses('DbChg','Model');
		$dbChg=ClassRegistry::init('DbChg');
		$dbChg->changeDbName($dbName);
		$res = $dbChg->query("SELECT * FROM  nekos");
		debug($res);
		
	}


}