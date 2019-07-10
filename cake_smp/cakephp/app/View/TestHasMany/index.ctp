<h1>結合モデルのデータ表示と更新 | hasMany</h1>


<table border="1">

	<thead>
		<tr><th>A_ID</th><th>一般名</th><th>テーブルBデータ</th><th>テーブルCデータ</th></tr>
	</thead>

	<tbory>
	<?php
	echo $this->Form->create('DataX', array('url' => '#'));
	foreach($data as $i=> $ary){

		echo "<tr>";
		$entA=$ary['TestHasManyA'];
		$id=$entA['id'];
		echo "<td>";
		echo $entA['id'];
		echo $this->Form->input("TestHasManyA.{$id}.id", array('type' => 'hidden','value' => $id,'label' => false,));
		echo "</td>\n";

		echo "<td>";
		echo $this->Form->input("TestHasManyA.{$id}.name", array('type' => 'text','value' => $entA['name'],'label' => false,));
		echo "</td>";

		//Bデータを表示
		$dataB=$ary['TestHasManyB'];
		echo "<td>\n<ul>";
		foreach($dataB as $i_b=> $entB){
			$id=$entB['id'];
			echo "<li>";
			echo $this->Form->input("TestHasManyB.{$id}.kind", array('type' => 'text','value' => $entB['kind'],'label' => false,));
			echo $this->Form->input("TestHasManyB.{$id}.id", array('type' => 'hidden','value' => $entB['id'],'label' => false,));
			echo $this->Form->input("TestHasManyB.{$id}.test_has_many_a_id", array('type' => 'hidden','value' => $entB['test_has_many_a_id'],'label' => false,));
			echo "</li>\n";
		}
		echo "</ul></td>\n";

		//Cデータを表示
		$dataC=$ary['TestHasManyC'];
		echo "<td>\n<ul>";
		foreach($dataC as $i_c=>$entC){
			$id=$entC['id'];
			echo "<li>";
			echo $this->Form->input("TestHasManyC.{$id}.note", array('type' => 'text','value' => $entC['note'],'label' => false,));
			echo $this->Form->input("TestHasManyC.{$id}.id", array('type' => 'hidden','value' => $entC['id'],'label' => false,));
			echo $this->Form->input("TestHasManyC.{$id}.test_has_many_a_id", array('type' => 'hidden','value' => $entC['test_has_many_a_id'],'label' => false,));

			echo "</li>\n";
		}
		echo "</ul></td>\n";
		echo "</tr>\n";

	}


	?>
	</tbory>
</table>


<?php
echo $this->Form->submit('DB更新');
echo $this->Form->end();
?>