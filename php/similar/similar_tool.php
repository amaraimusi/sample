
		<?php 
		
			$pasting_csv = "お問い合わせ番号&#13;問い合わせ番号&#13;問い合せ番号&#13;問合せ番号&#13;問合番号&#13;問合せNO";
			
			if(!empty( $_POST['pasting_csv'])){
				$res=execution();
				
				$errMsg =null;
				if(!empty($res['errMsg'])){
					$errMsg = "<div style='color:red'>{$res['errMsg']}</div>";
				}
				
				$data=array();
				if(!empty($res['data'])){
					$data = $res['data'];
				}
				
				$pasting_csv=$res['pasting_csv'];
			}
			
			function execution(){
				
				
				
				//テキストエリアからデータ文字列を取得する
				$pasting_csv = $_POST['pasting_csv'];
				

				$res=array('errMsg'=> null,'data'=>array(),'pasting_csv'=>$pasting_csv);
				
				//データ文字列を改行で区切って、リストとして取得する。
				$list=explode("\r\n",$pasting_csv);
				
				//リストから空白行を除去
				$list = array_filter($list);
				
				//リスト件数を取得
				$cnt=count($list);
				
				if($cnt > 20){
					$errMsg="データは20行まです。";
					$res['errMsg'] = $errMsg;
 					return $res;
				}
				
				//総当たりで一致率を求め、データにセットします。
				$data=array();
				for($a=0; $a < $cnt; $a++){
					for($b=$a+1 ;$b < $cnt; $b++){
						
						$str1=$list[$a];
						$str2=$list[$b];
						$percent=0;//一致率
						
						//一致率を算出
						similar_text($str1,$str2,$percent);
						
						//一致率の桁が長すぎるので丸める。
						$percent=round($percent,2);
						
						$ent['str1']=$str1;
						$ent['str2']=$str2;
						$ent['percent']=$percent;
						
						$data[]=$ent;
						
					}
				}
				
				//一致率でデータを並べ替える
				foreach($data as $key => $row){
					$pers[$key] = $row["percent"];
				}
				array_multisort($pers,SORT_DESC,$data);
				
				$res['data'] = $data;

					
				return $res;

			}
			
			//HTMLテーブルの始まり部分を出力
			function table_start(){
				echo
					"<table id='tbl1' class='table'>".
					" 	<thead>".
					" 		<tr><th>文字列1</th><th>文字列2</th><th>一致率</th></tr>".
					" 	</thead>".
					" 	<tbody>";
				
			}
			
			//HTMLテーブルの終わり部分を出力
			function table_end(){
				echo
				" 	</tbody>".
						" </table>";
			}

		?>
<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>文字の一致率測定ツール | similar_text</title>

		<link href="../../style2/css/jquery-ui.min.css" rel="stylesheet">
		<link href="../../style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../style2/css/common2.css" rel="stylesheet">

		<script src="../../style2/js/jquery-1.11.1.min.js"></script>
		<script src="../../style2/js/jquery-ui.min.js"></script>
		<script src="../../style2/js/bootstrap.min.js"></script>
		<script src="../../style2/js/jquery-ui.min.js"></script>
		<script src="jquery.tablesorter.js"></script>


		<script>
			$( function() {
				
				$(document).ready(function(){
					$('#tbl1').tablesorter();//テーブルにソート機能を付ける。
				});
			});
		</script>
		<style>

		</style>
	</head>

<body>
<div class="container">


	<div class="row">
		<div id="header" class="col-lg-12" >
			<h1>文字の一致率測定ツール | similar_text</h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">
		<h2>ツール</h2>
		類似文字リストを総当たりで比較し、それぞれの一致率を算出します。<br>
		一致率の算出にはPHP関数「similar_text」を利用しています。<br>
		<br>
		<form action="#" method="post">
			類似文字リスト
			<textarea id="pasting_csv" name="pasting_csv" class="form-control" rows="6" maxlength="1000" placeholder="類似文字列を貼り付けてください" ><?php echo $pasting_csv?></textarea>
			<br>
			<input type="submit" value="算出" class="btn btn-success">
		</form>
		<hr>
		
		<h3>出力</h3>
		<div>
		<?php 
		if(!empty($data)){
			//HTMLテーブルの始まり部分を出力
			table_start();
			
			foreach($data as $ent){
				$str1=htmlspecialchars($ent['str1']);
				$str2=htmlspecialchars($ent['str2']);
				echo "<tr><td>{$str1}</td><td>{$str2}</td><td>{$ent['percent']}</td></tr>";
			}
			
			//HTMLテーブルの終わり部分を出力
			table_end();
		}
		
		if(!empty($errMsg)){
			echo $errMsg;
		}

		?>
		</div>

	</div>



	<br><br>
	<a href="http://amaraimusi.sakura.ne.jp/" class="btn btn-link btn-xs">ホーム</a>
	<br><br>

	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2016-1-29</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>