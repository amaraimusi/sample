<?php 
	require_once '../../../zss_lib/common.php';
	require_once '../../../zss_lib/csv_io.php';
	require_once '../../../zss_lib/string_func.php';
	
	//配列分解テスト
	//$v='1,徳川家康,1000,aaaaa1@aa,"aa,bb,cc1",ddd,kani\"neko\"yagi,eee,"kani\"ne,ko\"yagi","a,b,c",fff';
	$v='1,徳川家康,1000,aaaaa1@aa,"aa,bb,cc1"'."\n";
	debug('v='.$v);
	$cio=new CsvIo();
	$ary=$cio->cnvToAryForDq($v);
	debug("■■■□□□■■■□□□出力");
	debugArray($ary);
	$cnt=count($ary);
	debug('cnt='.$cnt);

//	debug("■■■□□□■■■□□□akamusi");
//	$akamusi=mb_strpos("akamusi",'k',0);
//	debug('akamusi='.$akamusi);
	
//	$a=mb_strpos($v,1,1,'utf8');
//	debug('a='.$a);
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" /><!-- 髢ｾ�ｪ陷肴��ｿ�ｻ髫ｪ�ｳ邵ｺ霈披雷邵ｺ�ｪ邵ｺ�ｽ-->
		<title>PHP　｜　試し用</title>
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
		<div id="header">PHP　｜　試し用</div>
		<div id="content" >
		
			<div class="sec1">
				hello world!
				<div id="xxx1">aaaa</div><br>
				<input type="button" value="run" onclick="test_func1()" />
				<pre>			
				function test_func1(){
					var x=document.getElementById('xxx1').innerHTML;
					alert(x);
				}
				</pre>
			</div><!-- sec1 -->
			
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/03/20</div>
		</div><!-- page1 -->
	</body>
</html>