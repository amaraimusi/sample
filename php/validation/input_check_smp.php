<?php 
	require_once '../../../zss_lib/common.php';
	require_once '../../../zss_lib/input_check_ex2.php';
	require_once '../../../zss_lib/input_check_ex.php';
	require_once '../../../zss_lib/inputCheckA.php';
	


	
	
	$str = 'PHPJP.com';

	$array = str_split($str,3);
	
	foreach($array as $i=>$v){
		debug($v);
	}
	

?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" /><!-- 髢ｾ�ｪ陷肴��ｿ�ｻ髫ｪ�ｳ邵ｺ霈披雷邵ｺ�ｪ邵ｺ�ｽ-->
		<title>入力チェック</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script>


		</script>
		
		<style type="text/css">
			
		</style>
		
	</head>
	<body>
		<div id="page1">
		<div id="header">入力チェック</div>
		<div id="content" >
		
		
			<div class="sec1">
				
				isDatetimeExのテスト<br />
				
				<pre>			
					$ret=$ic->isDatetimeEx($v,$reqFlg);
				</pre>
				
				<div class="console1">
				<?php 
					
					
					testIsDatetimeEx('2012/12/12 12:34:56',true);
					testIsDatetimeEx('2012/12/12 12:34:60',true);
					testIsDatetimeEx('2012-12-12 12:34:59',true);
					testIsDatetimeEx('1800-01-01 00:00:00',true);
					testIsDatetimeEx('2999-01-01 00:00:00',true);
					testIsDatetimeEx('2999-01-01 23:59:59',true);
					testIsDatetimeEx('2000-12-31 23:59:59',true);
					testIsDatetimeEx(null,false);
					testIsDatetimeEx(null,true);
					testIsDatetimeEx('あいうえお',true);

					
					//日時入力チェックテストメソッド
					function testIsDatetimeEx($v,$reqFlg){
						$ic=new InputCheck();
						$ret=$ic->isDatetimeEx($v,$reqFlg);
						//$ret=$ic->isDate($v);
					
						echo $v.'→'.$ret.'<br>';
					};

					
				?>
				</div>
			</div><!-- sec1 -->
		
			<div class="sec1">
				
				isTime_hhiissのテスト<br />
				
				<pre>			
					$ret=$ic->isTime_hhiiss($test1);
				</pre>
				
				<div class="console1">
				<?php 
					$test1='121212';
					$ic=new InputCheck();
					$ret=$ic->isTime_hhiiss($test1);
					echo $ret;
				?>
				</div>
			</div><!-- sec1 -->
			
		
			<div class="sec1">
				
				isTime_hhiiのテスト<br />
				
				<pre>			
					$ret=$ic->isTime_hhii($test1);
				</pre>
				
				<div class="console1">
				<?php 
					$ic=new InputCheck();
					
					$t='121212';
					$ret=$ic->isTime_hhii($t);
					echo $t." → ".$ret."<br>";
					
					$t='1212';
					$ret=$ic->isTime_hhii($t);
					echo $t." → ".$ret."<br>";
					
					$t='121';
					$ret=$ic->isTime_hhii($t);
					echo $t." → ".$ret."<br>";
					
					$t='9999';
					$ret=$ic->isTime_hhii($t);
					echo $t." → ".$ret."<br>";
					
					$t='2300';
					$ret=$ic->isTime_hhii($t);
					echo $t." → ".$ret."<br>";
					
					$t='0059';
					$ret=$ic->isTime_hhii($t);
					echo $t." → ".$ret."<br>";
					

				?>
				</div>
			</div><!-- sec1 -->
			
					
			<div class="sec1">
				
				isTime_hisのテスト<br />
				
				<pre>			
					$ret=$ic->isTime_his($test1);
				</pre>
				
				<div class="console1">
				<?php 
					$ic=new InputCheck();
					
					$t='121212';
					$ret=$ic->isTime_his($t);
					echo $t." → ".$ret."<br>";
					
					$t='12-12-12';
					$ret=$ic->isTime_his($t);
					echo $t." → ".$ret."<br>";
					
					$t='12:12:12';
					$ret=$ic->isTime_his($t);
					echo $t." → ".$ret."<br>";
					
					$t='246060';
					$ret=$ic->isTime_his($t);
					echo $t." → ".$ret."<br>";
					
					$t='24:60:60';
					$ret=$ic->isTime_his($t);
					echo $t." → ".$ret."<br>";
					
					$t='0:0:0';
					$ret=$ic->isTime_his($t);
					echo $t." → ".$ret."<br>";
					
					$t='12:12';
					$ret=$ic->isTime_his($t);
					echo $t." → ".$ret."<br>";
					
					$t=null;
					$ret=$ic->isTime_his($t);
					echo $t." → ".$ret."<br>";
					
				?>
				</div>
			</div><!-- sec1 -->
			
			<div class="sec1">
				
				isTimeExのテスト<br />
				
				<pre>			
					$t='121212';
					$ret=$ic->isTimeEx($t,null,true);
				</pre>
				
				<div class="console1">
				<?php 
					$ic=new InputCheck();
					
					$t='121212';
					$ret=$ic->isTimeEx($t,null,true);
					echo $t." → ".$ret."<br>";
					
					$t='12-12-12';
					$ret=$ic->isTimeEx($t,null,true);
					echo $t." → ".$ret."<br>";
					
					$t='12:12:12';
					$ret=$ic->isTimeEx($t,null,true);
					echo $t." → ".$ret."<br>";
					
					$t='246060';
					$ret=$ic->isTimeEx($t,null,true);
					echo $t." → ".$ret."<br>";
					
					$t='24:60:60';
					$ret=$ic->isTimeEx($t,null,true);
					echo $t." → ".$ret."<br>";
					
					$t='0:0:0';
					$ret=$ic->isTimeEx($t,null,true);
					echo $t." → ".$ret."<br>";
					
					$t='12:12';
					$ret=$ic->isTimeEx($t,null,true);
					echo $t." → ".$ret."<br>";
					
					$t='12:12';
					$ret=$ic->isTimeEx($t,null,false);
					echo $t." → ".$ret."<br>";
					
					$t='24:60:60';
					$ret=$ic->isTimeEx($t,null,false);
					echo $t." → ".$ret."<br>";
					
					$t=null;
					$ret=$ic->isTimeEx($t,null,true);
					echo $t." → ".$ret."<br>";
					
					$t=null;
					$ret=$ic->isTimeEx($t,null,false);
					echo $t." → ".$ret."<br>";
					
				?>
				</div>
			</div><!-- sec1 -->			
			
			
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/03/20</div>
		</div><!-- page1 -->
	</body>
</html>