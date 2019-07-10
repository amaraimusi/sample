<?php
App::uses('Model', 'Model');
class TestHasManyA extends Model {

	public $name = 'TestHasManyA';

	//アソシエーション（モデル連結）hasManyは1:多の関係を表す。
	public $hasMany = array(
			'TestHasManyB' => array(
					'className'     => 'TestHasManyB',
					'foreignKey'    => 'test_has_many_a_id',
					'dependent'     => true //連動削除
			),
			'TestHasManyC' => array(
					'className'     => 'TestHasManyC',
					'foreignKey'    => 'test_has_many_a_id',
					'dependent'     => true //連動削除
			),
	);

	//バリデーション情報
	public $validate = array(
			'name' => array(

				'maxLength'=>array(
					'rule' => array('maxLength', 5),
					'message' => '一般名は5文字以内です。'
				)
			),

	);


}