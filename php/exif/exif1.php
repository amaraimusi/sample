<?php 

$exifData = exif_read_data('img/test4.jpg');

// Exifデータから日付を抽出する。
$date1 = extrDateTimeFromExif($exifData);
$data['date1'] = $date1;

// Exifデータから緯度経度を取得する
$latlon = extrLatLonFromExif($exifData);
$data['lat'] = $latlon['lat'];
$data['lon'] = $latlon['lon'];






// Exifデータから日付を抽出する。
function extrDateTimeFromExif($exifData,$format='Y-m-d H:i:s'){
	$date1 = null;
	$keys = array(
		'DateTimeOriginal',
		'DateTimeDigitized',
		'DateTime',
	);
	
	foreach($keys as $k){
		if(!empty($exifData[$k])){
			$date1 = $exifData[$k];
			break;
		}
	}
	if($date1 != null){
		$date1  = date($format, strtotime($date1));
	}
	
	return $date1;

	
}

function extrLatLonFromExif($exifData){
	$keys = array(
			'lat'=>'GPSLatitude',
			'lon'=>'GPSLongitude',
	);
	
	$res = array();
	
	foreach($keys as $a => $key){
		
		$p=null;
		if(!empty($exifData[$key])){
			$p = $exifData[$key];
			
			if(is_array($p)){
				
				// 分数表記を浮動小数点式に変換する
				foreach($p as $i=>$v){
					$p[$i] = fracToFloat($v);
				}
				
			}
			// 度分秒表記を10進数表記に変換
			$p = latlon60to10($p);
		}
		$res[$a] = $p;
	}
	
	return $res;
	
}


/**
 * 分数表記を浮動小数点式に変換する
 * @param string $str 分数表記の文字列 (例： 314/100)
 * @return number 浮動小数値
 */
function fracToFloat($str){

	// 「/」が文字列中に存在しなかったり、空であったりするなら、引数を返して処理を抜ける
	if(!preg_match("/\//", $str) || empty($str)){
		return $str;
	}

	// 「/」で分割して配列を作り、チェックと数値加工を施す。
	$ary=explode("/",$str);
	foreach($ary as $i => $v){
		$v = floatval ($v);
		if(is_numeric($v)){
			$ary[$i] = $v;
		}else{
			return $str;
		}
	}

	// 分母が0でないなら除算をする。
	if($ary[1]==0){
		return $str;
	}
	$v = $ary[0] / $ary[1];

	return $v;

}



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
<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Exifを取得</title>

		<link href="/sample/style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="/sample/style2/css/common2.css" rel="stylesheet">
		
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD-Y_H0SqELBviGTQT9GrbQdiHeVKLwNAo&sensor=false"></script>
		<script src="/sample/style2/js/jquery-1.11.1.min.js"></script>
		<script src="/sample/style2/js/bootstrap.min.js"></script>


		<style>

		</style>
		<script>
		$(function(){
			var latlng = new google.maps.LatLng(<?php echo $data['lat']?>,<?php echo $data['lon']?>);
				
			var opts = {
				zoom: 17,//ズーム
				center: latlng,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				scaleControl: true,//スケール表示
			};
			var gmap1 = new google.maps.Map(document.getElementById("gmap"), opts);
			

		});
		</script>
	</head>

<body>
<div class="container">

	<div id="header" >
		<h1>Exifを取得</h1>
	</div>
	
	写真(jpeg)からExifデータは抜き出すにはexif_read_data関数を使います。
	<pre class="kata">$exifData = <strong>exif_read_data</strong>('img/test4.jpg');</pre><br>
	<br>

	<h2>サンプル</h2>
	写真からExifデータを取得します。<br>
	そしてExifデータから更新日や緯度経度を抽出します。<br>
	緯度経度はGoogle Mapにも表示します。<br>
	<br>
	
	<p>Exifデータを保持している写真</p>
	<img src="img/test4.jpg" alt="" class="img-responsive" /><br>
	<br>

	<input type="button" class="btn btn-info" value="Exifデータのダンプ" onclick="$('#dump1').toggle(500)" />
	<div id="dump1" style="display:none"><?php echo var_dump($exifData);?></div>
	<br><br>

	<p>Exifデータから抽出したプロパティの例</p>
	<table class="table">
		<thead>
			<tr>
				<th>プロパティ</th>
				<th>値</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>更新日</td>
				<td><?php echo $data['date1']; ?></td>
			</tr>
			
			<tr>
				<td>緯度</td>
				<td><?php echo $data['lat']; ?></td>
			</tr>
			
			<tr>
				<td>経度</td>
				<td><?php echo $data['lon']; ?></td>
			</tr>
			
		</tbody>
	</table>
	<br><br>
	
	<p>Exifデータから抽出した緯度経度をGoogle Mapに表示する</p>
	<div id="gmap" style="width:500px; height:500px"></div>
	<br><br>
	
	<input type="button" class="btn btn-info" value="ソースコード" onclick="$('#source1').toggle(500)" />
	<pre id="source1" style="display:none">
	
	&lt;?php 

	$exifData = <strong>exif_read_data</strong>('img/test4.jpg');
	
	// Exifデータから日付を抽出する。
	$date1 = extrDateTimeFromExif($exifData);
	$data['date1'] = $date1;
	
	// Exifデータから緯度経度を取得する
	$latlon = extrLatLonFromExif($exifData);
	$data['lat'] = $latlon['lat'];
	$data['lon'] = $latlon['lon'];
	
	
	
	
	
	
	// Exifデータから日付を抽出する。
	function extrDateTimeFromExif($exifData,$format='Y-m-d H:i:s'){
		$date1 = null;
		$keys = array(
			'DateTimeOriginal',
			'DateTimeDigitized',
			'DateTime',
		);
		
		foreach($keys as $k){
			if(!empty($exifData[$k])){
				$date1 = $exifData[$k];
				break;
			}
		}
		if($date1 != null){
			$date1  = date($format, strtotime($date1));
		}
		
		return $date1;
	
		
	}
	
	function extrLatLonFromExif($exifData){
		$keys = array(
				'lat'=&gt;'GPSLatitude',
				'lon'=&gt;'GPSLongitude',
		);
		
		$res = array();
		
		foreach($keys as $a =&gt; $key){
			
			$p=null;
			if(!empty($exifData[$key])){
				$p = $exifData[$key];
				
				if(is_array($p)){
					
					// 分数表記を浮動小数点式に変換する
					foreach($p as $i=&gt;$v){
						$p[$i] = fracToFloat($v);
					}
					
				}
				// 度分秒表記を10進数表記に変換
				$p = latlon60to10($p);
			}
			$res[$a] = $p;
		}
		
		return $res;
		
	}
	
	
	/**
	 * 分数表記を浮動小数点式に変換する
	 * @param string $str 分数表記の文字列 (例： 314/100)
	 * @return number 浮動小数値
	 */
	function fracToFloat($str){
	
		// 「/」が文字列中に存在しなかったり、空であったりするなら、引数を返して処理を抜ける
		if(!preg_match("/&yen;//", $str) || empty($str)){
			return $str;
		}
	
		// 「/」で分割して配列を作り、チェックと数値加工を施す。
		$ary=explode("/",$str);
		foreach($ary as $i =&gt; $v){
			$v = floatval ($v);
			if(is_numeric($v)){
				$ary[$i] = $v;
			}else{
				return $str;
			}
		}
	
		// 分母が0でないなら除算をする。
		if($ary[1]==0){
			return $str;
		}
		$v = $ary[0] / $ary[1];
	
		return $v;
	
	}
	
	
	
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
						
			if(count($ary) &lt; 3){
					return null;
			}
		}
	
		$res = $ary[0] + $ary[1]/60 + $ary[2]/3600;
	
		return $res;
	
	}
	
	?&gt;
	</pre>



	<div class="yohaku"></div>
	<ol class="breadcrumb">
		<li><a href="/">ホーム</a></li>
		<li><a href="/sample">サンプルソースコード</a></li>
		<li><a href="/sample/php">ＰＨＰ　｜　サンプル</a></li>
		<li>Exifを取得</li>
	</ol>

	<div id="footer"  >
		<a href="/">(c)wacgance</a> 2016-6-20 
	</div>
	

		


</div><!-- container  -->
</body>
</html>