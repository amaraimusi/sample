<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>プロキシサーバーが設定している値を取得する</title>

		<link href="../../style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../style2/css/common2.css" rel="stylesheet">

		<script src="../../style2/js/jquery-1.11.1.min.js"></script>
		<script src="../../style2/js/bootstrap.min.js"></script>


		<style>

		</style>
	</head>

<body>
<div class="container">


	<div class="row">
		<div id="header" class="col-lg-12" >
			<h1>プロキシサーバーが設定している値を取得する</h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">
		多くのプロキシサーバーが設定している値を取得する。<br>
		ただし合法的なプロキシサーバーのみ。<br>
		<br>
		
		<h2>検証</h2>
		<p>getValueByProxy()関数のダンプ</p>
		<div style="color:#dd4f43">
		<?php 
		
		
		$data=getValueByProxy();
		var_dump($data);
		
		/**
		 * Proxyが設定した値を取得する。
		 * 
		 * 正規のプロキシサーバーにのみ対応。
		 * webProxyはminiProxyで確認。
		 * 
		 * @return Proxy設定したと思われる値の配列。空配列の場合、Proxy未使用か、より違法性の高いProxyサーバー。
		 * 
		 */
		function getValueByProxy(){
			
			$data=array();//Proxy設定データ
			
			//多くのプロキシサーバーソフトが設定しているキーのリスト
			$keys=array(
					'HTTP_SP_HOST',
					'HTTP_VIA',
					'HTTP_CLIENT_IP',
					'HTTP_FORWARDED',
					'HTTP_X_FORWARDED_FOR',
					'HTTP_FROM',
					'REMOTE_HOST'//webProxy用
					
			);
			
			foreach($keys as $key){
				if(isset($_SERVER[$key])){
					$data[$key]=$_SERVER[$key];
				}
			}
			
			if(preg_match('/via|squid|gate|httpd|proxy|cache|gateway|www|anonymous|keeper/i', $_SERVER['HTTP_USER_AGENT']) ){
				$data['HTTP_USER_AGENT']=$_SERVER['HTTP_USER_AGENT'];
			}
			
			return $data;
			
			
			
		}
		?>
		</div>
		
		<hr>
		<p>getValueByProxy()関数のソースコード</p>
		<input type="button" value="source" onclick="$('#source1').toggle()" class="btn btn-primary btn-xs" />
		<pre id="source1" style="display:none">
		$data=getValueByProxy();
		var_dump($data);
		
		/**
		 * Proxyが設定した値を取得する。
		 * 
		 * 正規のプロキシサーバーにのみ対応。
		 * webProxyはminiProxyで確認。
		 * 
		 * @return Proxy設定したと思われる値の配列。空配列の場合、Proxy未使用か、より違法性の高いProxyサーバー。
		 * 
		 */
		function getValueByProxy(){
			
			$data=array();//Proxy設定データ
			
			//多くのプロキシサーバーソフトが設定しているキーのリスト
			$keys=array(
					'HTTP_SP_HOST',
					'HTTP_VIA',
					'HTTP_CLIENT_IP',
					'HTTP_FORWARDED',
					'HTTP_X_FORWARDED_FOR',
					'HTTP_FROM',
					'REMOTE_HOST'//webProxy用
					
			);
			
			foreach($keys as $key){
				if(isset($_SERVER[$key])){
					$data[$key]=$_SERVER[$key];
				}
			}
			
			if(preg_match('/via|squid|gate|httpd|proxy|cache|gateway|www|anonymous|keeper/i', $_SERVER['HTTP_USER_AGENT']) ){
				$data['HTTP_USER_AGENT']=$_SERVER['HTTP_USER_AGENT'];
			}
			
			return $data;
			
			
			
		}
		</pre>

	</div>



	<br><br>
	<a href="http://ameblo.jp/mingw/entry-10382249881.html" target="brank" class="btn btn-link btn-xs">参考サイト</a>
	<br><br>

	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2016-1-5</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>