<?php
require_once 'ADebug.php';
$smps[]="ねこ,ねずみ,うし,とら,鵜";
$smps[]='"ねこ,猫",ねずみ,うし,とら,鵜';
$smps[]='ねこ,"ねずみ,n",",うし,",とら,鵜';
$smps[]='"赤い,ネコ",ねずみ,うし\"大型\",とら,"黒い,鵜"';
$smps[]='"ねこ,ねずみ,うし,とら,鵜';
$smps[]=",,,2403249,73982,3.08%,,,";
$smps[]=",,";
$smps[]='\"one';
$smps[]="";
$smps[]=null;
$smps[]='"",,\",",","",';

$data=null;
foreach($smps as $smp){
	$ary=splitEx($smp);

	$ent['str']=$smp;
	$ent['ary']=$ary;
	$data[]=$ent;
}


define("SDQ","%DXQ#");
define("SSQ","%SXQ#");

function splitEx($str){

	//「\"」を待避する。
	$s=$str;
	$n=mb_strpos($s,'\"',0);//「\"」を検索
	$sdqFlg=false;
	if(!empty($n) || $n===0){
		$sdqFlg=true;
		$s = str_replace('\"', SDQ, $s);//「\"」を待避させる。

	}

	//「"」でくくられた「,」を待避する。
	$dqFlg=false;
	$n=mb_strpos($s,'"',0);//「"」を検索
	if(!empty($n) || $n===0){
		$dqFlg=true;

		$ary=explode ( '"' , $s );
		for($i=1;$i<count($ary);$i=$i+2){
			//echo $i."-";
			$ary[$i]=str_replace(',', SSQ, $ary[$i]);//「,」待避させる
		}
		$s=join("",$ary);

	}

	//待避文字から「"」に戻す。
	if($sdqFlg==true){
		$s = str_replace(SDQ, '"', $s);
	}

	$ary=explode ( ',' , $s );//分解

	//待避文字から「,」に戻す。
	if($dqFlg==true){
		foreach($ary as $i=>$v){
			$ary[$i]=str_replace(SSQ,',', $v);
		}
	}


	return $ary;
}

?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>ダブルクォート区切りに対応したカンマ区切りの文字列を分解する</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script>



		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">ダブルクォート区切りに対応したカンマ区切りの文字列を分解する</h1>
		<div id="content" >
			<form name="form1"  action="#" method="post" enctype="multipart/form-data" >
				<div class="sec1">

				「,」でくくられた文字列を配列に分解する。
				ただし「"」でくくられている「,」では分解しない。<br />
				<br />
				例:「"ねこ,猫",ねずみ,うし,とら,鵜」<br>
				・配列<br>
				ねこ,猫<br>
				ねずみ<br>
				うし<br>
				とら<br>
				鵜<br>
				<br><br>
				「"」を文字列として認識させたい場合は「\"」とする。<br>
				例：「\"テスト\",test」<br>
				・配列<br>
				"テスト"<br>
				test<br>
				<br><br>



<strong>ソースコード</strong><br />
<pre>
	$smps[]="ねこ,ねずみ,うし,とら,鵜";
	$smps[]='"ねこ,猫",ねずみ,うし,とら,鵜';
	$smps[]='ねこ,"ねずみ,n",",うし,",とら,鵜';
	$smps[]='"赤い,ネコ",ねずみ,うし\"大型\",とら,"黒い,鵜"';
	$smps[]='"ねこ,ねずみ,うし,とら,鵜';
	$smps[]=",,,2403249,73982,3.08%,,,";
	$smps[]=",,";
	$smps[]='\"one';
	$smps[]="";
	$smps[]=null;
	$smps[]='"",,\",",","",';

	$data=null;
	foreach($smps as $smp){
		$ary=splitEx($smp);

		$ent['str']=$smp;
		$ent['ary']=$ary;
		$data[]=$ent;
	}


	define("SDQ","%DXQ#");
	define("SSQ","%SXQ#");

	function splitEx($str){

		//「\"」を待避する。
		$s=$str;
		$n=mb_strpos($s,'\"',0);//「\"」を検索
		$sdqFlg=false;
		if(!empty($n) || $n===0){
			$sdqFlg=true;
			$s = str_replace('\"', SDQ, $s);//「\"」を待避させる。

		}

		//「"」でくくられた「,」を待避する。
		$dqFlg=false;
		$n=mb_strpos($s,'"',0);//「"」を検索
		if(!empty($n) || $n===0){
			$dqFlg=true;

			$ary=explode ( '"' , $s );
			for($i=1;$i<count($ary);$i=$i+2){
				//echo $i."-";
				$ary[$i]=str_replace(',', SSQ, $ary[$i]);//「,」待避させる
			}
			$s=join("",$ary);

		}

		//待避文字から「"」に戻す。
		if($sdqFlg==true){
			$s = str_replace(SDQ, '"', $s);
		}

		$ary=explode ( ',' , $s );//分解

		//待避文字から「,」に戻す。
		if($dqFlg==true){
			foreach($ary as $i=>$v){
				$ary[$i]=str_replace(SSQ,',', $v);
			}
		}


		return $ary;
	}
</pre>

<br /><br /><br /><br />
<?php
	foreach($data as $ent){
		echo $ent['str']."<br />";
		if(isset($ent['ary'])){
			echo "<table border='1'><tbody>";
			$ary=$ent['ary'];
			foreach($ary as $v ){
				echo "<tr><td>{$v}</td></tr>";
			}
			echo "</tbody></table>";
		}
		echo "<hr /><br />";
	}
?>

				</div><!-- sec1 -->
			</form>
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/05/23</div>
		</div><!-- page1 -->
	</body>
</html>