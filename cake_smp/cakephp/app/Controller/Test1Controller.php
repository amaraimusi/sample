<?php
App::uses('AppController', 'Controller');
/**
 * テスト1
 * 小規模サンプルの集まり
 * ☆履歴
 * 2014/10/20	新規作成
 * @author k-uehara
 *
 */
class Test1Controller extends AppController {
	public $name = 'Test1';
	public $uses=null;//モデルを使わない。

    public function index() {

//     	$this->set(array(
//     			'date_option'=> $date_option,
//     	));
    }

    /**
     * h()関数の使い方
     */
    public function h_func(){

    }

    /**
     * 遷移元URL リファラ | $this->referer()
     */
    public function referer_test(){
    	$ref1=$this->referer();
    	$ref2 = env('HTTP_REFERER');
    	$ref3 = env('HTTP_X_FORWARDED_HOST');


    	$this->set('ref1',$ref1);
    	$this->set('ref2',$ref2);
    	$this->set('ref3',$ref3);


    }

    public function cake_mail_send(){

    	App::uses('CakeEmail', 'Network/Email');

     	$email = new CakeEmail();
     	$email->from(array('xx_test_xx@example.com' => 'My Site'));
     	$email->to('you_test@example.com');
     	$email->subject('hello world! subject');
     	$email->message('hello world!');


     	$msg=$email->message();

     	Debugger::dump('$msg');//■■■□□□■■■□□□■■■□□□
     	Debugger::dump($msg);//■■■□□□■■■□□□■■■□□□
     	Debugger::dump('$email');//■■■□□□■■■□□□■■■□□□
     	Debugger::dump($email);//■■■□□□■■■□□□■■■□□□
//     	$mailRespons = $email->config(array('log' => 'emails'))

//     	->template('text_mail', 'text_layout')

//     	->viewVars($ary_body)

//     	->from(array('*******@*******.com' => '*******@*******.com'))

//     	->to('*******@*******.com')

//     	->cc('*******@*******.com')

//     	->subject('テストタイトルですよ');

    	//->send();
  //  	Debugger::dump($mailRespons);//■■■□□□■■■□□□■■■□□□


    }



    /**
     * TEST 1-3
     *
     * サブミットボタンを配列化
     */
    public function submit_array(){


    	$this->set('data',$this->request->data);


    }

    /**
     * 他のCTPをレンダリング
     */
    public function other_ctp(){

    }
    
    /**
     * リダイレクトと共にパラメータも送る。
     */
    public function redirect_with_param(){
    	if(empty($this->request->data)){
    		return;
    	}
    	
    	$text1=$this->request->data['DataSet']['text1'];
    	$text2='yagi';
    	$this->redirect(array(
    			'controller' => 'test1',
    			'action' => 'redirect_with_param2',
    			$text1,
    			$text2,
    	
    	));
    	
    	
    	
    }
    public function redirect_with_param2($t1=null,$t2=null){
    	Debugger::dump($t1);
    	Debugger::dump($t2);
    }
    
    
    
    /**
     * 擬似アプリケーションスコープのテスト
     * 
     * DBテーブルを使用して擬似的にアプリケーションスコープを実現しています。
     * 
     * @date 2015-12-7 新規作成
     */
    public function app_scope_test(){
    	
    	//擬似アプリケーションスコープ
    	App::uses('AppScope','Model');
    	$appScope=new AppScope();
    	
    	
    	if(!empty($this->request->data['DataSet']['neko_val'])){
    		$neko_val=$this->request->data['DataSet']['neko_val'];
    		
    		//アプリケーションスコープの保存
    		$appScope->saveValue(array(
    			'neko_val'=>$neko_val,
    				));
    		
    	}

		//アプリケーションスコープテーブルから変数名または変数名配列を指定して、データセットを取得する。
    	$neko_val=$appScope->getValue('neko_val');
    	
    	$this->set(array(
    		'neko_val'=>$neko_val,
    	));
    	
    }


}