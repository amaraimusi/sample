<?php 

	require_once '../../../zss_lib/common.php';
	require_once '../../../zss_lib/picture.php';
	
	
	$imgUrl='images/test0.jpg';//イメージＵＲＬ
	$thumUrl='thums/thums0.jpg';//サムネイルＵＲＬ
	
	//サムネイル生成サブミットボタンを押した時の処理
	if($_POST['submit1']!=null){
		$pic=new Picture();//画像関連クラス
		$ext='jpg';
		$sizeX=40;
		$sizeY=40;
		
		$pic->convertPicture($imgUrl,$ext,$sizeX,$sizeY,$thumUrl);//サムネイル画像を作成する。
		
	}
	
	//サムネイル生成サブミットボタンを削除したときの処理
	if($_POST['submit_del']!=null){
		unlinkEx($thumUrl);//拡張ファイル削除処理
		$thumUrl='';
	}
	
	
	
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>サムネイル生成</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		
		<script>

			
		</script>
		
		<style type="text/css">
			
		</style>
		
	</head>
	<body>
		<div id="page1">
		<div id="header">サムネイル生成</div>
		<div id="content" >
		<form name="form1"  action="thumbnail_php.php" method="post" enctype="multipart/form-data" >
			<div class="sec1">
				
				<input type="submit" name="submit1" value="サムネイル作成" />
				<input type="submit" name="submit_del" value="サムネイル削除" />
				<table border="1">
					<thead><tr><th>元画像</th><th>サムネイル画像</th></tr></thead>
					<tbody><tr>
						<td><img src="<?php echo($imgUrl);?>"></img></td>
						<td><img src="<?php echo($thumUrl);?>"></img></td>
					</tr></tbody>
				</table>
				
			</div><!-- sec1 -->
		</form>
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/09/03</div>
		</div><!-- page1 -->
	</body>
</html>