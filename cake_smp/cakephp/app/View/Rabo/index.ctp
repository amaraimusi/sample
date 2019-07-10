<h1>実験場</h1>


<?php echo $this->Form->create('Rabo', array('url' => true ));

echo $this->Form->input('neko_name.0', array(
		'value' => 'ペルシャ',
));

echo $this->Form->input('neko_name.1', array(
		'value' => 'シャム',
));

echo $this->Form->submit('Submit', array(
		'name' => 'btn1',
));

echo $this->Form->end()
?>
