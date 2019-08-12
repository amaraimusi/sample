<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>手入力日時の自動変換 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>手入力日時の自動変換 | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<table class="tbl2"><thead>
	<tr><th>手入力日時</th><th>結果</th><th>エラー</th></tr></thead>
<tbody>
<?php

$tests = [
	"2012/12/12 12:12:12",
	"2012-12-12 12:12:12",
	"2012-12-12 12時13分14秒",
	"2012年12月12日 12時13分14秒",
	"連続スペース2012年12月12日      12時13分14秒",
	"2012-12-12",
	"ネコの日2012-12-12",
	"ヤギの日2012/1/2 1:2:3 公表",
	"シカの日2012/12/12 1:2 公表",
	"４月１５日",
	"５時３０分",
	"テスト２０１２年２月１５日公表",
	"8/31",
	"5:30",
	"2013/2/29",
	"あいうえお",
	"あ15",
	"　全角２０１９年８月１５日　１４時5分５８秒",
	"　２０１９・８・１５日・１４：5：５８　秒",
	"　２０１９／８／１５日・１４：5：５８　秒",
	"４５日",
	"２０１９年４月",
	"２０１９年",
	"１０月",
	"３１日",
	"１６時",
	"８分",
	"５秒",
	
];

foreach($tests as $value){
	
	$res = humanInputDateTime($value);
	$value2 = $res['date'];
	$err = $res['err'];
	
	echo "<tr><td>{$value}</td><td>{$value2}</td><td>{$err}</td></tr>";
}

/**
 * 手入力日時の自動変換 
 * 
 * @note
 * 手入力による様々な日付文字列入力を正しい日付フォーマットに自動変換する。
 * 全角数値は半角数値に変換される。
 * 日付文字列の前後に文字列があっても問題ない。
 * 
 * 例)
 * 「山の日８月１２日公共」 → 2019-8-12 12:13:14
 * 
 * @param string $date_str 日付文字列
 * @param string $format 日付フォーマット（デフォ：Y-m-d h:i:s）
 * @return array
 *  - value 自動変換後の日付
 *  - err 入力エラー文字列
 */
function humanInputDateTime($date_str, $format='Y-m-d h:i:s'){
	
	$date_str0 = $date_str;
	
	$res = ['date'=>$date_str, 'err'=>''];
	if(empty($date_str)) return $res;
	
	$date_str = mb_convert_kana($date_str, 'n'); // 全角を半角に変換する
	$date_str = mb_convert_kana($date_str, 's'); // 全角スペースを半角に変換する
	$date_str = mb_convert_kana($date_str, 'a'); // 全角記号半角に変換する
	$date_str = str_replace('・', '/', $date_str); // 「・」はスラッシュに置換する
	$date_str = trim($date_str);
	$date_str = preg_replace('/\s(?=\s)/', '', $date_str); // 連続スペースを一つにする
	if(empty($date_str)) return $res;
	$date_str = str_replace('日 ', ' ', $date_str);
	
	
	
	// Y/m/d h:i:s
	$date = '';
	$re = '/([0-9]{4})(\/|-|年)([0-9]{1,2})(\/|-|月)([0-9]{1,2})(日|\s)([0-9]{1,2})(:|時)([0-9]{1,2})(:|分)([0-9]{1,2})/';
	preg_match($re, $date_str, $match);
	if(!empty($match)){
		$date = $match[0];
	}
	
	// Y/m/d h:i
	if(empty($date)){
		$re = '/([0-9]{4})(\/|-|年)([0-9]{1,2})(\/|-|月)([0-9]{1,2})(日|\s)([0-9]{1,2})(:)([0-9]{1,2})/';
		preg_match($re, $date_str, $match);
		if(!empty($match)){
			$date = $match[0];
			$date .= ':00';
		}
	}
	
	// Y/m/d
	if(empty($date)){
		$re = '/([0-9]{4})(\/|-|年)([0-9]{1,2})(\/|-|月)([0-9]{1,2})/';
		preg_match($re, $date_str, $match);
		if(!empty($match)){
			$date = $match[0];
			$date .= ' 00:00:00';
		}
	}
	
	// m/d
	if(empty($date)){
		$re = '/([0-9]{1,2})(\/|-|月)([0-9]{1,2})/';
		preg_match($re, $date_str, $match);
		if(!empty($match)){
			$date = $match[0];
			$date = date('Y') . '/' . $date . ' 00:00:00';
		}
	}
	
	// y/m
	if(empty($date)){
		$re = '/([0-9]{4})(\/|-|年)([0-9]{1,2})/';
		preg_match($re, $date_str, $match);
		if(!empty($match)){
			$date = $match[0];
			$date .= '/1 00:00:00';
		}
	}
	
	// h:i:s
	if(empty($date)){
		$re = '/([0-9]{1,2})(:|時)([0-9]{1,2})(:|分)([0-9]{1,2})/';
		preg_match($re, $date_str, $match);
		if(!empty($match)){
			$date = $match[0];
			$date = date('Y/m/d') . ' ' . $date;
		}
	}
	
	// h:i
	if(empty($date)){
		$re = '/([0-9]{1,2})(:|時)([0-9]{1,2})/';
		preg_match($re, $date_str, $match);
		if(!empty($match)){
			$date = $match[0];
			$date = date('Y/m/d') . ' ' . $date . ':00';
		}
	}
	
	// Y
	if(empty($date)){
		$re = '/([0-9]{4})(年)/';
		preg_match($re, $date_str, $match);
		if(!empty($match)){
			$date = $match[0];
			$date = $date . '1/1 00:00:00';
		}
	}
	
	// m
	if(empty($date)){
		$re = '/([0-9]{1,2})(月)/';
		preg_match($re, $date_str, $match);
		if(!empty($match)){
			$date = $match[0];
			$date = date('Y') . '/' . $date . '1 00:00:00';
		}
	}
	
	// 日
	if(empty($date)){
		$re = '/([0-9]{1,2})(日)/';
		preg_match($re, $date_str, $match);
		if(!empty($match)){
			$date = $match[0];
			$date = date('Y/m') . '/' . $date . ' 00:00:00';
		}
	}
	
	// 時
	if(empty($date)){
		$re = '/([0-9]{1,2})(時)/';
		preg_match($re, $date_str, $match);
		if(!empty($match)){
			$date = $match[0];
			$date = date('Y/m/d') . ' ' . $date . '00:00';
		}
	}
	
	// 分
	if(empty($date)){
		$re = '/([0-9]{1,2})(分)/';
		preg_match($re, $date_str, $match);
		if(!empty($match)){
			$date = $match[0];
			$date = date('Y/m/d h:')  . $date . '00';
		}
	}
	
	// 秒
	if(empty($date)){
		$re = '/([0-9]{1,2})(秒)/';
		preg_match($re, $date_str, $match);
		if(!empty($match)){
			$date = $match[0];
			$date = date('Y/m/d h:i:') . $date ;
		}
	}
	
	$date = preg_replace('/年|月/', '/', $date);
	$date = preg_replace('/時|分/', ':', $date);
	$date = preg_replace('/日|秒/', '', $date);
	
	$err = isDatetime($date); // 日時チェック
	
	if(empty($err)){
		$date = date($format); // フォーマット変換
	}else{
		$err .= '→' . $date;
		$date = '';
	}

	$res['date'] = $date;
	$res['err'] = $err;
	
	return $res;
}


/**
 * 日時入力チェックのバリデーション
 * ※日付のみあるいは時刻は異常と見なす。
 * @param string $str_dt	日時文字列
 * @param bool $req	入力必須フラグ false:空許可(デフォ), true:入力必須
 * @return string	エラー文字列  正常のときはnull
 * @date 2015-10-5 | 2019-8-12
 */
function isDatetime($str_dt, $req=false){
	
	//空値且つ、必須入力がnullであれば、trueを返す。
	if(empty($str_dt) && empty($req)){
		return null;
	}
	
	//日時を　年月日時分秒に分解する。
	//$aryA =preg_split( '|[ /:_-]|', $str_dt );
	$aryA =preg_split("[\/|-|:|\s]", $str_dt );
	if(count($aryA)!=6){
		return '日時形式ではありません。';
	}
	
	foreach ($aryA as $key => $val){
		
		//▼正数以外が混じっているば、即座にfalseを返して処理終了
		if (!preg_match("/^[0-9]+$/", $val)) {
			return '文字列が混じっています。';
		}
		
	}
	
	//▼グレゴリオ暦と整合正が取れてるかチェック。（閏年などはエラー） ※さくらサーバーではemptyでチェックするとバグになるので注意。×→if(empty(checkdate(12,11,2012))){・・・}
	if(checkdate($aryA[1],$aryA[2],$aryA[0])==false){
		return '存在しない日付です(グレゴリオ暦)。';
	}
	
	//▼時刻の整合性をチェック
	if($aryA[3] < 0 || $aryA[3] > 23){
		return '時刻に異常があります。';
	}
	if($aryA[4] < 0 ||  $aryA[4] > 59){
		return '「分」に異常があります。';
	}
	if($aryA[5] < 0 || $aryA[5] > 59){
		return '秒に異常があります。';
	}
	
	return null;
}
?>
</tbody></table>

<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>s
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>手入力日時の自動変換</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2019-8-12</div>
</body>
</html>