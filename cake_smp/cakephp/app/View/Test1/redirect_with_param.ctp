<h1>覚書：リダイレクトでパラメータを送る</h1>

<?php
echo $this->Form->create('DataSet', array('url' => 'redirect_with_param'));
echo $this->Form->input('text1', array(
		'div'   => true,
		'label' => 'テキスト1',
		'class' => 'form-control',
));
echo $this->Form->submit('リダイレクト',array('name'=>'submit1',));
echo $this->Form->end(); 
?>

