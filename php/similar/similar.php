

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>文字の一致率 | レーベンシュタイン距離 | similar_text</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script>

		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">文字の一致率 | レーベンシュタイン距離 | similar_text</h1>
		<div id="content" >


			<div class="sec1">
				似ている２つの文字列を比較し、一致率として数値化できるsimilar_text関数をテストしてみる。
				
				<hr>
				<p>型</p>
				文字列1（$str1）と文字列2（$str2）の一致率を算出する例。
				<pre>
	$percent=null;
	similar_text($str1,$str2,$percent);//一致率ポインタを渡す。
	echo $percent;// ← 一致率
				</pre>
				
				<hr>
				<p>ソースコード</p>
				<pre>
	&lt;table border="1"&gt;&lt;thead&gt;&lt;tr&gt;&lt;th&gt;文字列1&lt;/th&gt;&lt;th&gt;文字列2&lt;/th&gt;&lt;th&gt;一致率&lt;/th&gt;&lt;th&gt;返値&lt;/th&gt;&lt;/tr&gt;&lt;/thead&gt;
	&lt;tbody&gt;
		&lt;?php
		
		$data[]=array('neko','neko');
		$data[]=array('neko','neko2');
		$data[]=array('neko','neo');
		$data[]=array('neko','neo2');
		$data[]=array('吾輩は猫である。','私は猫である');
		$data[]=array('問い合わせ番号','問い合わせNO');
		$data[]=array('問合せNO','問い合わせNO');
		$data[]=array('お問い合せNo.','問い合わせNO');
		$data[]=array('おといあわせ','問い合わせNO');
		$data[]=array('問合NO','問い合わせNO');
		$data[]=array('あいうえおNo','問い合わせNO');
		$data[]=array('あいうえお','問い合わせNO');
		$data[]=array('信長の野望　創生期','信長の野望　革新');
		$data[]=array('シヴィライゼーション4','シヴィライゼーション4 ウォーロード');

		foreach ($data as &amp;$ent){
			$v=<strong>similar_text</strong>($ent[0],$ent[1],$percent);//★
			$percent = round($percent,2);
			echo "&lt;tr&gt;&lt;td&gt;{$ent[0]}&lt;/td&gt;&lt;td&gt;{$ent[1]}&lt;/td&gt;&lt;td&gt;{$percent}&lt;/td&gt;&lt;td&gt;{$v}&lt;/td&gt;&lt;/tr&gt;";
		}
		unset($ent);

		?&gt;
	&lt;/tbody&gt;
	&lt;/table&gt;
				</pre>

				<hr />
				<p>出力</p>
				<table border="1"><thead><tr><th>文字列1</th><th>文字列2</th><th>一致率</th><th>返値</th></tr></thead>
				<tbody>
					<?php
					
					$data[]=array('neko','neko');
					$data[]=array('neko','neko2');
					$data[]=array('neko','neo');
					$data[]=array('neko','neo2');
					$data[]=array('吾輩は猫である。','私は猫である');
					$data[]=array('問い合わせ番号','問い合わせNO');
					$data[]=array('問合せNO','問い合わせNO');
					$data[]=array('お問い合せNo.','問い合わせNO');
					$data[]=array('おといあわせ','問い合わせNO');
					$data[]=array('問合NO','問い合わせNO');
					$data[]=array('あいうえおNo','問い合わせNO');
					$data[]=array('あいうえお','問い合わせNO');
					$data[]=array('信長の野望　創生期','信長の野望　革新');
					$data[]=array('シヴィライゼーション4','シヴィライゼーション4 ウォーロード');

					foreach ($data as &$ent){
						$v=similar_text($ent[0],$ent[1],$percent);//★
						$percent = round($percent,2);
						echo "<tr><td>{$ent[0]}</td><td>{$ent[1]}</td><td>{$percent}</td><td>{$v}</td></tr>";
					}
					unset($ent);

					?>
				</tbody>
				</table>
			</div><!-- sec1 -->

		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/05/19</div>
		</div><!-- page1 -->
	</body>
</html>