<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CSVの行が改行中であるか判定する | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/ImgCompactK.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>CSVの行が改行中であるか判定する | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<?php 
$data = [
		'"98","沖縄に生息するイモリ","TEST"',
		'99,abc',
		'100,シリケンイモリ,"沖縄に生息するイモリ"',
		'100,シリケンイモリ,"沖縄に生息する,イモリ"',
		'101,シリケンイモリ,"沖縄に生息するイモリ',
		'101,シリケンイモリ,"沖縄に生息するイモリ,',
		'102,シリケンイモリ,"沖縄に生息する',
		'103,シリケンイモリ,"',
		'104,シリケンイモリ,',
		'104,シリケンイモリ,,',
		'105,シリケンイモリ,"沖縄に""生息""するイモリ"',
		'106,シリケンイモリ,"沖縄に""生息""する',
		'107,シリケンイモリ,"""沖縄""に生息する,""イモリ"""',
		'107,シリケンイモリ, """沖縄""に生息する,""イモリ"""',
		"100,シリケンイモリ,\"X,末尾に改行&yen;n\"\n",
		"100,シリケンイモリ,\"X,末尾に改行&yen;r\"\r",
		"100,シリケンイモリ,\"X,末尾に改行&yen;n&yen;r\"\r\n",
		'"イモリ"',
		'"イモ',
		'"',
		'""""',
		'"""',
		'"シリケン","""',
		'107,シリケンイモリ,"沖縄',
		'に""生息""',
		'するイモリ"',
		'イモリ",',
		'社会福祉法人よつば会,風流里,滋賀県,大津市,大津市相撲町10-1,介護老人福祉施設・養護老人ホーム,介護老人福祉施設,775107320,775107321,"ユニット型,託児所あり"',
];

echo "<table class='tbl2'><thead><tr><th>CSVの行</th><th>判定</th></tr></thead><tbody>";
foreach($data as $csv_line){
	
	$msg = "<span class='text-success'>OK</span>";
	if(idDuringLineFeed($csv_line)){
		$msg = "<span class='text-danger'>改行中です</span>";
	}
	
	echo "<tr><td>{$csv_line}</td><td>{$msg}</td></tr>";
	
}
echo "</tbody></table>";

/**
 * CSVの行が改行中であるか判定する
 * @param string $csv_line CSVの行
 * @return true:改行中の行である
 */
function idDuringLineFeed($csv_line){
	if(empty($csv_line)) return false;
	
	$csv_line = trim($csv_line);
	$ary = preg_split("//u", $csv_line, -1, PREG_SPLIT_NO_EMPTY);
	
	$state = 0; // 0:初期状態, 1:通常状態, 2:ダブルクォート監視状態, 3:ダブルクォート内状態
	$dq_flg = 0; // 連続ダブルクォートフラグ   ダブルクォート内状態においてダブルクォートが連続するときONになる。
	$len = count($ary); // 文字数を取得する
	
	foreach($ary as $i => $one){
		// 文字が「,」である場合、
		if($one == ','){
			// 	初期状態
			switch ($state){
				case 0: // 初期状態
					$state = 1; // 通常状態にする
					break;
				case 1: // 通常状態
					$state = 2; // ダブルクォート監視状態にする。
					break;
				case 2: // ダブルクォート監視状態
					break;
				case 3: // ダブルクォート内状態
					break;
			}
		}
		
		// 文字が半角スペースである場合
		elseif($one == ' '){
			
			switch ($state){
				case 0: // 初期状態
					$state = 1; // 通常状態にする
					break;
				case 1: // 通常状態
					break;
				case 2: // ダブルクォート監視状態
					break;
				case 3: // ダブルクォート内状態
					break;
			}

		}

		// 文字が「"」である場合
		elseif($one == '"'){
			switch ($state){
				case 0: // 初期状態
					$state = 3; // ダブルクォート内状態
					break;
				case 1: // 通常状態
					break;
				case 2: // ダブルクォート監視状態
					$state = 3; // ダブルクォート内状態
					break;
				case 3: // ダブルクォート内状態
					
					if($dq_flg == 1){
						$dq_flg = 0; // 連続ダブルクォート状態を解除
						break;
					}
					// 次の文字はない
					if($i == $len-1){
						$state = 1; // 通常状態にする
						break;
					}
					
					// 次の文字はダブルクォートか？
					$next = $ary[$i + 1];
					if($next == '"'){
						$dq_flg = 1; // 連続ダブルクォート状態にする
						break;
					}
					
					// 次以降に最初に現れる文字は「,」か？（スペースは飛ばす）
					for($i2=$i+1; $i2<$len; $i2++){
						$nnext = $ary[$i2];
						if($nnext == ','){
							$state = 1; // 通常状態にする
							break;
						}elseif($nnext == ' '){
							continue;
						}else{
							break;
						}
					}
					break;
			}
		}
		
		// その他の文字である場合
		else{
			switch ($state){
				case 0: // 初期状態
					$state = 1; // 通常状態にする
					break;
				case 1: // 通常状態
					break;
				case 2: // ダブルクォート監視状態
					$state = 1; // 通常状態にする
					break;
				case 3: // ダブルクォート内状態
					break;
			}
		}
		
		$prev_state = $state;
	} // ループ終わり
	
	$flg = false;
	
	// ダブルクォート状態のまま担っている場合、「改行中」という判断を下す。
	if($state == 3){
		$flg = true;
	}
	
	return $flg;
}
?>


<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>CSVの行が改行中であるか判定する</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2019-5-25</div>
</body>
</html>