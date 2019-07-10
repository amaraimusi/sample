<h1>遷移元URL リファラ | $this->referer()</h1>
<br>


この画面をリンクしている元画面のURLを表示する。<br>

<table><thead><tr><th>コード</th><th>遷移元のURL</th></tr></thead>
	<tbody>
		<tr><td>$ref1 = $this->referer();</td><td><?php echo $ref1 ?></td></tr>
		<tr><td>$ref2 = env('HTTP_REFERER');</td><td><?php echo $ref2 ?></td></tr>
		<tr><td>$ref3 = env('HTTP_X_FORWARDED_HOST');</td><td><?php echo $ref3 ?></td></tr>

	</tbody>
</table>
<?php





?>



