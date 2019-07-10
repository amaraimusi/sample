<?php 
require_once '../../../zss_lib/common.php';
require_once '../../../zss_lib/combbox_html_creater.php';
require_once '../../../zss_lib/radio_html_creater.php';


$data[0]['value']=0;
$data[0]['text']='猫';
$data[1]['value']=1;
$data[1]['text']='犬';
$data[2]['value']=2;
$data[2]['text']='山羊';
$data[3]['value']=3;
$data[3]['text']='イグアナ';
$defVal=1;


$cbHtmlCrt=new CombboxHtmlCreater();
$m_cbHtml=$cbHtmlCrt->createHtml('animal',$defVal,$data);

$radioHtmlCrt=new RadioHtmlCreater();
$m_radioHtml=$radioHtmlCrt->createHtml('animal',$defVal,$data);

?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>コンボボックスおよびラジオボタンのＨＴＭＬ生成</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script>

		</script>
		
		<style type="text/css">
			
		</style>
		
	</head>
	<body>
		<div id="page1">
		<div id="header">コンボボックスおよびラジオボタンのＨＴＭＬ生成</div>
		<div id="content" >
		
			<div class="sec1">
				<h4>コンボボックス</h4>
				<?php echo($m_cbHtml);?>
			</div><!-- sec1 -->
			<div class="sec1">
				<h4>ラジオボタン</h4>
				<?php echo($m_radioHtml);?>
			</div><!-- sec1 -->
			
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/03/20</div>
		</div><!-- page1 -->
	</body>
</html>