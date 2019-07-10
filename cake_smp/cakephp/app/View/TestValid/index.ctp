<div>
<h1>DBと連動しないバリデーションテスト</h1>
</div>
<br /><hr /><br />

<div>
DBと連動しないとはいえ、入力フォームとは密接な関係があるので注意。
</div>
<div style="padding-left:20px">


<?php
	echo $this->Form->create('TestValid');
	//echo $this->Form->input('input_text');

	echo $this->Form->input('input_text', array(
			'value' => 'dummy',
			'type' => 'text',
			'class' => 'form-control',
			'style' => 'width:150px;float:left;',
			'placeholder' => '-- 商品コード --',
			'label' => false,
	));

	echo $this->Form->end(__('Submit'));
?>

</div>
<br /><br /><hr />




