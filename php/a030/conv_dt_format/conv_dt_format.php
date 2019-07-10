<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>部分的日時のフォーマット変換</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/PanelX.js"></script>
	<script src="/note_prg/js/img_panel_x.js"></script>


	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>部分的日時のフォーマット変換</h1></div>
<div class="container">













<h2>検証</h2>
<table class='tbl2'><thead><tr>
	<th>部分的日付（入力）</th>
	<th>部分的日付のフォーマット</th>
	<th>変換先のフォーマット</th><th>出力</th></tr></thead><tbody>
	
<?php 
$data = [
    ['2012-1-12 12:34:56' , 'Y-m-d H:i:s' , 'Y/m/d H:i'],
    ['2012/1/12 12:34:56' , 'Y-m-d H:i:s' , 'Y-m-d H:i'],
    ['1-12' , 'm-d' , 'Y-m-d H:i:s'],
    ['2018' , 'Y' , 'Y-m-d H:i:s'],
    ['1:2:3' , 'H:i:s' , 'Y-m-d H:i:s'],
    ['08 34:56' , 'm i:s' , 'Y-m-d H:i'],
];


foreach($data as $ent){
    
    $dt1 = $ent[0]; // 部分的日時
    $format1 = $ent[1]; // 部分的日時のフォーマット
    $format2 = $ent[2]; // 変換先のフォーマット
    $dt2 = convDatetimeFormat($dt1,$format1,$format2); // フォーマット変換された日時
    echo "<tr><td>{$dt1}</td><td>{$format1}</td><td>{$format2}</td><td>{$dt2}</td></tr>";
}

?>
</tbody></table>

<?php 
/**
 * 部分的日時のフォーマット変換
 * @param string $str 部分的日時
 * @param string $format1 部分的日時のフォーマット
 * @param string $format2 変換先のフォーマット
 * @param array $option オプション
 *  - digit2_flg 2桁そろえフラグ    0:2桁に揃えず , 1(デフォルト）:2桁に揃える（ 例： 8 → 08）
 * @return string フォーマット変換された日時
 */
function convDatetimeFormat($str,$format1,$format2,$option=array()){
    
    $digit2_flg = 1;
    if(isset($option['digit2_flg'])) $digit2_flg = $option['digit2_flg'];

    $list = preg_split("/[-\/\s:]/", $str);
    $fmts1 = preg_split("/[-\/\s:]/", $format1);
    $fKeys1 = array_flip($fmts1);
    $fmts2 = preg_split("/[-\/\s:]/", $format2);

    $str2 = $format2;
    foreach($fmts2 as $i => $key){
        $v = null;
        if(isset($fKeys1[$key])){
            $fk_i = $fKeys1[$key];
            $v = $list[$fk_i];
        }else{
            switch ($key) {
                case 'Y': $v = date('Y'); break;
                case 'm': $v = '1'; break;
                case 'd': $v = '1'; break;
                case 'H': $v = '0'; break;
                case 'i': $v = '0'; break;
                case 's': $v = '0'; break;
            }
        }
        
        if(!empty($digit2_flg) && strlen($v) == 1){
            $v = '0' . $v;
        }
        
        $str2 = str_replace($key, $v, $str2);
    }
    return $str2;
}


?>






<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>部分的日時のフォーマット変換</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-3-30</div>
</body>
</html>