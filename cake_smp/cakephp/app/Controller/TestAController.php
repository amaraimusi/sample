<?php
App::uses('AppController', 'Controller');
require_once '../Vendor/ZssLib2/ADebug.php';//■■■□□□■■■□□□■■■□□□

class TestAController extends AppController {
	public $name = 'TestA';
	public $uses = array ('TestA');

	function index() {
		Debugger::dump('TestAのテスト');//■■■□□□■■■□□□■■■□□□





		//findのテスト
		$findData=$this->TestA->find1();




		$this->set(array (
				'findData' => $findData,
				'usi' => 'XXX'
		));

	}

	/**
	 * テストデータの登録1
	 */
	function reg1(){


		$this->TestA->saveTestAData();

		$error = $this->validateErrors($this->TestA);
		Debugger::dump($error);//■■■□□□■■■□□□■■■□□□

		$this->set(array (
				'nezumi' => 'テストデータ登録処理完了',
				'usi' => 'ウシreg'
		));

	}


	public function test_nezumi(){
		//App::uses('Vendor', 'ADebug');//■■■□□□■■■□□□■■■□□□
		require_once '../Vendor/ADebug.php';
		//require_once 'rakuten/Vendor/ADebug.php';
		a_debug('testNezumi メソッド開始');//■■■□□□■■■□□□■■■□□□

// 		$b=new TestB();
// 		$b->find1();
		App::uses('TestB','Model');
		$this->TestB=new TestB();
		$this->TestB->find1();

	}

}