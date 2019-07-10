<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>緯度経度を度分秒表記（60進数）から10進数に変換</title>

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
		<h1>緯度経度を度分秒表記（60進数）から10進数に変換</h1>
	</div>
	
	
	<h2>ソースコード</h2>
	
	60進数表記の緯度経度を10進数表記に変換する。<br>
	60進数表記も「度分秒」、「°’”」など、複数の記号表記に対応している。<br>
	<br>
	
	<pre>
	/**
	 * 緯度経度を度分秒表記（60進数）から10進数に変換
	 * @param string or array $p 60進数緯度経度
	 * - 例
	 * - 26,40,32.73
	 * - 26度40分32.73秒
	 * - 26°40’32.73”
	 * - 26,40'32.73"
	 * - N26,40'32.73"
	 * - array(26,40,32.73)
	 * @return 10進数緯度経度
	 */
	function <strong>latlon60to10</strong>($p){
		$res = null;
		if(is_array($p)){
			$ary = $p;
		}else{
			
			if(!is_numeric(mb_substr($p ,0 ,1))){
				$p = mb_substr($p ,1 );
	
			}
			$ary = preg_split("/,|度|分|秒|°|’|”|'|&yen;"/",$p);
			
			if(count($ary) &lt; 3){
				return null;
			}
		}
		
		$res = $ary[0] + $ary[1]/60 + $ary[2]/3600;
		
		return $res;
		
	}
	</pre>


	<br><br><hr>


	<h2>検証</h2>

	<table class="table">
		<thead>
			<tr>
				<th>60進数表記</th>
				<th>10進数表記</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			
			$samples=array(
				"26,40,32.73",
				"26度40分32.73秒",
				"26°40’32.73”",
				"N26,40'32.73\"",
				array(26,40,32.73),
			);
			
			
			foreach($samples as $sample){
				$res = latlon60to10($sample);
				
				echo '<tr>';
				echo '<td>';
				if(is_array($sample)){
					echo var_dump($sample);
				}else{
					echo $sample;
				}
				
				echo '</td><td>';
				echo $res;
				echo '</td></tr>';
			}
			?>
		</tbody>
	</table>



<?php 
/**
 * 緯度経度を度分秒表記（60進数）から10進数に変換
 * @param string or array $p 60進数緯度経度
 * - 例
 * - 26,40,32.73
 * - 26度40分32.73秒
 * - 26°40’32.73”
 * - 26,40'32.73"
 * - N26,40'32.73"
 * - array(26,40,32.73)
 * @return 10進数緯度経度
 */
function latlon60to10($p){
	$res = null;
	if(is_array($p)){
		$ary = $p;
	}else{
		
		if(!is_numeric(mb_substr($p ,0 ,1))){
			$p = mb_substr($p ,1 );

		}
		$ary = preg_split("/,|度|分|秒|°|’|”|'|\"/",$p);
		
		if(count($ary) < 3){
			return null;
		}
	}
	
	$res = $ary[0] + $ary[1]/60 + $ary[2]/3600;
	
	return $res;
	
}

?>



	<div class="yohaku"></div>
	<ol class="breadcrumb">
		<li><a href="/">ホーム</a></li>
		<li><a href="/sample">サンプルソースコード</a></li>
		<li><a href="/sample/php">ＰＨＰ　｜　サンプル</a></li>
		<li>緯度経度を度分秒表記（60進数）から10進数に変換</li>
	</ol>

	<div id="footer"  >
		<a href="/">(c)wacgance</a> 2016-6-20 
	</div>
	

		


</div><!-- container  -->
</body>
</html>