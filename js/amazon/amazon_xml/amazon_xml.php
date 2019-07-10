<?php 
	require_once '../../../zss_lib/common.php';
	require_once '../../../zss_lib/amazon_paa/amazon_api_util.php';
	require_once '../../../zss_lib/amazon_paa/html_create_table_amazon_item_search.php';
	
	//ＡＳＩＮ検索
	if($_POST['btn_asin']!=null){
		$v=$_POST['asin'];
		$util=new AmazonApiUtil();
		$params = $util->aks_make_asin_query($v);
		$response = $util->aks_send_query($params);
		$m_ret=htmlspecialchars($response);
		$m_html=createTableHtml($response);//XML文字列からテーブルＨＴＭＬを作成
	}
	
	//▽キーワード検索
	if($_POST['btn_kw']!=null){
		$v=$_POST['kw'];
		$v2=$_POST['kw_product_type'];
		$util=new AmazonApiUtil();
		$params = $util->aks_make_keyword_query($v, $v2);
		$response = $util->aks_send_query($params);
		$m_ret=htmlspecialchars($response);
		
		$m_html=createTableHtml($response);//XML文字列からテーブルＨＴＭＬを作成
		
		
	}
	
	//▽カテゴリ検索
	if($_POST['btn_node']!=null){
		$v=$_POST['node'];
		$v2=$_POST['node_product_type'];
		$util=new AmazonApiUtil();
		$params = $util->aks_make_node_query($v, $v2);
		$response = $util->aks_send_query($params);
		$m_ret=htmlspecialchars($response);
		$m_html=createTableHtml($response);//XML文字列からテーブルＨＴＭＬを作成
	}
	
	//XML文字列からテーブルＨＴＭＬを作成
	function createTableHtml($response){
		$hct=new HtmlCreateTableAmazonItemSearch();
		$html=$hct->createTblHtml($response);
		return $html;
	}
//	$parsed_xml = aks_get_parsed_xml( $response );
//	echo aks_print_items( $response, $parsed_xml );
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>Amazon | XML表示</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script>

		</script>
		
		<style type="text/css">
			.sec2{
				border-style:solid;
				border-width:2px;
				border-color:#b892f1;
				padding:4px;
				margin-bottom:30px;
			}
		</style>
		
	</head>
	<body>
		<div id="page1">
		<div id="header">Amazon | XML表示</div>
		<div id="content" >
			<form name="form1"  action="amazon_xml.php" method="post" enctype="multipart/form-data" >
				<div class="sec1">

					<div class="sec2">
						ASINコード：<input type="text" name="asin" value="4756136494" /><br />
						<input type="submit" name="btn_asin" value="検索" />
					</div>

					<div class="sec2">
						キーワード：<input type="text" name="kw" value="c++" />
						商品タイプ：<input type="text" name="kw_product_type" value="Books" /><br />
						<input type="submit" name="btn_kw" value="検索" />
					</div>

					<div class="sec2">
						カテゴリ：<input type="text" name="node" value="466300" />
						商品タイプ：<input type="text" name="node_product_type" value="Books" /><br />
						<input type="submit" name="btn_node" value="検索" />
					</div>
					
					<hr /><h3>検索結果</h3>
					<?php echo($m_html);?>
					
					<hr /><h3>レスポンスＸＭＬ</h3>
					<?php echo($m_ret);?>
				</div><!-- sec1 -->
			</form>
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/03/20</div>
		</div><!-- page1 -->
	</body>
</html>