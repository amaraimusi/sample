<h1>Hash::検証</h1>



	
	
	<p>検証0</p>
	<pre>

	</pre>
	出力
	<pre style="background-color:#e7e7e7">

	</pre>
	<br><hr><br>





<?php 


$data = array(
		array('Animal' => array('id' => 1, 'parent_id' => null)),
		array('Animal' => array('id' => 2, 'parent_id' => 1)),
		array('Animal' => array('id' => 3, 'parent_id' => 1)),
		array('Animal' => array('id' => 4, 'parent_id' => 2)),

);

// $result = Hash::nest($data, array('root' => 6));

// Debugger::dump($result);//■■■□□□■■■□□□■■■□□□

// 	$data=	array(
// 		'neko' => 'ネコ',
// 		'kani' => 'カニ',
// 		'sakana' => array(
// 			'same' => 'サメ',
// 			'medaka' => 'メダカ'
// 		)
// 	);

	$data2=Hash::nest($data,array('root' => 0));
	
	Debugger::dump($data2[0]["children"]);//■■■□□□■■■□□□■■■□□□
// 	echo '<pre>';
// 	echo var_dump($data2);
// 	echo '</pre>';
	
	
?>

