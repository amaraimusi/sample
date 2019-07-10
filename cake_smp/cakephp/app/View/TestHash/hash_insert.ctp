<h1>Hash::insert | 配列にキーやパスを指定して値を挿入する</h1>

<hr>
<div>
<h2>基本</h2>
ソースコード
<pre>
$data=array(
		'neko'=>'ネコ',
		'yagi'=>'山羊',
);
$data2=Hash::insert($data, 'kani', 'カニ');
</pre><br>

出力
<?php 
	$data=array(
			'neko'=>'ネコ',
			'yagi'=>'山羊',
	);
	$data2=Hash::insert($data, 'kani', 'kani');
	
	Debugger::dump($data);
	Debugger::dump($data2);
	
?>
</div>
※配列も値として挿入可能

<br><br><hr><br><br>

<div>
<h2>{n}を使って複数のポイントに挿入する</h2>
ソースコード
<pre>
$data=array(
		array(
			'name'=>'虎次郎',
			'kind'=>'ネコ',
		),
		array(
			'name'=>'王大人',
			'kind'=>'犬',
		),
);
$data2=Hash::insert($data, '{n}.flg', 4);
</pre><br>

出力
<?php 
	$data=array(
			array(
				'name'=>'虎次郎',
				'kind'=>'ネコ',
			),
			array(
				'name'=>'王大人',
				'kind'=>'犬',
			),
	);
	$data2=Hash::insert($data, '{n}.flg', 4);
	
	Debugger::dump($data);//■■■□□□■■■□□□■■■□□□
	Debugger::dump($data2);//■■■□□□■■■□□□■■■□□□
	
?>
</div>
※パスは{n}だけでなく{s}も使える。