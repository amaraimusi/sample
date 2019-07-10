<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>文字列から日時フォーマットを取得する</title>
	
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
<div id="header" ><h1>文字列から日時フォーマットを取得する</h1></div>
<div class="container">













<h2>検証</h2>
<?php 

$data = [
    '2012-12-12 12:12:12',
    '1970-01-01 12:12:12',
    '2045/12/31 23:59:59',
    '20120101000000',
    '20451231235959',
    '2012-3-10 1:15:1',
    '2012-1-1 1:1:1',
    '2018-03-27 14:35',
    '2012-1-1 1:1',
    '2012-12-31 23:59',
    '2012-1-1 1',
    '2012-1-1',
    '2012-1',
    '2012',
    '1999',
    '1-1',
    '12-12',
    '1:1:1',
    '12:12:12',
    '12:12',
    '12',
    '2012-32-12 12:12:12',
];

echo "<table class='tbl2'><thead><tr><th>文字列</th><th>フォーマット</th>><th>フォーマット（MySQL型）</th>><th>フォーマット（時刻優先）</th></tr></thead><tbody>";

foreach($data as $str){
    
    $format = getDateFormatFromString($str);
    $format2 = getDateFormatFromString($str,['mysql_format_flg'=>1]);
    $format3 = getDateFormatFromString($str,['time＿priority'=>1]);
    echo "<tr><td>{$str}</td><td>{$format}</td><td>{$format2}</td><td>{$format3}</td></tr>";
}

echo "</tbody></table>";

/**
 * 文字列から適切な日時のフォーマットを取得する
 * 
 * @param string $str 日付文字列
 * @param $format =  string フォーマット
 * @param $option
 *  - time＿priority 時刻優先フラグ    0:日付フォーマットを優先取得 , 1:時刻フォーマットを優先取得
 *  - mysql_format_flg MySQLフォーマットフラグ 0:PHP型の日時フォーマット , 1:MySQL型の日時フォーマット
 */
function getDateFormatFromString($str,$option=array()){

    $time＿priority = 0;
    if(!empty($option['time＿priority'])) $time＿priority = $option['time＿priority'];
    
    $mysql_format_flg = 0;
    if(!empty($option['mysql_format_flg'])) $mysql_format_flg = $option['mysql_format_flg'];
    

    $format = '';
    
    if(preg_match('/^\d+$/', $str)){
        
        $len = strlen($str);
        if($len == 14){
            $format =  'Y-m-d H:i:s';
        }else if($len == 8){
            $format =  'Y-m-d';
        }else if($len == 6){
            if($time＿priority == 0){
                $format =  'Y-m-d';
            }else{
                $format =  'H:i:s';
            }
            
        }else if($len == 4){
            if($time＿priority == 0){
                if(preg_match('/^[1-9][0-9]{3}$/', $str)){
                    $format =  'Y';
                }else{
                    $format =  'm-d';
                }
            }else{
                $format =  'H:i';
            }
        }else if($len == 1 || $len == 2){
            if($time＿priority == 0){
                $format =  'd';
            }else{
                $format =  'h';
            }
        }
    }
    else if(preg_match('/^[1-9]([0-9]{3})(\/|-)([0-9]{1,2})(\/|-)([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $str)){
        $format =  'Y-m-d H:i:s';
    }
    else if(preg_match('/^[1-9]([0-9]{3})(\/|-)([0-9]{1,2})(\/|-)([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2})/', $str)){
        $format =  'Y-m-d H:i';
    }
    else if(preg_match('/^[1-9]([0-9]{3})(\/|-)([0-9]{1,2})(\/|-)([0-9]{1,2}) ([0-9]{1,2})/', $str)){
        $format =  'Y-m-d H';
    }
    else if(preg_match('/^[1-9]([0-9]{3})(\/|-)([0-9]{1,2})(\/|-)([0-9]{1,2})/', $str)){
        $format =  'Y-m-d';
    }
    else if(preg_match('/^[1-9]([0-9]{3})(\/|-)([0-9]{1,2})/', $str)){
        $format =  'Y-m';
    }
    else if(preg_match('/^[1-9]([0-9]{3})$/', $str)){
        $format =  'Y';
    }
    else if(preg_match('/([0-9]{1,2})(\/|-)([0-9]{1,2})/', $str)){
        $format =  'm-d';
    }
    else if(preg_match('/([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $str)){
        $format =  'H:i:s';
    }
    else if(preg_match('/([0-9]{1,2}):([0-9]{1,2})/', $str)){
        $format =  'H:i';
    }
    
    
    if(!empty($mysql_format_flg)){
        $format2='';
        $ary = str_split($format);
        for($i=0;$i<count($ary);$i++){
            if($i % 2==0){
                $format2 .= '%' . $ary[$i];
            }else{
                $format2 .= $ary[$i];
            }
        }
        $format = $format2;
    }
    
    return $format;
}

?>










<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">PHP ｜ サンプル</a></li>
	<li>文字列から日時フォーマットを取得する</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-3-24</div>
</body>
</html>