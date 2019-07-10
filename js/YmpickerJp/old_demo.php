<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>jquery.ui.ympicker.jsを使って月初日と月末日を取得</title>

		<link href="../../style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../style2/css/common2.css" rel="stylesheet">
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css" type="text/css">


		<script src="../../style2/js/jquery-1.11.1.min.js"></script>

		<script src="../../style2/js/bootstrap.min.js"></script>


		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>

		<script src="jquery.ui.ympicker.js"></script>
		<script src="date_ex.js"></script>

		<!-- ★★★ -->
		<script src="ympicker_rap.js"></script>

		<style>

		</style>
		<script>

		$(function(){


			ympicker_tukishomatu('test','m_start_date','m_end_date');



		});



		</script>
	</head>

<body>
<div class="container">

	<div class="row">
		<div id="header" class="col-lg-12" >
			<h1>jquery.ui.ympicker.jsを使って月初日と月末日を取得</h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">
		<h2>サンプル</h2>
		<input type="text" id="test" />：年月ダイアログ<br>
		<input type="text" id="m_start_date" />：月初日<br>
		<input type="text" id="m_end_date" />：月末日<br>
	</div>

	<br><hr><br>


	インクルード部分<br>
	<pre>
	&ltlink rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css" type="text/css"&gt
	&ltscript src="jquery-1.11.1.min.js"&gt&lt/script&gt
	&ltscript src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"&gt&lt/script&gt
	&ltscript src="jquery.ui.ympicker.js"&gt&lt/script&gt
	&ltscript src="ympicker_rap.js"&gt&lt/script&gt
	</pre><br>

	HTMLソースコード<br>
	<pre>
	&ltinput type="text" id="test" /&gt：年月ダイアログ&ltbr&gt
	&ltinput type="text" id="m_start_date" /&gt：月初日&ltbr&gt
	&ltinput type="text" id="m_end_date" /&gt：月末日&ltbr&gt
	</pre><br>



	JSソースコード<br>
	<pre>
	$(function(){
		ympicker_tukishomatu('test','m_start_date','m_end_date');
	});
	</pre><br>


	ympicker_rap.jsソースコード<br>
	<pre>
	/**
	 * jquery.ui.ympicker.jsのrapモジュール
	 *
	 */

	/**
	 * ympicker・月初末
	 * 年月選択により月初日、月末日らのテキストボックスを連動させる。
	 *
	 * @param tb_ym_id 年月テキストボックスのID
	 * @param tb_m_start_id 月初日テキストボックスのID
	 * @param tb_m_ent_id 月末日テキストボックスのID
	 *
	 */
	function ympicker_tukishomatu(tb_ym_id,tb_m_start_id,tb_m_ent_id){



		//年月入力
		var op = {
			closeText: '閉じる',
			prevText: '&amp#x3c;前',
			nextText: '次&amp#x3e;',
			currentText: '今日',
			monthNames: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
			monthNamesShort: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
			dateFormat: 'yy/mm',
			yearSuffix: '年',
			onSelect:function(ym, instance) {


		    	  //月初日と月末日を算出し、入力フォームに表示
		    	  ympickerShowStartLast(ym,tb_m_start_id,tb_m_ent_id);


			}
		};

		//年月ダイアログを適用
		$('#' + tb_ym_id).ympicker(op);


		//年月をクリアしたら月初、月末もクリアする。
		$('#' + tb_ym_id).change(function () {
		      var v = $('#' + tb_ym_id).val();
		      if(v =='' || v==null){
		    	  $('#' + tb_m_start_id).val('');
		    	  $('#' + tb_m_ent_id).val('');
		      }else{

		    	  //年月チェック
		    	  if(ympickerIsYM(v)==true){

			    	  //月初日と月末日を算出し、入力フォームに表示
			    	  ympickerShowStartLast(v,tb_m_start_id,tb_m_ent_id);
		    	  }else{
			    	  $('#' + tb_m_start_id).val('');
			    	  $('#' + tb_m_ent_id).val('');
		    	  }


		      }
		}).change();

	}

	//月初日と月末日を算出し、入力フォームに表示
	function ympickerShowStartLast(ym,tb_m_start_id,tb_m_ent_id){
		var d1=ym + '/1';
		$('#' + tb_m_start_id).val(d1);

		//月末日の算出と出力
		var dt=new Date(d1);
		var last_d=new Date(dt.getFullYear(), dt.getMonth() + 1, 0);
		var last_d=DateFormat(last_d, 'yyyy/mm/dd'); // 01月23日
		$('#' + tb_m_ent_id).val(last_d);
	}


	/**
	 * 年月チェック
	 * yyyy/mm形式とyyyy-mm形式に対応
	 * ※注意 onchangeイベントと全角入力では正しく検知できない。
	 * @param value 年月
	 * @returns true:入力OK    false:入力エラー
	 */
	function ympickerIsYM(value){

		var ary=value.split("/");
		if(ary.length != 2){
			ary=value.split("-");
			if(ary.length != 2){
				return false;;
			}
		}

		var y=parseInt(ary[0]);
		var m=parseInt(ary[1]);

		var dt=new Date(y,m-1,1);
		if(dt.getFullYear()!=y || dt.getMonth()!=m-1 ){
			return false;
		}
		return true;
	}
	</pre>



	<br><br>
	<a href="https://www.softel.co.jp/blogs/tech/archives/demo/jquery-ui-ympicker" class="btn btn-link btn-xs">jquery.ui.ympicker.jsの開発元</a>
	<br><br>

	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2015-05-18</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>