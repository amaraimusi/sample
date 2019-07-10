<h1>擬似アプリケーションスコープ</h1>


<?php echo $this->Form->create('DataSet', array('url' => 'app_scope_test'));?>

	<?php
	echo $this->Form->input('neko_val', array(
			'id'=>'name',
			'value' => $neko_val,
			'type' => 'text',
			'label' => false,
			'div' =>false,
			'placeholder' => '-- 保存値 --',
			'style'=>'width:200px;',

	));
	echo $this->Form->submit('TEST',array('name'=>'test_btn','div'=>false));
	?>



<?php echo $this->Form->end(); ?>