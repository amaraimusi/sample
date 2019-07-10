
<h1>基本入力画面</h1>


<?php
// 	echo $this->Form->create('Neko', array(
// 		'inputDefaults' => array('url'=>'reg/','label' => false, 'div' => false, 'legend' => false),
// 			'class' => 'bs-example form-horizontal'
// 		));

	echo $this->Form->create('Neko', array('url' => 'reg/'));


?>

<fieldset>

	<?php


		echo $this->Form->input('val1', array(
			'div'   => true,
			'label' => '値1',
			'class' => 'form-control',
		));

		echo $this->Form->input('text1', array(
				'div'   => true,
				'label' => 'テキスト1',
				'class' => 'form-control',
		));



		echo $this->Form->input('test_date', array(
				'label' => __('Date', true),
				'default' => date('Y-m-d H:i', null),
				'timeFormat' => '24',
				'dateFormat' => 'YMD',
				'monthNames' => false,
				'empty' => false,
				'separator' => '/',
				'maxYear' => date('Y'),
		));

		echo $this->Form->input('test_dt', array(
				'div'   => true,
				'label' => 'テスト時刻',
				'class' => 'form-control',

		));

//val1,text1,test_date,test_dt

	?>


	<?php echo $this->Form->submit('登録', array('div' => false, 'class' => 'btn btn-primary')); ?>

</fieldset>
<?php echo $this->Form->end(); ?>




