<?php

	require_once '../../../zss_lib/GetMimeType.php';


	if(!empty($_GET['fn'])){
		$fn=$_GET['fn'];
		$fn='files/'.$fn;
		$gmy=new GetMimeType();
		$mimeType=$gmy->getMime($fn);
		$m_msg=$fn." → MIME TYPE →".$mimeType;
	}
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>MIMEタイプの取得</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />

		<script>



		</script>

		<style type="text/css">

		</style>

	</head>

	<body>
		<div id="page1">
		<h1 id="header">MIMEタイプの取得</h1>
		<div id="content" >

			<div style="color:red">
				<?php echo $m_msg;?>
			</div><br />

			<table>
				<thead><tr><th>拡張子</th><th>ファイル名</th><th>テスト実行</th></tr></thead>
				<tbody>

					<tr><td>gif</td><td>kani.gif</td><td><input type="button" onclick="location.href='?fn=kani.gif'" value='MIME取得' ></td></tr>
					<tr><td>bmp</td><td>korogi.bmp</td><td><input type="button" onclick="location.href='?fn=korogi.bmp'" value='MIME取得' ></td></tr>
					<tr><td>png</td><td>kuroba.png</td><td><input type="button" onclick="location.href='?fn=kuroba.png'" value='MIME取得' ></td></tr>
					<tr><td>jpg</td><td>kuwagata.jpg</td><td><input type="button" onclick="location.href='?fn=kuwagata.jpg'" value='MIME取得' ></td></tr>
					<tr><td>php</td><td>php_info.php</td><td><input type="button" onclick="location.href='?fn=php_info.php'" value='MIME取得' ></td></tr>
					<tr><td>jpeg</td><td>tento.jpeg</td><td><input type="button" onclick="location.href='?fn=tento.jpeg'" value='MIME取得' ></td></tr>
					<tr><td>csv</td><td>test.csv</td><td><input type="button" onclick="location.href='?fn=test.csv'" value='MIME取得' ></td></tr>
					<tr><td>exe</td><td>ZSS_test_sound.exe</td><td><input type="button" onclick="location.href='?fn=ZSS_test_sound.exe'" value='MIME取得' ></td></tr>

				</tbody>
			</table>
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/09/03</div>
		</div><!-- page1 -->
	</body>
</html>