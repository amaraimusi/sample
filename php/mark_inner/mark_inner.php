<?php
	require_once 'StringUtil.php';
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>２つの文字に挟まれた文字列を取得する</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script>

		</script>

		<style type="text/css">
			label{
				width:100px;
				}
		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">２つの文字に挟まれた文字列を取得する</h1>
		<div id="content" >

			<div class="sec1">

<?php
	$str="ハローワールドイヌネコヤギヘビカニブタウシ";
	$s1="ヤギ";
	$s2="カニ";
	$util=new StringUtil();
	$s3=$util->markInner($str,$s1,$s2);

	echo "<div><label>str=</label>{$str}</div>";
	echo "<div><label>s1=</label>{$s1}</div>";
	echo "<div><label>s2=</label>{$s2}</div>";
	echo "<div><label>s3=</label>{$s3}</div>";


?>

			</div><!-- sec1 -->

<hr>
<strong>ソース</strong>
<pre>
	require_once 'StringUtil.php';
	$str="ハローワールドイヌネコヤギヘビカニブタウシ";
	$s1="ヤギ";
	$s2="カニ";
	$util=new StringUtil();
	$s3=$util->markInner($str,$s1,$s2);

	echo s3;
</pre>
<br>
<strong>StringUtil.php</strong>
<pre>
class StringUtil{
	/**
	 * ２つの囲み文字に挟まれた文字列を取得する
	 * @param  $str	対象文字列
	 * @param  $s1	囲み文字1
	 * @param  $s2	囲み文字2
	 */
	public function markInner($str,$s1,$s2){

		$s_r=$this->stringRight($str,$s1);

		$s=$this->stringLeft($s_r,$s2);


		return $s;
	}



	/**
	 * 左から印文字を探し、見つかった場所から左側の文字列を返す。（印文字は含めず）
	 * 検索文字列が存在しない場合は、対象文字列をそのまま返す。
	 * 検索文字列が先頭にあった場合も、対象文字列をそのまま返す。
	 * @param  $str　対象文字列
	 * @param  $mark　印文字列
	 * @return string
	 */
	function stringLeft($str,$mark){
		$a=mb_strpos($str,$mark,0,'utf8');
		if(!isset($a)){return $str;}
		$len=mb_strlen($str,'utf8');
		$rtn=mb_substr($str,0,$a,'utf8');

		return $rtn;
	}

	/**
	 * 左から印文字を探し、見つかった場所から右側の文字列を返す。（印文字は含めず）
	 * 検索文字列が存在しない場合は、対象文字列をそのまま返す。
	 * 検索文字列が先頭にあった場合も、対象文字列をそのまま返す。
	 * @param  $str　対象文字列
	 * @param  $mark　印文字
	 * @return string　
	 */
	function stringRight($str,$mark){
		$a=mb_strpos($str,$mark,0,'utf8');
		if(!isset($a)){return $str;}
		$len=mb_strlen($str,'utf8');
		$m_l=mb_strlen($mark,'utf8');
		$rtn=mb_substr($str,$a+$m_l,$len,'utf8');

		return $rtn;
	}





}
</pre>

		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/07/15</div>
		</div><!-- page1 -->
	</body>
</html>