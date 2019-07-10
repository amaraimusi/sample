<?php
App::uses('Model', 'Model');
class Neko extends Model {

	var $name='Neko';

// 	public $_schema = array(
// 			'input_text' => array(
// 					'type' => 'string',
// 					'length' => 10
// 			)
// 	);

	public $validate = array(

			'val1' => array(
					'naturalNumber'=>array(
							'rule' => array('naturalNumber', true),  // 0以上の整数
							'message' => 'アクセス人数は0以上の整数を入力してください。',
					),
					'range'=>array(
							'rule' => array('range', -1, 100),
							'message' => 'アクセス人数は0以上の整数を入力してください。(100未満)'
					),
			),
	);








}