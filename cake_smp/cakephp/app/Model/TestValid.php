<?php
App::uses('Model', 'Model');

/**
 * テストバリデーション。DBと関連付けないでバリデード
 * @author k-uehara
 *
 */
class TestValid extends Model {
	var $name='TestValid';
	public $useTable = false;

	public $_schema = array(
			'input_text' => array(
					'type' => 'string',
					'length' => 10
			)
	);

	public $validate = array(
			'input_text' => array(
					'rule' => 'notEmpty'
			)
	);

// 	var $name='TestValid';
// 	var $validate = array(
// 			'val1' => array(
// 					'range' => array(
// 							'rule' => array('range', 0, 10),
// 							'message' => '0より大きく10より小さい数を入力してください。'
// 					)
// 			)
// 	);






}