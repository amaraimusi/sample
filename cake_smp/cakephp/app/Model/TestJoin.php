<?php
App::uses('Model', 'Model');

/**
 * TestJoinのモデル
 * ★概要
 * 外部結合したテーブルからデータを取得する方法のサンプル
 * ★履歴
 * 2014/4/24	新規作成
 * @author k-uehara
 *
 */
class TestJoin extends Model {

	var $name='TestJoin';

	var $useTable='test_bs';

	function findJoin(){


		//DBから取得するフィールド
		$fields=array('TestJoin.id',
			'TestJoin.anim_id',
		 	'TestJoin.shop_id',
		 	'TestC.anim_name'
		);

		// 		//検索条件情報から検索文を作成。
		// 		$conditions=$this->createKjConditions($kjs);


		//JOIN情報
		$joins = array(
				array(
						'type'       => 'left',//innerも指定可能
						'table'      => 'test_cs',
						'alias'      => 'TestC',
						'conditions' => array(
								'TestJoin.shop_id = TestC.shop_id AND TestJoin.anim_id = TestC.anim_id',
						),
				)

		);

		//DBからデータを取得
		$data = $this->find(
				'all',
				Array(
						'fields'=>$fields,
						'joins' =>$joins,
						//'conditions' => $conditions,
						//'order' => 'access_date',
						//'limit'=>$kjs['kj_limit']
				)
		);

// 		//サニタイズXSS(クロスサイトスクリプティング）対策。
// 		App::uses('Sanitize', 'Utility');
// 		for($i=0;$i<count($data);$i++){
// 			$data[$i]['TestJoin']['item_code']=Sanitize::html($data[$i]['TestJoin']['item_code']);
// 			$data[$i]['Item']['item_name']=Sanitize::html($data[$i]['Item']['item_name']);

// 		}


		return $data;
	}







}