<?php
App::uses('AppController', 'Controller');
class TestMultiSelectController extends AppController {
	public $name = 'TestMultiSelect';

	var $uses = false;

    public function index() {

		//サブミットからデータを取得する。
    	if(isset($this->data['TestMultiSelect']['test_list'])){
    		Debugger::dump($this->data['TestMultiSelect']['test_list']);
    	}


    }


}