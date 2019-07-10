<?php
App::uses('AppController', 'Controller');
require_once '../Vendor/ZssLib2/ADebug.php';//■■■□□□■■■□□□■■■□□□

class TestJoinController extends AppController {
	public $name = 'TestJoin';
	public $uses = array ('TestJoin');

	function index() {
		Debugger::dump('TestJoinのテスト');//■■■□□□■■■□□□■■■□□□


		//findのテスト
		$findData=$this->TestJoin->findJoin();



		$this->set(array (
				'findData' => $findData
		));

	}


}