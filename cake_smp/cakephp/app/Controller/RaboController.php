<?php


App::uses('AppController', 'Controller');

/**
 * 実験用
 * @note
 * @author k-uehara
 *
 */
class RaboController extends AppController {
	public $name = 'Rabo';
	public $useTable = false; /* データベースのテーブルを使用しない */
	
	
	
	
    public function index() {

    	Debugger::dump('test=');//■■■□□□■■■□□□■■■□□□
    	debug('test');//■■■□□□■■■□□□■■■□□□
    	
		// Submitボタンが押された時の処理
		if($this->request->data){
			Debugger::dump($this->request->data);//■■■□□□■■■□□□■■■□□□
		}
		
    }




}