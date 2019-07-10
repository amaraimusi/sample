<style>
	.code{
		color:#e75547;
		vertical-align:middle;
	}
	.dump pre{
		color:#0f750a;
		vertical-align:middle;
	}
</style>


<h1>CakePHP1.3とCakePHP2系のリクエストデータの違いを検証</h1>
2015/1/28に検証<br>

<?php


	echo $this->Form->create('Neko', array('url' => 'nobasu/'));


?>

<fieldset>

	<?php


		echo $this->Form->input('val1', array(
			'div'   => true,
			'label' => '値1',
			'value' => 12345,
			'class' => 'form-control',
		));

		echo $this->Form->input('text1', array(
				'div'   => true,
				'value' => 'いろはにほへと',
				'label' => 'テキスト1',
				'class' => 'form-control',
		));





	?>



	<?php echo $this->Form->submit('登録', array('div' => false, 'class' => 'btn btn-primary')); ?>

	<br><br><hr><br><br>

	<h2>検証結果</h2>
	<table border="1">
	<thead>
		<tr><th colspan="2">CakePHP1.3</th><th colspan="2">CakePHP2系</th></tr>
		<tr><th>コード</th><th>ダンプ</th><th>コード</th><th>ダンプ</th></tr>
	</thead>
	<tbody>
		<tr>
			<td class="code">$this->data</td>
			<td class="dump"><?php Debugger::dump($data13); ?></td>
			<td class="code">$this->request->data</td>
			<td class="dump"><?php Debugger::dump($data20); ?></td>
		</tr>
		<tr>
			<td class="code">$this->params['url']['url']</td>
			<td class="dump"><?php Debugger::dump($url13); ?></td>
			<td class="code">$this->request->url</td>
			<td class="dump"><?php Debugger::dump($url20); ?></td>
		</tr>
		<tr>
			<td class="code">$this->params['controller'];</td>
			<td class="dump"><?php Debugger::dump($controller13); ?></td>
			<td class="code">$this->request->controller;</td>
			<td class="dump"><?php Debugger::dump($controller20); ?></td>
		</tr>
		<tr>
			<td class="code">$this->action;</td>
			<td class="dump"><?php Debugger::dump($action13); ?></td>
			<td class="code">$this->request->action;</td>
			<td class="dump"><?php Debugger::dump($action20); ?></td>
		</tr>
		<tr>
			<td class="code">$this->params['pass'];</td>
			<td class="dump"><?php Debugger::dump($pass13); ?></td>
			<td class="code">$this->request->pass;</td>
			<td class="dump"><?php Debugger::dump($pass20); ?></td>
		</tr>
		<tr>
			<td class="code">$this->params['named'];</td>
			<td class="dump"><?php Debugger::dump($named13); ?></td>
			<td class="code">$this->request->named;</td>
			<td class="dump"><?php Debugger::dump($named20); ?></td>
		</tr>



	</tbody>
	</table>

</fieldset>
<?php echo $this->Form->end(); ?>




