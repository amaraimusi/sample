<?php
App::uses('AppController', 'Controller');
/**
 * テスト
 * ☆履歴
 * 2014/9/19	新規作成
 * @author k-uehara
 *
 */
class TestFileuploadController extends AppController {
	public $name = 'TestFileupload';
	public $uses=array('TestFileupload');


	public function index() {

		$img_fn=null;

		//UPLOADボタンが押されたとき、遺憾処理を行う。
		if ($this->request->is('post')) {

			//バリデーション（ファイルの種類や、ファイルサイズのチェック）
			$this->TestFileupload->set($this->request->data['Neko']);
			if ($this->TestFileupload->validates($this->request->data['Neko'])){

				//アップロード画像ファイル情報を取得
				$image = $this->request->data['Neko']['smp_img'];

				//アップロードする画像ファイルの名前を指定する。
				$img_fn="img/TestFileupload/sample.jpg";

				//一時ファイルからコピー
				move_uploaded_file($image['tmp_name'], $img_fn);

			}else{
				$errors=$this->TestFileupload->validationErrors;//入力チェックエラー情報を取得
				Debugger::dump($errors);
			}



		}


		$this->set(array(
				'img_fn'=> $img_fn,
		));

	}


}