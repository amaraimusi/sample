<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>リクエスト（ＧＥＴ）情報を取得 | Java Script</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script type="text/javascript" src="../../../zss_js_lib/common.js"></script>
		<script type="text/javascript" src="../../../zss_js_lib/get_request.js"></script>
		<script>

			function load(){
				
				var gr=new GetRequest();//オブジェクトを生成
				var data=gr.getGetParams();//リクエスト情報を取得する。

				//リクエストデータがnullでないならリクエスト情報を取得する。
				debug(data['animal']);
				debug(data['age']);
				//debugArray(data);
				
			}

			function testFunc(){
				//ＧＥＴパラメータを渡して自画面遷移する。
				location.href='test_get_request.php?animal=neko&age=8';
				
			}
			
		</script>
		
		<style type="text/css">
			
		</style>
		
	</head>
	<body onload="load()">
		<div id="page1">
		<div id="header">リクエスト（ＧＥＴ）情報を取得 | Java Script</div>
		<div id="content" >
			<form name="form1"  action="#" method="post" enctype="multipart/form-data" >
				<div class="sec1">
				
					<input type="button"  value="テスト" onclick="testFunc()" /><br />
					
					デバッグ出力<br />
					<div id="js_test"></div>

				</div><!-- sec1 -->
			</form>
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/09/03</div>
		</div><!-- page1 -->
	</body>
</html>