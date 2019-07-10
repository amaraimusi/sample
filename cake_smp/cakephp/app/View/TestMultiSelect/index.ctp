<h1>Cakeのマルチセレクト（select 複数選択）</h1>


<?php

echo $this->Form->create('TestMultiSelect', array('url' => '#'));

//選択肢一覧
$sels = array('1' => 'ネコ', '2' => 'ネズミ', '3' => 'ウシ', '4' => 'トラ','5'=>'カニ','6'=>'カラス','7'=>'アグー');

//選択値
$ary=array('2','3','6');

//マルチセレクトを作成
echo $this->Form->input('test_list', array('type' => 'select',
		'options' => $sels, 'multiple' => true,
		'size' => 4, 'value' => $ary));


echo $this->Form->submit('サブミット');
echo $this->Form->end();

?>


