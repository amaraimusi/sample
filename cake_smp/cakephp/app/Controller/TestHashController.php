<?php
App::uses('AppController', 'Controller');
/**
 * テスト
 * ☆履歴
 * 2014/8/22	新規作成
 * @author k-uehara
 *
 */
class TestHashController extends AppController {
	public $name = 'TestHash';
	public $uses=null;//モデルを使わない。

    public function index() {

//     	$this->set(array(
//     			'date_option'=> $date_option,
//     	));
    }


    /**
     * Hash:getメソッドの使い方
     */
    public function test_get(){

    	$ary=$this->getSample1();

    	$ary2=Hash::get($ary, 'yasai.0');

		$this->set(array(
			'ary'=> $ary,
			'ary2'=> $ary2,
		));

    }


    private function getSample1(){

    	$ary=array(
    		0=>'dummy',
    		'yasai'=>array(
    			0=>'nasu',
    			'x'=>'tomato',
    		),
    		'animal'=>array(
    			'a1'=>'neko',
    			'a2'=>'inu',
    			'musi'=>array('kabuto','kuwagata'),
    		),
    		1=>'dummy2'
    	);

    	return $ary;
    }




    /**
     * Hash::combine | 多重配列から構造変換した配列を取得
     */
    public function test_combine(){

    	$ary=$this->getSample2();

    	$ary2=Hash::combine($ary, '{n}.id','{n}');

    	$this->set(array(
    			'ary'=> $ary,
    			'ary2'=> $ary2,
    	));

    }

    private function getSample2(){

    	$ary=array(
    			array('id'=>101,'name'=>'ネコ'),
    			array('id'=>102,'name'=>'ネズミ'),
    			array('id'=>103,'name'=>'ウシ'),
    			array('id'=>104,'name'=>'トラ'),
    			array('id'=>105,'name'=>'鵜'),
    			array('id'=>106,'name'=>'猿'),
    	);

    	return $ary;
    }


    /**
     * Hash:getメソッドの使い方
     */
    public function test_extract(){

    	$ary=$this->getSample2();

    	$ary2=Hash::extract($ary, '{n}[id>103]');

    	$ary3=Hash::extract($ary, '{n}.id');

    	$this->set(array(
    			'ary'=> $ary,
    			'ary2'=> $ary2,
    			'ary3'=> $ary3,
    	));

    }
    
    /**
     * Hash:insertメソッドの使い方
     */
    public function hash_insert(){
    
		
    
    }
    
    
    /**
     * 検証用
     */
    public function hash_test(){
    
    
    
    }
    
    
    


}