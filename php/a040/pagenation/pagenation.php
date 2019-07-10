<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ページネーション | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/ImgCompactK.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>ページネーション | ワクガンス</h1></div>
<div class="container">


<?php 

$page_no = 0;
if(!empty($_GET['page_no'])){
	$page_no = $_GET['page_no'];
}

$base_url = "/sample/php/a040/pagenation/pagenation.php";
$all_data_cnt = 100;
$row_limit = 10;
$midasi_cnt = 5;
$params = ['a' => 'neko' , 'b' => 'buta'];


$res = createpagenationHtml($base_url, $page_no, $all_data_cnt, $row_limit, $midasi_cnt, $params);

echo $res['mokuji'];

/**
 * ページネーション用の目次HTMLを作成する
 * @param int $page_no	現在のページ番号（0から開始）
 * @param int $all_data_cnt 全データ数
 * @param int $row_limit 行制限数(LIMIT)
 * @param int $midasi_cnt 表示するペースの数
 * @param array $params リンクのURLに付加するパラメータ（キー、値）
 * @param array $option
 *  - page_field ページフィールド名： def→ page_no
 * @return array ページネーションデータ
 */
function createpagenationHtml($base_url, $page_no, $all_data_cnt, $row_limit, $midasi_cnt, $params, $option = array()){
	
	// ページネーションデータ
	$pagenationData = array(
			'mokuji'=>'', // 目次HTML
			'page_prev_link'=>'',
			'page_next_link'=>'',
			'page_top_link'=>'',
			'page_last_link'=>'',
			'query_str'=>'',
			'base_url' => $base_url,
			'page_no' => $page_no,
			'all_data_cnt' => $all_data_cnt,
			'row_limit' => $row_limit,
			'midasi_cnt' => $midasi_cnt,
	);
	if($all_data_cnt == 0) return $pagenationData;
	if(empty($row_limit)) return $pagenationData;
	
	// オプションの初期化
	if(empty($option['page_field'])) $option['page_field'] ='page_no';
	
	$page_field = $option['page_field'];
	
	
	//▼ページネーションを構成する総リンク数をカウントする。
	$allMdCnt = ceil($all_data_cnt / $row_limit);
	$md2 = $allMdCnt;
	if($md2 > $midasi_cnt){
		$md2 = $midasi_cnt;
	}
	$linkCnt =4 + $md2;
	
	//▼最終ページ番号を取得
	if($md2 > 0){
		$lastPageNo = $allMdCnt-1;
	}
	
	$strParams='';
	if(!empty($params)){
		//▼その他パラメータコードを作成する。
		foreach($params as $key=>$val){
			if($val !== null && $val !== '')
				$strParams = $strParams.'&'.$key.'='.$val;
		}
	}
	
	//▼最戻リンクを作成
	$page_top_link = '';
	$rtnMax = '&lt&lt';
	if($page_no > 0){
		$url = "{$base_url}?{$page_field}=0{$strParams}";
		$page_top_link = $url;
		$rtnMax="<a href='{$url}'>{$rtnMax}</a>";
	}
	
	//▼単戻リンクを作成
	$rtn1='&lt';
	$page_prev_link = '';
	if($page_no > 0){
		$p=$page_no - 1;
		$url = "{$base_url}?{$page_field}={$p}{$strParams}";
		$page_prev_link = $url;
		$rtn1 = "<a href='{$url}'>{$rtn1}</a>";
	}
	
	//▼単進リンクを作成
	$page_next_link = '';
	$next1='&gt';
	if($page_no < $lastPageNo){
		$p=$page_no + 1;
		$url = "{$base_url}?{$page_field}={$p}{$strParams}";
		$page_next_link = $url;
		$next1 = "<a href='{$url}'>{$next1}</a>";
	}
	
	//▼最進リンクを作成
	$page_last_link = '';
	$nextMax='&gt&gt';
	if($page_no < $lastPageNo){
		$p=$lastPageNo;
		$url = "{$base_url}?{$page_field}={$p}{$strParams}";
		$page_last_link = $url;
		$nextMax="<a href='$url'>{$nextMax}</a>";
	}
	
	//▼見出し配列を作成
	$fno=$lastPageNo - $md2 + 1;
	if($page_no < $fno){
		$fno=$page_no;
	}
	$lno = $fno + $md2 - 1;
	
	for($i = $fno; $i <= $lno; $i++){
		$pn=$i+1;
		if($i!=$page_no){
			$url = "{$base_url}?{$page_field}={$i}{$strParams}";
			$midasiList[]="<a href='$url'>{$pn}</a>";
		}else{
			$midasiList[]=$pn;
		}
	}
	
	//▼HTML組み立て
	$html = "<div id='page_index'>";
	$html .= "{$rtnMax}&nbsp;\n";
	$html .= "{$rtn1}&nbsp;\n";
	foreach($midasiList as $key=>$val){
		$html .= "{$val}&nbsp;\n";
	}
	$html .= "{$next1}&nbsp;\n";
	$html .= "{$nextMax}&nbsp;\n";
	$html .= "</div>\n";
	
	// クエリ文字列
	$query_str = "{$page_field}=0{$strParams}";
	
	$pagenationData['mokuji'] = $html;
	$pagenationData['page_prev_link'] = $page_prev_link;
	$pagenationData['page_next_link'] = $page_next_link;
	$pagenationData['page_top_link'] = $page_top_link;
	$pagenationData['page_last_link'] = $page_last_link;
	$pagenationData['query_str'] = $query_str;

	return $pagenationData;
}

?>






<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">php ｜ サンプル</a></li>
	<li>ページネーション</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-11-16</div>
</body>
</html>