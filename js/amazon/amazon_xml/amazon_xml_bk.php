<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" /><!-- 髢ｾ�ｪ陷肴��ｿ�ｻ髫ｪ�ｳ邵ｺ霈披雷邵ｺ�ｪ邵ｺ�ｽ-->
		<title>Amazon | XML表示</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script>

			function test_func1(){
				var urlStr="http://ecs.amazonaws.jp/onca/xml?AWSAccessKeyId=AKIAJ2EO6YDAN5HRF4RQ&Keywords=%E3%82%82%E3%82%84%E3%81%97&Operation=ItemSearch&SearchIndex=Books&Service=AWSECommerceService&Timestamp=2013-04-29T09%3A45%3A16Z&Version=2009-03-31&Signature=ws3fQfAQNHiqJ8G6cP9ax4CIt7nDAg9FoeSaPcbcDjA%3D";
				/*var urlStr="http://ecs.amazonaws.jp/onca/xml?" +
					"Service=AWSECommerceService&"+
					"AWSAccessKeyId=AKIAJ2EO6YDAN5HRF4RQ&"+
					"Operation=ItemSearch&"+
					"SearchIndex=Books&Title=Harry%20Potter&"+
					"Version=2009-07-01";*/
				//var urlStr="http://ecs.amazonaws.jp/onca/xml?Service=AWSECommerceService&AWSAccessKeyId=AKIAJ2EO6YDAN5HRF4RQ&Operation=ItemSearch&SearchIndex=Books&Title=Harry%20Potter&Version=2009-07-01";
				//urlStr=encodeURI(urlStr);
				//var urlStr="http://amaraimusi.sakura.ne.jp/";
				$.ajax({
					  url: urlStr,
					  cache: false,
					  success: function(html){
					  	alert(html);
					    //$("#results").append(html);
					  }
					});
				/*
				$.ajax({
					url:urlStr,
					type:'POST',
					dataType:'text',
					success: function(data, type){
						alert(data);
						alert(type);
					},
					error: function(xmlHttpRequest, textStatus, errorThrown){
						alert(textStatus);
					}


				});
*/


				
			}
			
		</script>
		
		<style type="text/css">
			
		</style>
		
	</head>
	<body>
		<div id="page1">
		<div id="header">Amazon | XML表示</div>
		<div id="content" >
		
			<div class="sec1">
				hello world!2
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