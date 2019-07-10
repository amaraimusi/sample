<?php 

$fn1='test.jpg';
$ary1= getimagesize ( $fn1 );
$m_sizeX1=$ary1[0];
$m_sizeY1=$ary1[1];


$fn2='siro.png';
$ary2= getimagesize ( $fn2 );
$m_sizeX2=$ary2[0];
$m_sizeY2=$ary2[1];

?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>画像の大きさ（縦横幅）を取得する方法</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		
		<script>


		</script>
		
		<style type="text/css">
			
		</style>
		
	</head>
	<body>
		<div id="page1">
		<h1 id="header">画像の大きさ（縦横幅）を取得する方法</h1>
		<div id="content" >
			<form name="form1"  action="#" method="post" enctype="multipart/form-data" >
				<div class="sec1">
				
					サンプル
<pre>
$fn1='test.jpg';
$ary1= getimagesize ( $fn1 );
$m_sizeX1=$ary1[0];
$m_sizeY1=$ary1[1];
</pre>
					<table>
						<tr>
							<td><img src='test.jpg' width="200" /></td>
							<td><img src='siro.png' width="200" /></td>
						</tr>
						<tr>
							<td><?php echo $m_sizeX1.','.$m_sizeY1; ?></td>
							<td><?php echo $m_sizeX2.','.$m_sizeY2; ?></td>
						</tr>
					</table>

				</div><!-- sec1 -->
			</form>
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/09/03</div>
		</div><!-- page1 -->
	</body>
</html>