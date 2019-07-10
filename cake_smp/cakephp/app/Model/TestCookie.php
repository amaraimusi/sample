<?php
App::uses('Model', 'Model');
App::uses('ADebug','Vendor');//■■■□□□■■■□□□■■■□□□デバッグ関数集
class TestCookie extends Model {

	var $name='TestCookie';
	var $validate = array(
			'val1' => array(
					'range' => array(
							'rule' => array('range', 0, 10),
							'message' => '0より大きく10より小さい数を入力してください。'
					)
			)
	);

	function find1(){

		$res = $this->find(
				'all',
				Array(
						'conditions' => Array('Id >' => '3')
				)
		);

		return $res;
	}

	function saveTestCookieData(){
		Debugger::dump('デバッグsaveTestCookieData');//■■■□□□■■■□□□■■■□□□
		Debugger::log('デバッグsaveTestCookieData');//■■■□□□■■■□□□■■■□□□

		$data=$this->getSampleData1();
		$whitelist = array('id','val1','text1','test_date','test_dt');
		$ret = $this->saveAll($data, array('atomic' => true,'validate'=>'true'),$whitelist);

		Debugger::dump($ret);//■■■□□□■■■□□□■■■□□□
		//'atomic' => falseはコミットしない。
//	saveAllのオプションについて
// 		validate:
// 		false をセットすると、バリデーションが行われません。
// 		true をセットすると各レコードが保存される前にバリデーションが行われます。
// 		'first' をセットすると、レコードの保存が行われる前に、全てのレコードにバリデーションが行われます。
// 		'only' をセットすると、バリデートだけを行い、保存は行われません。



		//

		Debugger::dump($error);//■■■□□□■■■□□□■■■□□□
// 		if (in_array(false, $ret, true)) {
// 			// エラー処理
// 			Debugger::dump('登録に失敗したネズミ');//■■■□□□■■■□□□■■■□□□
// 		}else{
// 			Debugger::dump('登録に成功');//■■■□□□■■■□□□■■■□□□
// 		}


	}
	private function &getSampleData1(){
		$data=array(
				array('id' => '1','val1' => '1','text1' => 'ネコ','test_date' => '2014/4/1','test_dt' => '2014/12/12 00:00:00'),
				array('id' => '2','val1' => '2','text1' => 'ネズミ','test_date' => '2014/4/2','test_dt' => '2014/12/12 00:00:01'),

				array('id' => '4','val1' => '999999','text1' => 'トラ3','test_date' => '2014/4/4','test_dt' => '2014/12/12 00:00:03'),
				array('id' => '7','val1' => '7','text1' => 'サル','test_date' => '2014/4/3','test_dt' => '2014/12/12 00:00:02')
		);
		return $data;

	}

    function getTestCookieList() {
//         $query = array (
//             'conditions' => array (
//                 'rank_date like' => $rank_date,
//             ),
//             'order' => array ('word_id', 'rank')
//         );

//        	Debugger::dump('デバッグgetTestCookieList');//■■■□□□■■■□□□■■■□□□
//         Debugger::log($query);//■■■□□□■■■□□□■■■□□□

//         if (!empty($wordId)) {
//             $query['conditions']['word_id'] = $wordId;
//         }
//         if (!empty($shopId)) {
//             $query['conditions']['shop_id'] = $shopId;
//         }
//         if (!empty($itemCode)) {
//             $query['conditions']['item_code'] = $itemCode;
//         }
//         return $this->find('all', $query);
    }

}