<?php


App::uses('AppController', 'Controller');
class NekoController extends AppController {
	public $name = 'Neko';

    public function index() {

//     	//POSTにデータがある場合、更新ボタンおよび追加ボタンの処理と判定し、DB登録を行う。
//         if (!empty($this->request->data)) {

//         	//POSTデータをDB登録
//             $this->Neko->saveAll($this->request->data['Neko']);

//             //入力チェックエラーメッセージを取得。
// 			$errMsg=$this->getInputCheckErrMsg();

//             //処理結果のメッセージをビューに送る。
//             $this->Session->setFlash('<div class="alert alert-info">更新しました</div>'.$errMsg);

//             //自画面にリダイレクト遷移。
//             $this->redirect('/neko/');
//         }

//         //ワード一覧情報をDBより取得
// 		$this->set(array(
// 			'nekoList' => $this->Neko->find('list', array ('fields' => array ('id', 'neko'),'conditions' => array ('del_flg' => 0))),
//         ));

    	$date_option = array(
    			'minYear' => 1930,
    			'maxYear' => date('Y'),
    			'separator' => array('年','月','日'),
    			'value' => array('year' => date('Y'),'month' => date('m'),'day' => date('d')),
    			'monthNames' => false
    	);
    	$this->set(array(
    			'date_option'=> $date_option,
    	));
    }

    /**
     * 入力チェック結果のエラーメッセージをHTML文字列形式で取得する。
     * 入力エラーがない場合はnullを返す。
     * @return エラーメッセージ
     */
    private function getInputCheckErrMsg(){
    	$errors=$this->Neko->validationErrors;//エラー情報を取得。

    	$errMsg=null;

    	//$errorsがnullではないとき、入力エラーがあるため、以下のエラーメッセージ生成を行う。
    	if(!empty($errors)){
    		$errMsg="<div style='color:red'>";
    		foreach ($errors  as $rowNo=> $err){
    			foreach($err as $val){

    				//$valが配列である場合、更新ボタン時のエラーメッセージを作成。
    				if(is_array($val)){

    					foreach($val as  $val2){

    						$errMsg.= ($rowNo+1).'行目：'.$val2.'<br />';
    					}

    				//追加ボタンの時のエラーメッセージ
    				}else{
    					$errMsg.= $val.'<br />';
    				}


    			}
    		}
    		$errMsg.="</div>";
    	}

    	return $errMsg;
    }

    public function reg(){
    	$this->Neko->save($this->request->data['Neko']);
    }



    /**
     * CakePHP1.3とCakePHP2系の違いを検証
     */
    public function nobasu(){

    	$data13=$this->data;
    	$data20=$this->request->data;

    	$url13=null;
		if(!empty($this->params['url']['url'])){
			$url13=$this->params['url']['url'];
		}
    	$url20=$this->request->url;

    	$controller13=$this->params['controller'];
    	$controller20=$this->request->controller;

    	$action13 = $this->action;
    	$action20 = $this->request->action;

    	$pass13 = $this->params['pass'];
    	$pass20 = $this->request->pass;

    	$named13 = $this->params['named'];
    	$named20 = $this->request->named;


    	$this->set('data13',$data13);
    	$this->set('data20',$data20);

    	$this->set('url13',$url13);
    	$this->set('url20',$url20);

    	$this->set('controller13',$controller13);
    	$this->set('controller20',$controller20);

    	$this->set('action13',$action13);
    	$this->set('action20',$action20);

    	$this->set('pass13',$pass13);
    	$this->set('pass20',$pass20);

    	$this->set('named13',$named13);
    	$this->set('named20',$named20);
    }













}