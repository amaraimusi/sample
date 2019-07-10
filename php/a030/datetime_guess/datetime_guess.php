<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>部分文字列から日時情報を推測するクラス</title>
	
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
<div id="header" ><h1>部分文字列から日時情報を推測するクラス</h1></div>
<div class="container">














<h2>検証</h2>

<table class='tbl2'><thead><tr>
	<th>元の日時文字列</th>
	<th>datetime_a</th>
	<th>format_a</th>
	<th>datetime_b</th>
	<th>format_b</th>
	<th>format_mysql_a</th>
	<th>format_mysql_b</th>
</tr></thead><tbody>

<?php 
$data = [
   '2018-3-31 7:39:57',
    '2018/3/31 7:39:57',
    '2018-03-31 07:39:57',
    '2018-3-31 7:39',
    '2018-3-31 7',
    '2018-3-31',
    '2018-3',
    '2018',
    '7:39:57',
    '7:39',
    '7',
    '20180331073957',
    '201803310739',
    '2018033107',
    '20180331',
    '201803',
    '2018',
   '073957',
    '0739',
    '07',
    '3/31',
    '201404',
    '199912',
    '1999',
];

require_once 'DatetimeGuess.php';
$datetimeGuess = new DatetimeGuess();
foreach($data as $str){
    
    $info = $datetimeGuess->guessDatetimeInfo($str);

    echo 
        "<tr>
            <td>{$info['orig_datetime']}</td>
            <td>{$info['datetime_a']}</td>
            <td>{$info['format_a']}</td>
            <td>{$info['datetime_b']}</td>
            <td>{$info['format_b']}</td>
            <td>{$info['format_mysql_a']}</td>
            <td>{$info['format_mysql_b']}</td>
        </tr>";
}
?>
</tbody></table>









<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>部分文字列から日時情報を推測するクラス</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-3-31</div>
</body>
</html>