<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>番号文字列から日付を取得する</title>
	
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
<div id="header" ><h1>番号文字列から日付を取得する</h1></div>
<div class="container">













<h2>検証</h2>
<?php 

$data = [
    
    '20120101010101',
    '20121212121212',
    '20121212',
    '20120101',
    '201212',
    '201201',
    '180102',
    '0101',
    '1212',
    '2018',
    '01',
    '12',
    '1',
    '2',
    '0',
    'a',
    null,

];

echo "<table class='tbl2'><thead><tr><th>番号文字列</th><th>日時</th><th>日時(時刻優先）</th></tr></thead><tbody>";

foreach($data as $str){
    
    $format = convNumStr2date($str);
    $format2 = convNumStr2date($str,1);
    echo "<tr><td>{$str}</td><td>{$format}</td><td>{$format2}</td></tr>";
}

echo "</tbody></table>";

/**
 * 文字列から適切な日時のフォーマットを取得する
 * 
 * @param string $str 日付文字列
 * @return string フォーマット
 */
function convNumStr2date($str,$time＿priority=0){

    if(empty($str)) return $str;
    if(!preg_match('/^\d+$/', $str)) return null;
     
    $ary = str_split($str, 2);
    $len = strlen($str);
    if($len == 14){
        
        // Y-m-d H:i:s
        return "{$ary[0]}{$ary[1]}-{$ary[2]}-{$ary[3]} {$ary[4]}:{$ary[5]}:{$ary[6]}";
    }else if($len == 8){
        // Y-m-d
        return "{$ary[0]}{$ary[1]}-{$ary[2]}-{$ary[3]}";
        
        
    }else if($len == 6){
        if($time＿priority == 0){
            if(preg_match('/^20\d[2](\/|-)([0-9]{1,2})/', $str)){
                // Y-m-d
                return "{$ary[0]}{$ary[1]}-{$ary[2]}";
            }else{
                // Y-m-d
                return "20{$ary[0]}-{$ary[1]}-{$ary[2]}";
            }
        }else{
            // H:i:s
            return "{$ary[0]}:{$ary[1]}:{$ary[2]}";
        }
        
    }else if($len == 4){
        if($time＿priority == 0){
            if(preg_match('/^20/', $str)){
                // Y
                return "{$ary[0]}{$ary[1]}";
            }else{
                // m-d
                return "{$ary[0]}-{$ary[1]}";
            }
        }else{
            // H:i
            return "{$ary[0]}:{$ary[1]}:00";
        }
    }else if($len == 1 || $len == 2){
        if($time＿priority == 0){
            return "{$ary[0]}";
        }else{
            return "{$ary[0]}:00:00";
        }
    }
    
    
    return null;
}
?>










<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">PHP ｜ サンプル</a></li>
	<li>番号文字列から日付を取得する</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-3-25</div>
</body>
</html>