<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>2日前のファイルだけ削除(ファイル日付によるファイル削除） | ワクガンス</title>
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
<div id="header" ><h1>2日前のファイルだけ削除(ファイル日付によるファイル削除） | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<pre><code>
&lt;?php 

$sample = new Sample();
$sample-&gt;removeFileByOldDay('sample', 2);

class Sample{
	
	/**
	 * 危険処理
	 * 指定日数より古い更新日のファイルをすべて削除する
	 *
	 * @note
	 *指定日数に2を指定した場合、二日以上前のファイルをすべて削除。
	 *0を指定すると、すべてのファイルを削除
	 *
	 * @param string $dp ディレクトリパス
	 * @param number $day_num 指定日数
	 */
	public function removeFileByOldDay($dp, $day_num = 1){
		
		$fps = $this-&gt;scandir3($dp); // ディレクトリ内にあるすべてのファイルのファイルパスを取得する
		$today = date("Y-m-d");
		
		foreach($fps as $fp){
			$dt = date("Y-m-d", filemtime($fp));
			$diff_day = $this-&gt;diffDay($today, $dt); // 2つの日付の日数差を算出する
			
			// 日付差が指定日数以上なら、ファイル削除を行う
			if($day_num &lt;= $diff_day){
				unlink($fp);
			}
		}
	}
	
	
	/**
	 * 2つの日付の日数差を算出する
	 *
	 * diff = d2 - d1
	 *
	 * @param date or string $d2
	 * @param date or string $d1
	 * @return int 日数差
	 */
	private function diffDay($d2,$d1){
		
		$u1=strtotime($d1);
		$u2=strtotime($d2);
		
		//日数を算出
		$diff=$u2-$u1;
		$d_cnt=$diff/86400;
		
		return $d_cnt;
	}
	
	
	/**
	 * scandir関数の拡張関数。
	 *
	 * @note
	 * 「.」「..」となっているファイル名は除外する。
	 *
	 * @param  string $dp ディレクトリ名
	 * @param string $sep セパレータ（省略可）
	 * @return array ファイルパスリスト
	 */
	private function scandir3($dp, $sep = '/'){
		$files = scandir($dp);
		
		// ディレクトリパスの末尾にセパレータを付け足す
		$dp2 = $dp;
		if(mb_substr($dp2, -1) != $sep){
			$dp2 .= $sep;
		}
		
		// 「.」,「..」名のファイルを除去、および日本語ファイルに対応。
		$fps = [];
		foreach($files as $file){
			if($file=='.' || $file=='..'){
				continue;
			}
			$fps[] = $dp2 . $file;
		}
		
		return $fps;
	}
}


function debug($var){
	echo '&lt;pre&gt;';
	var_dump($var);
	echo '&lt;/pre&gt;';
}

?&gt;
</code></pre>


<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>2日前のファイルだけ削除(ファイル日付によるファイル削除）</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2019-6-26</div>
</body>
</html>