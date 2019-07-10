<h2>Hash::combine | 多重配列から構造変換した配列を取得</h2>
下記の例ではよくあるパターンとして、キーを連番からIDに構造変換をする例を示す。
<br><br>
<hr>


<div>元データ:$ary</div>
<?php var_dump($ary)?>
<hr>


<div>ソースコード</div>
<pre>$ary2=Hash::combine($ary, '{n}.id','{n}');</pre>
<hr>


<div>抽出後のデータ:$ary2</div>
<?php echo var_dump($ary2)?>