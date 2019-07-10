<h2>Hash::exitract | 多重配列から必要な情報だけを抽出</h2>
<br><br>
<hr>


<div>元データ:$ary</div>
<?php var_dump($ary)?>
<hr>


<div>ソースコード
id>103の式で絞り込む。
</div>
<pre>$ary2=Hash::extract($ary, '{n}[id>103]');</pre>
<div>抽出後のデータ:$ary2</div>
<?php echo var_dump($ary2)?>
<br><br><hr><br><br>


<div>ソースコードその２<br>
idのみ配列として抜き出す。
</div>
<pre>$ary3=Hash::extract($ary, '{n}.id');</pre>
<div>抽出後のデータ:$ary3</div>
<?php echo var_dump($ary3)?>