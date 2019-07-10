<h2>Hash:getの使い方</h2>
配列にパスを指定して1つだけ値を取得する。
<br><br>
<hr>


<div>元データ:$ary</div>
<?php var_dump($ary)?>
<hr>


<div>ソースコード</div>
<pre>$ary2=Hash::get($ary, 'yasai.0');</pre>
<hr>


<div>抽出後のデータ:$ary2</div>
<?php echo var_dump($ary2)?>