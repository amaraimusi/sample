<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>入力チェックバリデーション | InputCheckValid | ワクガンス</title>
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
<div id="header" ><h1>入力チェックバリデーション | InputCheckValid | ワクガンス</h1></div>
<div class="container">

<h2>Demo</h2>
<table class="tbl2"><thead><tr>
	<th>動物名</th>
	<th>日付1</th>
	<th>日時2</th>
	<th>エラーメッセージ</th>
</tr></thead><tbody>
<?php 

    require_once 'InputCheckValid.php';
    $icv = new InputCheckValid(); // 入力チェックバリデーション

    $data = [
        ['animal_name'=>'タウナギ', 'date1'=>'2019-7-2', 'dt2'=>'2019-7-2 12:12:12'],
        ['animal_name'=>'オオウナギ', 'date1'=>'2019/7/2', 'dt2'=>'2019-7-2'],
        ['animal_name'=>'ドジョウ', 'date1'=>'2019/2/29', 'dt2'=>'2019-7-2 1:2:3'],
        ['animal_name'=>'ウツボ', 'date1'=>'2012-12-12', 'dt2'=>'2019/7/2 23:59:59'],
        ['animal_name'=>'ウツボ', 'date1'=>'2012-12-12 1:2:3', 'dt2'=>'2019-7-2 12:12'],
        ['animal_name'=>'ウミヘビ', 'date1'=>'a','dt2'=>'a'],
        ['animal_name'=>'アシナシイモリ', 'date1'=>'','dt2'=>''],
        [],
    ];
    
    // バリデーションデータ
    $validData=[
        'animal_name'=>['valid_type'=>'string', 'wamei'=>'動物名', 'len'=>8, 'req'=>1],
        'date1'=>['valid_type'=>'date', 'wamei'=>'日付1', 'req'=>0],
        'dt2'=>['valid_type'=>'datetime', 'wamei'=>'日時2', 'req'=>0],
    ];
    
    $validData = $icv->normalizeValidData($validData); // バリデーションデータの正規化
    
    foreach($data as $ent){
        $animal_name = '';
        if(!empty($ent['animal_name'])) $animal_name = $ent['animal_name'];
        if(mb_strlen($animal_name) > 8){
            $animal_name = mb_substr($animal_name, 0, 8);
            $animal_name .= '...';
        }

        $date1 = '';
        if(isset($ent['date1'])) $date1 = $ent['date1'];
        $dt2 = '';
        if(isset($ent['dt2'])) $dt2 = $ent['dt2'];
        $res1 = $icv->validEnt($ent, $validData);
        echo "<tr>";
        echo "<td>{$animal_name}</td>";
        echo "<td>{$date1}</td>";
        echo "<td>{$dt2}</td>";
        echo "<td>{$res1}</td>";
        echo "</tr>";
    }
    
    function debug($value){
        echo '<pre>';
        var_dump($value);
        echo '</pre>';
    }
?>
</tbody></table>

<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>入力チェックバリデーション | InputCheckValid</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2019-7-11</div>
</body>
</html>