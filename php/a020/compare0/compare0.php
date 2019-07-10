<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>特殊比較：ゼロ比較</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/PanelX.js"></script>
	<script src="/note_prg/js/img_panel_x.js"></script>
</head>
<body>
<div id="header" ><h1>特殊比較：ゼロ比較</h1></div>
<div class="container">




<h2>デモ</h2>
<?php 

$keys = ['neko','yagi','inu','kani','sake','nomi','toki','usi','hituji','abu','ari'];
$aryA = ['neko'=>'0','inu'=>'','yagi'=>0,'kani'=>null,'sake'=>false,'nomi'=>'ノミ','usi'=>1,'hituji'=>'1','abu'=>'1.0','ari'=>true,'toki'=>''];
$aryB = ['neko'=>'0','inu'=>'','yagi'=>0,'kani'=>null,'sake'=>false,'nomi'=>'ノミ','usi'=>1,'hituji'=>'1','abu'=>'1.0','ari'=>true];

echo "<table class='tbl2'><thead><tr><th>A</th><th>B</th><th>一致</th></tr></thead><tbody>";

$output = array();
foreach($keys as $key){
    
    $a_value = null;
    if(isset($aryA[$key])) $a_value = $aryA[$key];
    
    foreach($keys as $key_b){
        $b_value = null;
        if(isset($aryB[$key_b])) $b_value = $aryB[$key_b];
        
        $res = _compare0($a_value,$b_value);
        output($key,$a_value,$key_b,$b_value,$res);
    }

}

echo "</tbody></table>";


echo '<br>----<br>';
if('ノミ'==0){
    echo '一致';
}else{
    echo '不一致';
}


/**
 *	ゼロ比較
 *
 * @note
 * 比較用のカスタマイズ関数。
 * ただし、空の値の比較は0とそれ以外の空値（null,"",falseなど）で仕様が異なる。
 * 0とそれ以外の空値（null,"",falseなど）は不一致のみなす。
 * 0と'0'は一致と判定する。
 * null,'',falseのそれぞれの組み合わせは一致である。
 * bool型のtrueは数字の1と同じ扱い。（※通常、2や3でもtrueとするが、この関数では1だけがtrue扱い）
 * 1.0 , 1 , '1' など型が異なる数値を一致と判定する。
 *
 * @param $a_value
 * @param $b_value
 * @return bool false:不一致 , true:一致
 */
function _compare0($a_value,$b_value){
    if(empty($a_value) && empty($b_value)){
        if($a_value === 0 || $a_value === '0'){
            if($b_value === 0 || $b_value === '0'){
                return true;
            }else{
                return false;
            }
            
        }else{
            if($b_value === 0 || $b_value === '0'){
                return false;
            }else{
                return true;
            }
            
        }
        
    }else{
        
        if(gettype($a_value) == 'boolean'){
            if($a_value){
                $a_value = 1;
            }else{
                $a_value = 0;
            }
        }
        if(gettype($b_value) == 'boolean'){
            if($b_value){
                $b_value = 1;
            }else{
                $b_value = 0;
            }
        }
        
        
        if(is_numeric($a_value) && is_numeric($b_value)){
            if($a_value == $b_value) return true;
        }else{
            if($a_value === $b_value) return true;
            
        }
    }
    
    return false;
    
}



function output($key,$a_value,$key_b,$b_value,$res){
    
    if(gettype($a_value) == 'string') $a_value = "'" . $a_value . "'";
    if(gettype($b_value) == 'string') $b_value = "'" . $b_value . "'";
    
    if(gettype($a_value) == 'boolean'){
        if($a_value){
            $a_value = 'true';
        }else{
            $a_value = 'false';
        }
    }
    
    if(gettype($b_value) == 'boolean'){
        if($b_value){
            $b_value = 'true';
        }else{
            $b_value = 'false';
        }
    }
    
    
    $a_str = "{$key}=>{$a_value}";
    $b_str = "{$key_b}=>{$b_value}";
    
    $res_str = "<span class='text-success'>〇</span>";
    if(empty($res)) $res_str = "<span class='text-danger'>×</span>";
    
    echo "<tr><td>{$a_str}</td><td>{$b_str}</td><td>{$res_str}</td></tr>";
}


?>




<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>特殊比較：ゼロ比較</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-3-15</div>
</body>
</html>