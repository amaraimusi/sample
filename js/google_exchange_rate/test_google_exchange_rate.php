<?
require_once '../../zss_lib/common.php';
require_once '../../zss_lib/google_exchange_rate.php';



$m_curr='USD';//テスト通貨名
$m_val=3.5;//テスト通貨額
$ger=new GoogleExchangeRate();//google為替レートオブジェクトを生成
$m_jpy=$ger->exchangeToJPY($m_curr,$m_val);//日本円に変換


?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>google 為替レート</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script>

			function test_func1(){
				var x=document.getElementById('xxx1').innerHTML;
				alert(x);
			}
			
		</script>
		
		<style type="text/css">
			
		</style>
		
	</head>
	<body>
		<div id="page1">
		<div id="header">google 為替レート</div>
		<div id="content" >
		
			<div class="sec1">


				<table border="1">
					<thead><tr><th>プロパティ</th><th>値</th></tr></thead>
					<tbody>
						<tr><td>通貨名</td><td><?php echo($m_curr);?></td></tr>
						<tr><td>通貨額</td><td><?php echo($m_val);?></td></tr>
						<tr><td>日本円</td><td><?php echo($m_jpy);?></td></tr>
					</tbody>
				</table>
			</div><!-- sec1 -->
			
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/03/20</div>
		</div><!-- page1 -->
	</body>
</html>