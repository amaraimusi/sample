<?php 
require_once '../../../zss_lib/common.php';
require_once '../../../zss_lib/date_util.php';

					$m_util=new DateUtil();
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" /><!-- 髢ｾ�ｪ陷肴��ｿ�ｻ髫ｪ�ｳ邵ｺ霈披雷邵ｺ�ｪ邵ｺ�ｽ-->
		<title>日付関連　| DateUtil</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script>


			
		</script>
		
		<style type="text/css">
			
		</style>
		
	</head>
	<body>
		<div id="page1">
		<div id="header">日付関連　| DateUtil</div>
		<div id="content" >
		
			<div class="sec1">
				
				<p>cnvTime1のテスト</p>
				
				<pre>			
					$t=$util->cnvTime1($t);
				</pre>
				
				<div class="console1">
				<?php 
					testCnvTime1('121212');
					testCnvTime1('1212');
					testCnvTime1('12:12');
					testCnvTime1('12-12');
					testCnvTime1(null);
					testCnvTime1(おおいなる犬);
					testCnvTime1('12');
					testCnvTime1('12:12:12');
					testCnvTime1('999999');
					testCnvTime1('595959');
					testCnvTime1('606060');
					testCnvTime1('000000');
					testCnvTime1('111');
					testCnvTime1('１０１０１０');
					

					
					//時刻変換テストメソッド
					function testCnvTime1($v){
						$util=new DateUtil();
						$ret=$util->cnvTime1($v);
						echo $v.'→'.$ret.'<br>';
					};
				?>
				</div>
			</div><!-- sec1 -->
			
			<div class="sec1">
				
				<p>cnvDate1のテスト</p>
				
				（例）<br>
				<pre>			
					$d=$util->cnvDate1($d);
				</pre>
				
				<div class="console1">
				<?php 

					testCnvDate1('20121212');
					testCnvDate1('201212');
					testCnvDate1('2012-12-12');
					testCnvDate1('2012-12');
					testCnvDate1('2012/12/12');
					testCnvDate1('2012');
					testCnvDate1('12:12');
					testCnvDate1('null');
					testCnvDate1('　　　');
					testCnvDate1('猫ちゃん');
					testCnvDate1('');
					
					//日付変換テストメソッド
					function testCnvDate1($v){
						$util=new DateUtil();
						$ret=$util->cnvDate1($v);
						echo $v.'→'.$ret.'<br>';
					};
					
				?>
				</div>
				
				
			</div><!-- sec1 -->
			
			
				<div class="sec1">
				
				<p>cnvDatetime1のテスト</p>
				
				（例）<br>
				<pre>			
					$dt=$util->cnvDatetime1($dt);
				</pre>
				
				<div class="console1">
				<?php 

					testCnvDatetime1('20121212123456');
					testCnvDatetime1('2a01a2a12121a2a3456');
					testCnvDatetime1('201212121234');
					testCnvDatetime1('2012121212');
					testCnvDatetime1('20121212');
					testCnvDatetime1('201212');
					testCnvDatetime1('2012');
					testCnvDatetime1('20-12');
					testCnvDatetime1('12:12');
					testCnvDatetime1('null');
					testCnvDatetime1('　　　');
					testCnvDatetime1('猫ちゃん');
					testCnvDatetime1('');
					
					//日付変換テストメソッド
					function testCnvDatetime1($v){
						$util=new DateUtil();
						$ret=$util->cnvDatetime1($v);
						echo $v.'→'.$ret.'<br>';
					};
					
				?>
				</div>
			</div><!-- sec1 -->
			
			
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/03/20</div>
		</div><!-- page1 -->
	</body>
</html>