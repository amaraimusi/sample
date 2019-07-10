<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>パスやURLのセパレータをそろえる</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	
</head>
<body>
<div id="header" ><h1>パスやURLのセパレータをそろえる</h1></div>
<div class="container">












<h2>デモ</h2>
<?php 

$data = array(
		'animals/cat/kuro-neko.html',
		'animals/cat/kuro-neko/',
		'animals/cat/kuro-neko',
		'/animals/cat\kuro-neko',
		'animals\cat\kuro-neko.html',
		'animals\cat\kuro-neko/',
		'animals\cat\kuro-neko',
		'\animals\cat/kuro-neko',
		'tanuki',
		'',
);


echo "<table class='tbl2'><thead><tr><th>元文字列</th><th>標準</th><th>スラッシュ</th><th>前後</th><th>前後無視</th></tr></thead><tbody>";

foreach($data as $str){
	
	$str1 = separateAlign($str);
	$str2 = separateAlign($str,'/');
	$str3 = separateAlign($str,null,1,1);
	$str4 = separateAlign($str,null,-1,-1);
	echo "<tr><td>{$str}</td><td>{$str1}</td><td>{$str2}</td><td>{$str3}</td><td>{$str4}</td></tr>";
}
echo "</tbody></table>";

/**
 * パスやURLのセパレータをそろえる
 * @param string $path パス文字列    パスやURLなどの文字列
 * @param string $separator セパレータ文字     未設定である場合は、自動
 * @param int $head_sep 先頭セパレータフラグ    0(デフォ):そのまま , -1:先頭セパレータを除去 , 1:先頭セパレータを付加
 * @param int $end_sep 末尾セパレータフラグ    0(デフォ):そのまま , -1:末尾セパレータを除去 , 1:末尾セパレータを付加
 * @return string セパレータをそろえた文字列
 */
function separateAlign($path,$separator=null,$head_sep=0,$end_sep=0){
	
	if(empty($path)) return $path;
	
	// セパレータが未設定である場合、パス文字列から自動判定する。
	if(empty($separator)){
		$a = strpos($path,'/');
		$b = strpos($path,"\\");
		if($a !==false && $b === false){
			$separator = '/';
		}elseif($a === false && $b !== false){
			$separator = "\\";
		}elseif($a === false &&  $a === false){
			$separator = DIRECTORY_SEPARATOR;
		}else{
			if($a < $b){
				$separator = '/';
			}else{
				$separator = "\\";
			}
		}
	}
	
	// セパレータをそろえる
	if($separator == '/'){
		$path = str_replace("\\", $separator, $path);
	}else{
		$path = str_replace('/', $separator, $path);
	}

	// 先頭セパレータフラグが1である場合、パス文字列の先頭にセパレータがなければ付加する
	if($head_sep == 1){
		$head_str = substr($path,0,1);// 先頭の一文字を取得
		if($head_str != $separator){
			$path = $separator . $path;
		}
	}
	
	// 先頭セパレータフラグが-1である場合、パス文字列の先頭にセパレータであれば除去する
	if($head_sep == -1){
		$head_str = substr($path,0,1);// 先頭の一文字を取得
		if($head_str == $separator){
			$path = substr($path,1); // 先頭の一文字を削る
		}
	}
	
	// 末尾セパレータフラグが1である場合、パス文字列の末尾にセパレータがなければ付加する
	if($end_sep == 1){
		$end_str = substr($path,-1); // 末尾の一文字を取得
		if($end_str != $separator){
			$path = $path . $separator;
		}
	}
	
	// 末尾セパレータフラグが-1である場合、パス文字列の末尾にセパレータであれば除去する
	if($end_sep == -1){
		$end_str = substr($path,-1); // 末尾の一文字を取得
		if($end_str == $separator){
			$path = substr($path,0,strlen($path) - 1);// 末尾の一文字を削る
		}
	}
	
	return $path;
	
}
?>










<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>パスやURLのセパレータをそろえる</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-4-11</div>
</body>
</html>