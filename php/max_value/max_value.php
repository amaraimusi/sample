<?php 
require_once '../../../zss_lib/mysql_const.php';
?>


<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" /><!-- 髢ｾ�ｪ陷肴��ｿ�ｻ髫ｪ�ｳ邵ｺ霈披雷邵ｺ�ｪ邵ｺ�ｽ-->
		<title>型ごとの最大値・最小値</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script>


			
		</script>
		
		<style type="text/css">
			
		</style>
		
	</head>
	<body>
		<div id="page1">
		<div id="header">型ごとの最大値・最小値</div>
		<div id="content" >
		
			<div class="sec1">
			
				<table border="1">
					<thead><tr><th>型</th><th>最大値</th><th>最小値</th></tr></thead>
					<tbody>
						<tr><td>TINYINT</td><td><?php echo(TINYINT_MAX);?></td><td><?php echo(TINYINT_MIN);?></td></tr>
						<tr><td>SMALLINT</td><td><?php echo(SMALLINT_MAX);?></td><td><?php echo(SMALLINT_MIN);?></td></tr>
						<tr><td>MEDIUMINT</td><td><?php echo(MEDIUMINT_MAX);?></td><td><?php echo(MEDIUMINT_MIN);?></td></tr>
						<tr><td>INT</td><td><?php echo(INT_MAX);?></td><td><?php echo(INT_MIN);?></td></tr>
						<tr><td>BIGINT</td><td><?php echo(BIGINT_MAX);?></td><td><?php echo(BIGINT_MIN);?></td></tr>
						<tr><td>FLOAT</td><td><?php echo(FLOAT_MAX);?></td><td><?php echo(FLOAT_MIN);?></td></tr>
						<tr><td>DOUBLE</td><td><?php echo(DOUBLE_MAX);?></td><td><?php echo(DOUBLE_MIN);?></td></tr>
						<tr><td>DECIMAL</td><td><?php echo(DECIMAL_MAX);?></td><td><?php echo(DECIMAL_MIN);?></td></tr>
					</tbody>
				</table>


				<pre>			

				</pre>
			</div><!-- sec1 -->
			
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/03/20</div>
		</div><!-- page1 -->
	</body>
</html>