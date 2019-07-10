<?php 

	$test=$_POST['text1'];
	if($test==null){
		$test="&lt;hr &gt;";
	}
	//$test=urldecode($test);//URL用にデコードする。
	$test=str_replace('&lt;','<',$test);
	$test=str_replace('&gt;','>',$test);
	$m_text1=$test;
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>タグ文字をHTMLとして反映させる</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script>

		</script>
		
		<style type="text/css">
			
		</style>
		
	</head>
	<body>
		<div id="page1">
		<h1 id="header">タグ文字をHTMLとして反映させる</h1>
		<div id="content" >
			<form name="form1"  action="#" method="post" enctype="multipart/form-data" >
				<div class="sec1">
					<h3>URLエンコードされたタグ文字を再び、HTMLとマークアップとして認識させるには？</h3>
					文字列、置換する方法がある。<br />
					(例)
					<pre>
$test=str_replace('&lt;','<',$test);
$test=str_replace('&gt;','>',$test);
					</pre>
					
					<hr />
					<h3>タグ文字をHTMLとして反映させるテスト</h3>
					
					<input type="text" name="text1" value="<?php echo($m_text1);?>" />
					<input type="submit" name="submit1" value="テスト" />
					テスト結果：<br />
					<?php echo($m_text1);?>

					
				</div><!-- sec1 -->
			</form>
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/10/08</div>
		</div><!-- page1 -->
	</body>
</html>