<?php
App::uses('Model', 'Model');
class TestHasManyB extends Model {

	public $name = 'TestHasManyB';

	public $validate = array(
			'kind' => array(

				'maxLength'=>array(
					'rule' => array('maxLength', 8),
					'message' => '種類は8文字以内です。'
				)
			),

	);


}