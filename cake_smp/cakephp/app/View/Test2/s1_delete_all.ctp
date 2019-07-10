<h2>データの削除 | deleteAll ：サンプル</h2>

<a href="http://book.cakephp.org/2.0/ja/models/deleting-data.html">公式ドキュメント</a><br>
<br>

deleteでは1行しか削除できないが、deleteAllで複数行をまとめて削除できる。<br>
トランザクションも効く。<br>
<br>


ソースコード
<pre>
$this-&gt;Neko-&gt;begin();//トランザクション開始
$this-&gt;Neko-&gt;<strong>deleteAll</strong>(array('text1'=&gt;'wani'));//複数行をまとめて削除
$this-&gt;Neko-&gt;commit();
</pre>
<br>

deleteAllで実行されるSQL
<pre>
SELECT `Neko`.`id` FROM `cake_smp`.`nekos` AS `Neko` WHERE `text1` = 'wani' GROUP BY `Neko`.`id`
DELETE `Neko` FROM `cake_smp`.`nekos` AS `Neko` WHERE `Neko`.`id` IN (16, 17)
</pre>
<br>

nekosテーブル
<table class="table">
	<thead>
		<tr><th>id</th><th>val1</th><th>text1</th><th>test_date</th><th>test_dt</th></tr>
	</thead>
	<tbody>
		<tr><td>15</td><td>3</td><td>yagi</td><td>2014/4/3</td><td>2014/12/12 0:00</td></tr>
		<tr><td>18</td><td>3</td><td>wani</td><td>2014/4/3</td><td>2014/12/12 0:00</td></tr>
		<tr><td>19</td><td>3</td><td>wani</td><td>2014/4/3</td><td>2014/12/12 0:00</td></tr>
		<tr><td></td></tr>

	</tbody>
</table>
<br>









