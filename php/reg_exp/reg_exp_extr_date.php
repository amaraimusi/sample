<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>正規表現日付を抜き出す</title>

		<link href="/sample/style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="/sample/style2/css/common2.css" rel="stylesheet">

		<script src="/sample/style2/js/jquery-1.11.1.min.js"></script>
		<script src="/sample/style2/js/bootstrap.min.js"></script>


		<style>

		</style>
	</head>

<body>
<div class="container">

	<div id="header" >
		<h1>正規表現日付を抜き出す</h1>
	</div>

	<h3>文字列から日付を抜き出す正規表現について</h3>
	日付は様々な表記方法、月により変わる日数(28日～31日)、閏年などがあり複雑である。 <br>
	そのため、正規表現だけで完全な日付を抜き出すとなると、かなり冗長で複雑になる。<br>
	よって正規表現の日付に関してはある程度の妥協が必要になってくる。<br>
	<br>
	
	<p>サンプル1</p>
	シンプルな正規表現。広い範囲の日付書式を取得できる。しかし、99月99日なんていうのも取れてしまう。
	<pre class="kata">/([0-9]{4})(\/|-|年)([0-9]{1,2})(\/|-|月)([0-9]{1,2})/</pre>
	<br>
	
	<input type="button" class="btn btn-info btn-sm" value="PHPソースコード" onclick="$('#sample1_source').toggle(500);" />
	<pre id="sample1_source" style="display:none">
		$tests=null;
		$tests[] = "いろは2016-6-6ネコ";
		$tests[] = "いろは2016-06-06タヌキ";
		$tests[] = "いろは2016-12-31ロバ";
		$tests[] = "いろは9999-99-99ブタ";
		$tests[] = "いろは2016/6/6イヌ";
		$tests[] = "いろは2016年6月6日ヤギ";
		$tests[] = "いろは2016-6カニ";
		$tests[] = "いろは2016カニ";
		$tests[] = "いろは";
	
		foreach($tests as $test){
			$re = '<strong>/([0-9]{4})(\/|-|年)([0-9]{1,2})(\/|-|月)([0-9]{1,2})/</strong>';
			preg_match($re, $test,$match);
			
			$res="一致なし";
			if(!empty($match)){
				$res = $match[0];
			}
			echo $test.' → '.$res.'<br>';
		}
	</pre>
	<br><br>
	
	
	出力
	<div class="output_data">
	<?php 
		$tests=null;
		$tests[] = "いろは2016-6-6ネコ";
		$tests[] = "いろは2016-06-06タヌキ";
		$tests[] = "いろは2016-12-31ロバ";
		$tests[] = "いろは9999-99-99ブタ";
		$tests[] = "いろは2016/6/6イヌ";
		$tests[] = "いろは2016年6月6日ヤギ";
		$tests[] = "いろは2016-6カニ";
		$tests[] = "いろは2016カニ";
		$tests[] = "いろは";
	
		foreach($tests as $test){
			$re = '/([0-9]{4})(\/|-|年)([0-9]{1,2})(\/|-|月)([0-9]{1,2})/';
			preg_match($re, $test,$match);
			
			$res="一致なし";
			if(!empty($match)){
				$res = $match[0];
			}
			echo $test.' → '.$res.'<br>';
		}
	?>
	</div>
	<br>
	<hr>
	
	
	
	
	
	
	
	
	<p>サンプル2</p>
	サンプル1より少し厳密に日付を取得できるが、6月31日（6月は30日まで）など存在しない日付の値まで取得できてしまう。<br>
	どうせ完全な日付が取得できないのであれば、サンプル1で採用し、バリデーション処理を自前で書いたほうが効率がよいかもしれない。
	<pre class="kata">/([1-9][0-9]{3})\/|-|年([1-9]{1}|1[0-2]{1})\/|-|月([1-9]{1}|[1-2]{1}[0-9]{1}|3[0-1]{1})/</pre>
	<br>
	
	<input type="button" class="btn btn-info btn-sm" value="PHPソースコード" onclick="$('#sample2_source').toggle(500);" />
	<pre id="sample2_source" style="display:none">
	$tests=null;
	$tests[] = "いろは2016-6-6ネコ";
	$tests[] = "いろは2016-6-31";
	$tests[] = "いろは2016-06-06タヌキ";
	$tests[] = "いろは2016-12-31ロバ";
	$tests[] = "いろは9999-99-99ブタ";
	$tests[] = "いろは2016/6/6イヌ";
	$tests[] = "いろは2016年6月6日ヤギ";
	$tests[] = "いろは2016-6カニ";
	$tests[] = "いろは2016カニ";
	$tests[] = "いろは";

	foreach($tests as $test){
		$re = '<strong>/([1-9][0-9]{3})(\/|-|年)(0[1-9]{1}|1[0-2]{1}|[1-9]{1})(\/|-|月)(3[0-1]{1}|[1-2]{1}[0-9]{1}|0[1-9]{1}|[1-9]{1})/</strong>';
		preg_match($re, $test,$match);
		
		$res="一致なし";
		if(!empty($match)){
			$res = $match[0];
		}
		echo $test.' → '.$res.'<br>';
	}
	</pre>
	<br><br>
	
	出力
	<div class="output_data">
	<?php 
		$tests=null;
		$tests[] = "いろは2016-6-6ネコ";
		$tests[] = "いろは2016-6-31";
		$tests[] = "いろは2016-06-06タヌキ";
		$tests[] = "いろは2016-12-31ロバ";
		$tests[] = "いろは9999-99-99ブタ";
		$tests[] = "いろは2016/6/6イヌ";
		$tests[] = "いろは2016年6月6日ヤギ";
		$tests[] = "いろは2016-6カニ";
		$tests[] = "いろは2016カニ";
		$tests[] = "いろは";
	
		foreach($tests as $test){
			$re = '/([1-9][0-9]{3})(\/|-|年)(0[1-9]{1}|1[0-2]{1}|[1-9]{1})(\/|-|月)(3[0-1]{1}|[1-2]{1}[0-9]{1}|0[1-9]{1}|[1-9]{1})/';
			preg_match($re, $test,$match);
			
			$res="一致なし";
			if(!empty($match)){
				$res = $match[0];
			}
			echo $test.' → '.$res.'<br>';
		}
	?>
	</div>







	<br>
	<div class="yohaku"></div>
	<ol class="breadcrumb">
		<li><a href="/">ホーム</a></li>
		<li><a href="/sample">サンプルソースコード</a></li>
		<li><a href="/sample/php">ＰＨＰ　｜　サンプル</a></li>
		<li>正規表現日付を抜き出す</li>
	</ol>

	<div id="footer"  >
		<a href="/">(c)wacgance</a> 2016-6-7 
	</div>
	

		


</div><!-- container  -->
</body>
</html>