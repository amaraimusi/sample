<?php
App::uses('AppController', 'Controller');
App::uses('AppShell','Console/Command');
App::uses('MyShell','Console/Command');
/**
 * シェルを動かす
 * ☆履歴
 * 2014/8/22	新規作成
 * @author k-uehara
 *
 */
class TestShellController extends AppController {
	public $name = 'TestShell';
	public $uses=null;//モデルを使わない。

    public function index() {


    	$shell = new MyShell();
    	$shell->initialize();//シェルの初期化。シェル内のusesなどの処理
    	$shell->main();


    }
    
    public function kuro_neko(){
    	$this->autoRender = false;//ビューを使わない。
    	echo 'クーロンで呼び出す';
    	
    	
    	$this->log('黒猫のcron');
    }


}