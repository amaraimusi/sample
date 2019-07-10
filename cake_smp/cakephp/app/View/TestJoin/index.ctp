
<div>
TestJoinのテストページです。
</div>
<hr />


<table border="1">
<thead><tr><th>ID</th><th>anim_id</th><th>shop_id</th><th>anim_name</th>
<tbody>
<?php


	for($i=0;$i<count($findData);$i++){
		echo "<tr>";
		$ent=$findData[$i]['TestJoin'];
		foreach($ent as $val){
			echo "<td>{$val}</td>";
		}
		$ent=$findData[$i]['TestC'];
		foreach($ent as $val){
			echo "<td>{$val}</td>";
		}


		echo "</tr>\n";
	}
?>
</tbody>
</table>
<br />





