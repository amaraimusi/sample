<?php //echo $html->charset("utf-8");?>
<div>
TestAのテストページです。
</div>
<hr />
<?php echo 'Hello world!!';?><br />


<?php echo $usi; ?><br />

<?php
// Debugger::dump($findData);//■■■□□□■■■□□□■■■□□□

// Debugger::dump(count($findData));//■■■□□□■■■□□□■■■□□□
?>
<table border="1">
<thead><tr><th>ID</th><th>値</th><th>テキスト</th><th>日付</th><th>日時</th>
<tbody>
<?php

	//foreach ($findData as $ary);{
	for($i=0;$i<count($findData);$i++){
		$ent=$findData[$i]['TestA'];
		echo "<tr>";
		foreach($ent as $val){
			echo "<td>{$val}</td>";
		}
		echo "</tr>\n";
	}
?>
</tbody>
</table>
<br />





