<?php
App::uses('Model', 'Model');
class TestHasManyC extends Model {

	public $name = 'TestHasManyC';

	public $validate = array(
			'note' => array(

				'maxLength'=>array(
					'rule' => array('maxLength', 16),
					'message' => 'ノートは16文字以内です。'
				)
			),

	);

}