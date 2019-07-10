<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>URLをサニタイズ | 要素属性へのXSS攻撃</title>

		<link href="../../style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../style2/css/common2.css" rel="stylesheet">


		<script src="../../style2/js/jquery-1.11.1.min.js"></script>
		<script src="../../style2/js/bootstrap.min.js"></script>


		<style>
			.chp1{
				margin-top:20px;
				margin-bottom:20px;
			}
		</style>
	</head>

<body>
<div class="container">

	<div class="row">
		<div id="header" class="col-lg-12" >
			<h1>URLをサニタイズ | 要素属性へのXSS攻撃</h1>
			<p></p>
		</div>
	</div>



	<div class="sec3">
		<h2>説明</h2>
		a要素のhrefへ、自由にURLを指定できるようなシステムの場合、XSSの危険性がある。<br>
		また、aタグ以外でも、要素の属性を指定できる場合、XSSを起きる。<br>
		該当する属性は、href,srcだけでなく、すべてに注意。<br>
		<br>
		悪意のあるXSS攻撃にはセッションハイジャックがある。<br>
		クッキーからセッションIDを表示させるJSコードが埋め込まれてしまい、セッションIDを盗まれる。<br>
		セッションIDを盗まれるとなりすましも可能になる。<br>
		<br>
		<strong>対策</strong><br>
		URLに含まれる次の記号、「&lt&gt"'」をサニタイズすれば良い。<br>
		また、記号「:;」も除去しておいた方が良い。
		<br>




	</div>

	<div class="sec3">
		<h2>XSSを引き起こすコードの例</h2>

		<dl>

			<dt>典型的な危険コード</dt>
				<dd>
					a要素のhrefに以下のコードが指定されていると、画面を開いただけでJSが実行される。<br>
					http://example.com/?&ltscript&gtalert(document.domain);&lt/script&gt <br>
					<br><br>

					クリックするとJavaScriptが実行される。<br>
					&lta href="javascript:alert('XSS')" &gtテスト&lt/a&gt<br>
					<a href="javascript:alert('XSS')" >テスト</a><br>
					<br>
					以下のような特殊環境で起こるケースも。<br>
					javascript:alert%28location%29<br>

				</dd>

			<dt>リンクに触るだけで、XSSを引き起こす特に注が必要な危険コード。</dt>
				<dd>
					以前、TwitterにXSS脆弱性の問題があったが、以下と同様なものである。<br>
					http://example.com/"onmouseover="alert(1)"<br>
				</dd>

			<dt>a要素以外も注意</dt>
				<dd>
					&ltIMG SRC="jav&#x09;ascript:alert('XSS');"&gt<br>
					&ltIMG SRC="javascript:alert('XSS')"+<br>
				</dd>

			<dt>IE7以前では、CSS内でJSコードを実行することも</dt>
				<dd>
					&ltdiv style="color:expression(alert('XSS'));"&gta&lt/div&gt<br>
					&ltdiv style='behavior:url(test.sct)'&gta&lt/div&gt<br>
				</dd>
		</dl>



	</div>
















	<div class="sec3">
		<h2>サンプル</h2>


		ソースコード<br>
		<pre>
	&lt?php
		$xssList=array(
			"http://example.com/\"onmouseover=\"alert(1)\"",
			"http://example.com/?&ltscript&gtalert(document.domain);&lt/script&gt",
			"https://example.com/?neko=1&yagi=2\"onmouseover=\"alert(1)\"",
			"javascript:alert('XSS')",
			"jav&#x09;ascript:alert('XSS');",
			"color:expression(alert('XSS'));",
			"behavior:url(test.sct)",
		);


		foreach($xssList as $xss){

			$s=htmlspecialchars_url($xss);


			echo htmlspecialchars($xss);
			echo " → ";
			echo htmlspecialchars($s);
			echo "&ltbr&gt";
		}

		/**
		 * URL用のサニタイズ
		 * 記号「&lt&gt"'」をエンコードし、記号「:;」を除去する。
		 * ただし「http:」「https:」に付いている「:」は除去しない。
		 * @param  $xss	サニタイズ対象文字
		 * @return サニタイズ後の文字
		 */
		function htmlspecialchars_url($xss){
			$s=htmlspecialchars($xss, ENT_QUOTES, 'UTF-8');
			$s=str_replace('http:','http&lt',$s);
			$s=str_replace('https:','https&lt',$s);
			$s=str_replace(':','',$s);
			$s=str_replace(';','',$s);
			$s=str_replace('http&lt','http:',$s);
			$s=str_replace('https&lt','https:',$s);
			return $s;
		}

	?&gt
		</pre>

		<br>
		実行結果<br>
<?php
	$xssList=array(
		"http://example.com/\"onmouseover=\"alert(1)\"",
		"http://example.com/?<script>alert(document.domain);</script>",
		"https://example.com/?neko=1&yagi=2\"onmouseover=\"alert(1)\"",
		"javascript:alert('XSS')",
		"jav&#x09;ascript:alert('XSS');",
		"color:expression(alert('XSS'));",
		"behavior:url(test.sct)",
	);


	foreach($xssList as $xss){

		$s=htmlspecialchars_url($xss);


		echo htmlspecialchars($xss);
		echo " → ";
		echo htmlspecialchars($s);
		echo "<br>";
	}

	/**
	 * URL用のサニタイズ
	 * 記号「<>"'」をエンコードし、記号「:;」を除去する。
	 * ただし「http:」「https:」に付いている「:」は除去しない。
	 * @param  $xss	サニタイズ対象文字
	 * @return サニタイズ後の文字
	 */
	function htmlspecialchars_url($xss){
		$s=htmlspecialchars($xss, ENT_QUOTES, 'UTF-8');
		$s=str_replace('http:','http<',$s);
		$s=str_replace('https:','https<',$s);
		$s=str_replace(':','',$s);
		$s=str_replace(';','',$s);
		$s=str_replace('http<','http:',$s);
		$s=str_replace('https<','https:',$s);
		return $s;
	}

?>
	</div>





	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2015-07-28</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>