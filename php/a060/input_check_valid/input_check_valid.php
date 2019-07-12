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
	<th>年齢</th>
	<th>エラーメッセージ</th>
</tr></thead><tbody>
<?php 

    require_once 'InputCheckValid.php';
    $icv = new InputCheckValid(); // 入力チェックバリデーション
    
    $long_str = "ウナギ（鰻[2]、うなぎ）とは、ウナギ科(Anguillidae) ウナギ属(Anguilla) に属する魚類の総称である。世界中の熱帯から温帯にかけて分布する。ニホンウナギ、オオウナギ、ヨーロッパウナギ、アメリカウナギ（英語版）など世界で19種類（うち食用となるのは4種類）が確認されている";
    
    $data = [
        ['animal_name'=>'タウナギ', 'age'=>4],
        ['animal_name'=>'オオウナギ', 'age'=>1000],
        ['animal_name'=>'ドジョウ', 'age'=>-1],
        ['animal_name'=>'ウツボ', 'age'=>1.2],
        ['animal_name'=>'ウミヘビ', 'age'=>'a'],
        ['animal_name'=>$long_str, 'age'=>-1.2],
        [],
    ];
    
    // バリデーションデータ
    $validData=[
        'animal_name'=>['valid_type'=>'string', 'wamei'=>'動物名', 'len'=>4, 'req'=>1],
        'age'=>['valid_type'=>'int', 'wamei'=>'年齢', 'req'=>0, 'max'=>1000],
    ];
    
    $validData = $icv->normalizeValidData($validData); // バリデーションデータの正規化
    
    foreach($data as $ent){
        $animal_name = '';
        if(!empty($ent['animal_name'])) $animal_name = $ent['animal_name'];
        if(mb_strlen($animal_name) > 8){
            $animal_name = mb_substr($animal_name, 0, 8);
            $animal_name .= '...';
        }

		$age = '';
        if(isset($ent['age'])) $age = $ent['age'];
        $res1 = $icv->validEnt($ent, $validData);
        echo "<tr>";
        echo "<td>{$animal_name}</td>";
        echo "<td>{$age}</td>";
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