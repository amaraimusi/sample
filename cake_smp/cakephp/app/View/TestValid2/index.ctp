<div>
<h1>DB,入力フォームと連動しないバリデーションテスト</h1>
</div>
<br /><hr /><br />

<div>

※注意<br />
エンティティ単位で入力チェックは行われるので、エンティティ配列型のデータは注意。
</div>
<div style="padding-left:20px">

<div style="color:red" ><?php echo $errs;?></div>
<?php

echo $this->Form->create('TestValid2')."\n";


echo $this->Form->hidden('btn1', array('value'=>'1'))."\n";


echo $this->Form->end(__('Submit'))."\n";
?>
<br /><br />
<table border="1">

<?php


	foreach($data as $i=>$ent){

		if($i==0){

			echo '<thead><tr>';
			foreach($ent as $key => $val){

				echo "<th>{$key}</th>";
			}
			echo "</thead></tr>\n";
			echo "<tbody>\n";
		}

		echo "<tr>";
		foreach($ent as $key => $val){
			echo "<td>{$val}</td>";
		}
		echo "</tr>\n";

	}




?>
</body>
</table>

</div>
<br /><br /><hr />
















<div>

<strong>コントローラ【TestValid2Controller.php】</strong>
	<pre>

App::uses('AppController', 'Controller');

class TestValid2Controller extends AppController {
	public $name = 'TestValid2';


	public function index() {




		$data=$this->getSampleData();//サンプルデータを取得

		$errs=null;
		if(!empty($this->data['TestValid2']['btn1'])){


			$errs=$this->getInputCheckErrMsg($data);
		}


		$this->set(array(
				'data'=>$data,
				'errs'=>$errs,
		));




	}

	/**
	 * 入力チェック結果のエラーメッセージをHTML文字列形式で取得する。
	 * 入力エラーがない場合はnullを返す。
	 * @return エラーメッセージ
	 */
	private function getInputCheckErrMsg($data){
		App::uses('TestValid2','Model');
		$this->TestValid2=new TestValid2();

		$errMsg=null;

		//データ件数分、以下の処理を繰り返す。途中で、エラーがあれば途中で処理抜け。
		foreach($data as $rowNo=>$ent){
			$this->TestValid2->set($ent);


			if ($this->TestValid2->validates($ent)){

			}else{
				$errMsg.=&lt br />\n";

				$errors=$this->TestValid2->validationErrors;//入力チェックエラー情報を取得
				if(!empty($errors)){
					$errMsg.= ($rowNo+1).'行目：';
					foreach ($errors  as  $err){

						foreach($err as $val){

							$errMsg.= $val.' ： ';

						}
					}

				}


			}
		}


		return $errMsg;
	}

	//サンプルデータを取得
	private function getSampleData(){

		$ary=array(
			array('kani' => '0','yagi' => '','buta' => 'a','tokage' => '1000',),
			array('kani' => '-1','yagi' => 'あ','buta' => '','tokage' => '1001',),
			array('kani' => '10','yagi' => 'ccc','buta' => '2012/2/29','tokage' => '1002',),
			array('kani' => '4','yagi' => 'ddd','buta' => '2012/12/32','tokage' => '1003',),
			array('kani' => '5','yagi' => 'eeeeee','buta' => '2012/12/16','tokage' => '1004',),
			array('kani' => '6.6','yagi' => 'fffff','buta' => '2012/12/17','tokage' => '1005',),
		);

		return $ary;
	}





}
	</pre>
</div>

<hr />
<div>
<strong>モデル【TestValid2】</strong><br />
<pre>
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
</pre>
</div>

<hr />
<div>
<strong>ビュー【TestValid2/index.ctp】</strong><br />
エラー出力コードのみ
<pre>
&lt? php echo $errs;//エラー出力?>

</pre>
</div>


