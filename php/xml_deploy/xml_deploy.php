<?php	
require_once '../../../zss_lib/common.php';
$string = <<<XML
<?xml version='1.0'?> 
<document>
 <title>Forty What?</title>
 <from>Joe</from>
 <to>Jane</to>
 <body>
  I know that's the answer -- but what's the question?
 </body>
 <animal>
 	<neko>
 		<timo>ティモ</timo>
 		<bikke>ティモ</bikke>
 	</neko>
 </animal>
</document>
XML;
	
	//XML文字列データを展開し、XMLデータを作成。
	$xml = simplexml_load_string($string);

	//出力結果
	$m_ret=$xml->animal->neko->timo;
	
	//出力用にセット
	$m_testData=htmlspecialchars($string);//テストデータ
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>XMLデータの展開</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script>
			
		</script>
		
		<style type="text/css">
			
		</style>
		
	</head>
	<body>
		<div id="page1">
		<div id="header">XMLデータの展開</div>
		<div id="content" >
		
			<div class="sec1">
			
				<h4>テストデータ</h4>
				<pre>
<?php echo($m_testData);?>
				</pre>
				
				<hr />
				<h4>テストコード</h4>
				<pre>
$xml = simplexml_load_string($string);
$timo=$xml->animal->neko->timo;
echo($timo);
				</pre>
				
				<hr />
				
				<h4>出力結果</h4>
				<div class="console">
					<?php echo($m_ret);?>
				</div>

			</div><!-- sec1 -->
			
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/03/20</div>
		</div><!-- page1 -->
	</body>
</html>