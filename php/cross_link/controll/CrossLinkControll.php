<?php

require_once 'zss_lib/LoginCheckForSqlite.php';
require_once 'zss_lib/sanitaize_ex.php';
require_once 'zss_lib/common.php';
require_once 'controll/model/CrossLink.php';
class CrossLinkControll{

	var $m_data;

	public function action(){


		//認証
		$login=new LoginCheckForSqlite();
		$login->auth('index.php');



		$snz=new SanitaizeEx();





		$_POST=$snz->sanitaizeAfterReadingDb($_POST);


		$model=new CrossLink();

		//追加ボタンが押された場合の処理
		if(!empty($_POST['btn1'])){


			$model->saveEntity($_POST);


		//削除ボタンが押された場合
		}else if(!empty($_GET['del'])){

			$_GET=$snz->sanitaizeAfterReadingDb($_GET);
			$id=$_GET['id'];
			$model->del($id);

		}



		//一覧データを取得
		$this->m_data=$data=$model->getList();



	}



}

?>