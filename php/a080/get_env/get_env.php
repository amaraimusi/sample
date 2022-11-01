<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>.envファイルから設定値を取得するオリジナル関数 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery.min.js"></script>	
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/vue.min.js"></script>

</head>
<body>
<div id="header" ><h1>.envファイルから設定値を取得するオリジナル関数 | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>


<p>ソースコード</p>
<pre><code>
&lt;?php 

$envs = getEnvSimple('.env');
echo '&lt;pre&gt;';
var_dump($envs);
echo '&lt;/pre&gt;';

function getEnvSimple($env_fn) {
    
    // 引数のiniファイル名が空、もしくは存在しなければ、なら、nullを返して終了
    if (! $env_fn)  return null;
    
    
    $str = null;
    $env_fn=mb_convert_encoding($env_fn,'SJIS','UTF-8');
    if (!is_file($env_fn)){
        return null;
    }
    
    if ($fp = fopen ( $env_fn, "r" )) {
        $data = array ();
        while ( false !== ($line = fgets ( $fp )) ) {
            $str .= mb_convert_encoding ( $line, 'utf-8', 'utf-8,sjis,euc_jp,jis' );
        }
    }
    fclose ( $fp );
    
    $ary = preg_split( "/&yen;R/", $str );
    
    $envs = [];
    foreach($ary as $line_str){
        $line_str = trim($line_str);
        if(empty($line_str)) continue;
        
        $ary2 = preg_split("/=/", $line_str);
        if(count($ary2) &lt; 2) continue;
        
        $key = trim($ary2[0]);
        if(empty($key)) continue;
        
        $envs[$key] = trim($ary2[1]);
        
    }
    
    return $envs;
}

?&gt;
</code></pre>

<hr>

<p>出力</p>
<?php 

$envs = getEnvSimple('.env');
echo '<pre>';
var_dump($envs);
echo '</pre>';

function getEnvSimple($env_fn) {
    
    // 引数のiniファイル名が空、もしくは存在しなければ、なら、nullを返して終了
    if (! $env_fn)  return null;
    
    
    $str = null;
    $env_fn=mb_convert_encoding($env_fn,'SJIS','UTF-8');
    if (!is_file($env_fn)){
        return null;
    }
    
    if ($fp = fopen ( $env_fn, "r" )) {
        $data = array ();
        while ( false !== ($line = fgets ( $fp )) ) {
            $str .= mb_convert_encoding ( $line, 'utf-8', 'utf-8,sjis,euc_jp,jis' );
        }
    }
    fclose ( $fp );
    
    $ary = preg_split( "/\R/", $str );
    
    $envs = [];
    foreach($ary as $line_str){
        $line_str = trim($line_str);
        if(empty($line_str)) continue;
        
        $ary2 = preg_split("/=/", $line_str);
        if(count($ary2) < 2) continue;
        
        $key = trim($ary2[0]);
        if(empty($key)) continue;
        
        $envs[$key] = trim($ary2[1]);
        
    }
    
    return $envs;
}

?>



<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>.envファイルから設定値を取得するオリジナル関数</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2022-11-1</div>
</body>
</html>