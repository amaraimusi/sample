<h1>サブミットボタンを配列化</h1>
<br><br><br>





	<?php echo $this->Form->create('DataSet', array('url' => 'submit_array'));?>




		<div style="color:#fb4804">


			▽リクエストの中身<br>
			<?php Debugger::dump($data); ?>
		</div>

		<div style ="border: solid 1px #112d65;margin-bottom:30px;">
			<div style="float:left">
				<?php
					echo $this->Form->submit('サブミットA1',array('name'=>'test.0','div'=>false));
					echo $this->Form->submit('サブミットA2',array('name'=>'test.1','div'=>false));

				?>
			</div>
			<div>
				ソースコード(test.ctp)
				<pre>
		echo $this->Form->submit('サブミットA1',array('name'=>'test.0'));
		echo $this->Form->submit('サブミットA2',array('name'=>'test.1'));
				</pre>

			</div>
			<div>
				キーがtest_0,test_1などのように「 _ 」で綴られている。<br>
				配列に近い形なので、コントローラ内でループによるサブミット判定に使える。<br>
				ひと手間かかりそうだが、これなら何とかサブミットボタンを配列として管理できるだろう。
			</div>
		</div>


		<div style ="border: solid 1px #112d65;margin-bottom:30px;">
			<div style="float:left">
			<?php

				echo $this->Form->submit('サブミットB1',array('name'=>'test[0]','div'=>false));
				echo $this->Form->submit('サブミットB2',array('name'=>'test[1]','div'=>false));

			?>
			</div>
			<div>
				ソースコード(test.ctp)
				<pre>
		echo $this->Form->submit('サブミットB1',array('name'=>'test[0]'));
		echo $this->Form->submit('サブミットB2',array('name'=>'test[1]'));
				</pre>
			</div>
			<div>
			サブミットボタンは「test」キーに配列がセットされている。<br>
			配列の要素を見るとサブミットB1,サブミットB2のキーはそれぞれ 0 , 1 となっている。<br>
			配列要素のキーを見れば、サブミットボタンを配列として管理できる。<br>
			</div>
		</div>


	<?php echo $this->Form->end(); ?>