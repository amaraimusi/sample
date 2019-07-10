<?php
App::uses('Model', 'Model');

/**
 * テストバリデーション。DBと関連付けないでバリデード
 * @author k-uehara
 *
 */
class TestValid2 extends Model {
	var $name='TestValid2';
	public $useTable = false;


	public $validate = array(


			'kani' => array(
					'naturalNumber'=>array(
							'rule' => array('naturalNumber', true),  // 0以上の整数
							'message' => 'kaniは0以上の自然数を入力してください。',
					),
					'range'=>array(
							'rule' => array('range', -1, 10),
							'message' => 'kaniは0～9の自然数を入力してください。'
					),
			),

			'yagi' => array(

				'notEmpty'=>array(
					'rule' => 'notEmpty',
					'message' => 'yagiは空白禁止です'
				),
				'custom'=>array(
					'rule' => array( 'custom', '/^[a-zA-Z0-9_\-.!~|]*$/' ),
					'message' => 'yagiは半角英数と特定の記号( -_.!~ )以外は入力できません。'
				),
				'maxLength'=>array(
					'rule' => array('maxLength', 5),
					'message' => 'yagiは5文字以内です。'
				)
			),

			'buta'=> array(
					'rule' => array( 'date', 'ymd'),
					'message' => '日付は日付形式【yyyy-mm-dd】で入力してください。',
					'allowEmpty' => true
			),
	);







}