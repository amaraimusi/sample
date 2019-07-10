<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ディレクトリパスの末尾のセパレータを除去、もしくは追加 | ワクガンス</title>
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
<div id="header" ><h1>ディレクトリパスの末尾のセパレータを除去、もしくは追加 | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<pre><code>

    $tests =[
        'neko',
        'neko/',
        'animal/neko',
        'x/animal/neko/',
    ];
    
    echo "&lt;table class='tbl2'&gt;&lt;thead&gt;&lt;tr&gt;&lt;th&gt;元データ&lt;/th&gt;&lt;th&gt;末尾のセパレータ無し&lt;/th&gt;&lt;th&gt;末尾のセパレータ有り&lt;/th&gt;&lt;/tr&gt;&lt;/thead&gt;&lt;tbody&gt;";
    foreach($tests as $dp){
        echo "&lt;tr&gt;";
        echo "&lt;td&gt;{$dp}&lt;/td&gt;";
        
        $dp1 = dpEndSp($dp);
        echo "&lt;td&gt;{$dp1}&lt;/td&gt;";
        
        $dp2 = dpEndSp($dp, true);
        echo "&lt;td&gt;{$dp2}&lt;/td&gt;";
        
        echo "&lt;/tr&gt;";
    }
    echo "&lt;/tbody&gt;&lt;/table&gt;";
    
    
    /**
     * ディレクトリパスの末尾のセパレータを除去、もしくは追加 
     * @param string $dp ディレクトリパス
     * @param boolean $end_sep_flg false:セパレータ除去(def), true:セパレータ追加
     * @param string $sep セパレータ
     * @return string ディレクトリパス
     */
    function dpEndSp($dp, $end_sep_flg=false, $sep ='/'){
        
        if(empty($dp)) return '';
        
        $e_s = mb_substr($dp, -1);
        if($e_s==$sep &amp;&amp; $end_sep_flg==false ){
            $dp = mb_substr($dp, 0, mb_strlen($dp)-1);
        }elseif($e_s!=$sep &amp;&amp; $end_sep_flg==true ){
            $dp .= $sep;
        }
        
        return $dp;
    }
</code></pre>
<?php 
    $tests =[
        'neko',
        'neko/',
        'animal/neko',
        'x/animal/neko/',
    ];
    
    echo "<table class='tbl2'><thead><tr><th>元データ</th><th>末尾のセパレータ無し</th><th>末尾のセパレータ有り</th></tr></thead><tbody>";
    foreach($tests as $dp){
        echo "<tr>";
        echo "<td>{$dp}</td>";
        
        $dp1 = dpEndSp($dp);
        echo "<td>{$dp1}</td>";
        
        $dp2 = dpEndSp($dp, true);
        echo "<td>{$dp2}</td>";
        
        echo "</tr>";
    }
    echo "</tbody></table>";
    
    
    /**
     * ディレクトリパスの末尾のセパレータを除去、もしくは追加 
     * @param string $dp ディレクトリパス
     * @param boolean $end_sep_flg false:セパレータ除去(def), true:セパレータ追加
     * @param string $sep セパレータ
     * @return string ディレクトリパス
     */
    function dpEndSp($dp, $end_sep_flg=false, $sep ='/'){
        
        if(empty($dp)) return '';
        
        $e_s = mb_substr($dp, -1);
        if($e_s==$sep && $end_sep_flg==false ){
            $dp = mb_substr($dp, 0, mb_strlen($dp)-1);
        }elseif($e_s!=$sep && $end_sep_flg==true ){
            $dp .= $sep;
        }
        
        return $dp;
    }
?>



<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>ディレクトリパスの末尾のセパレータを除去、もしくは追加</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2019-7-10</div>
</body>
</html>