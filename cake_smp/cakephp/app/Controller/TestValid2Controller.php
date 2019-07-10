<?php
App::uses('AppController', 'Controller');

class TestValid2Controller extends AppController {
	public $name = 'TestValid2';


	public function index() {




		$data=$this->getSampleData();//サンプルデータを取得

		$errs=null;
		if(!empty($this->data['TestValid2']['btn1'])){


			$errs=$this->getInputCheckErrMsg($data);
		}


		$this->set(array(
				'data'=>$data,
				'errs'=>$errs,
		));




	}

	/**
	 * 入力チェック結果のエラーメッセージをHTML文字列形式で取得する。
	 * 入力エラーがない場合はnullを返す。
	 * @return エラーメッセージ
	 */
	private function getInputCheckErrMsg($data){
		App::uses('TestValid2','Model');
		$this->TestValid2=new TestValid2();

		$errMsg=null;

		//データ件数分、以下の処理を繰り返す。途中で、エラーがあれば途中で処理抜け。
		foreach($data as $rowNo=>$ent){
			$this->TestValid2->set($ent);


			if ($this->TestValid2->validates($ent)){

			}else{
				$errMsg.="<br />\n";

				$errors=$this->TestValid2->validationErrors;//入力チェックエラー情報を取得
				if(!empty($errors)){
					$errMsg.= ($rowNo+1).'行目：';
					foreach ($errors  as  $err){

						foreach($err as $val){

							$errMsg.= $val.' ： ';

						}
					}

				}


			}
		}


		return $errMsg;
	}

	//サンプルデータを取得
	private function getSampleData(){

		$ary=array(
			array('kani' => '0','yagi' => '','buta' => 'a','tokage' => '1000',),
			array('kani' => '-1','yagi' => 'あ','buta' => '','tokage' => '1001',),
			array('kani' => '10','yagi' => 'ccc','buta' => '2012/2/29','tokage' => '1002',),
			array('kani' => '4','yagi' => 'ddd','buta' => '2012/12/32','tokage' => '1003',),
			array('kani' => '5','yagi' => 'eeeeee','buta' => '2012/12/16','tokage' => '1004',),
			array('kani' => '6.6','yagi' => 'fffff','buta' => '2012/12/17','tokage' => '1005',),
		);

		return $ary;
	}





}