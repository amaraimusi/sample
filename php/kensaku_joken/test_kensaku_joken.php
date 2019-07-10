<?php 
require_once 'zss_lib/common.php';
require_once 'zss_lib/kensaku_joken/kensaku_joken.php';
require_once 'kj_data_musi.php';


//$cbHtmlCrt=new CombboxHtmlCreater();
//$data[0]['value']=0;
//$data[0]['text']='猫';
//$data[1]['value']=1;
//$data[1]['text']='犬';
//$data[2]['value']=2;
//$data[2]['text']='山羊';
//$data[3]['value']=3;
//$data[3]['text']='イグアナ';
//$defVal=1;
//$m_cbHtml=$cbHtmlCrt->createHtml('animal',$defVal,$data);


$kjd=new KjDataMusi();
$data=$kjd->getData();

$kj=new KensakuJoken();

if($_POST['kj_submit']!=null){

	//リクエストから検索条件入力値を取得し、引数の検索条件データにセットする。
	$data=$kj->getRequest($data);
		
	//検索条件の入力データをチェックする。
	$m_err=$kj->inputCheck($data);
	
	//検索条件SQL文を生成する。
	if($m_err==null){
		$m_sql=$kj->createJokenSql($data);
	}
}


$m_kjHtml=$kj->createHtml($data);
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>検索条件・自動生成</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="kensaku_joken.js"></script>
		<script>
//■■■□□□■■■□□□
//			function jkChgCmb(key,cnt){
//
//				var cmb_v=$('#kj_style_cmb_'+key).val();
//
//				for (var i=0;i<cnt;i++){
//					var key2='#jk_'+key+'_a'+i;
//					var d=$(key2).css('display');
//					
//					if(i==cmb_v){
//						if(d=='none'){
//							$(key2).css('display','block');
//		
//						}
//					}else{
//						if(d=='block'){
//							$(key2).css('display','none');
//							
//						}
//					}
//				}
//
//			}

//			//条件検索演算子・テキスト・変更イベント
//			function jkCmbChgCndOpeNum(key){
//				var cmb_v=$('#kj_cmb_cnd_ope_'+key).val();
//				var id_a2='#kj_'+key+ '_a2';//非表示するタグのキー
//				if(cmb_v==3){
//					$(id_a2).css('display','inline');
//				}else{
//					$(id_a2).css('display','none');
//				}
//			}
			
		</script>
		
		<style type="text/css">
			
			
		</style>
		
	</head>
	<body>
		<div id="page1">
		<div id="header">検索条件・自動生成</div>
		<div id="content" >
		
			<div class="sec1">
				<h3>検索条件</h3>
				<form name="form1"  action="test_kensaku_joken.php" method="post" enctype="multipart/form-data" >
					<?php echo($m_kjHtml);?>
					<input type="submit" name="kj_submit" value="検索"  />
				</form>
			</div><!-- sec1 -->
		
			
			<div class="sec1">
				<?php echo($m_sql);?>
				<br />
				<?php echo($m_err);?>
			</div><!-- sec1 -->
			
			
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/03/20</div>
		</div><!-- page1 -->
	</body>
</html>