<?php 
	require_once '../../../zss_lib/common.php';
	require_once '../../../zss_lib/auth_basic.php';
	require_once 'logic/dao_ex.php';

	$dao=new DaoEx();
	$cn=$dao->getConnectionEx();
	$auth=new AuthBasic();
	if($auth->auth($dao,$cn,'TestTblUser')==true){
		$m_ret='認証成功';
	}else{
		$m_ret='認証失敗';
		
	}
	mysql_close($cn);
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>ＰＨＰ　｜　Basic認証（ログイン）</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script>

		</script>
		
		<style type="text/css">
			
		</style>
		
	</head>
	<body>
		<div id="page1">
		<div id="header">ＰＨＰ　｜　Basic認証（ログイン）</div>
		<div id="content" >
		
			<div class="sec1">

				<?php echo($m_ret);?>
			</div><!-- sec1 -->
			
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/03/20</div>
		</div><!-- page1 -->
	</body>
</html>