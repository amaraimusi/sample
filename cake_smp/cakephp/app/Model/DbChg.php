<?php
App::uses('Model', 'Model');

class DbChg extends Model {
	public $useTable = false;

	public function changeDbName($dbName,$DbConfig='default') {
		$this->setDataSource($DbConfig);
		$db = ConnectionManager::getDataSource($this->useDbConfig);
		$db->reconnect(array('database' => $dbName));
	}
	
}