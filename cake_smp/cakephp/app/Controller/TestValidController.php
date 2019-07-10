<?php
App::uses('AppController', 'Controller');
require_once '../Vendor/ZssLib2/ADebug.php';//■■■□□□■■■□□□■■■□□□

class TestValidController extends AppController {
	public $name = 'TestValid';

	//public $uses = array ('TestValid,TestB');

	public function index() {
		if ($this->request->is('post')) {
			$this->TestValid->set($this->request->data);
			if ($this->TestValid->validates()){
				echo 'バリデーションOK';
			} else {
				echo 'バリデーションNG';
			}
		}
	}



}