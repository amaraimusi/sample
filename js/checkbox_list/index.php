<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>チェックボックスを配列として扱う</title>

		<link href="../../style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../style2/css/common2.css" rel="stylesheet">

		<script src="../../style2/js/jquery-1.11.1.min.js"></script>
		<script src="../../style2/js/bootstrap.min.js"></script>


		<script>
function test_func(){

	var ary=[];
	var obj={};
 	$(".animal").each(function (index, elm) {

 		//チェックボックスリストのチェック状態を配列で取得する。
 		var flg=$(elm).prop('checked');
 		ary.push(flg);

 		var v=$(elm).val();
 		obj[v]=flg;



	 });

	console.log('チェック状態配列');
	console.log(ary);

	console.log('チェック状態連想配列');
	console.log(obj);


}
		</script>
	</head>

<body>
<div class="container">

	<div class="row">
		<div id="header" class="col-lg-12" >
			<h1>チェックボックスを配列として扱う</h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">
		<h2>サンプル</h2>

		<label><input class="animal" type="checkbox" value="2" />2:トラ</label><br>
		<label><input class="animal" type="checkbox" value="3" />3:鵜</label><br>
		<label><input class="animal" type="checkbox" value="4" />4:サル</label><br>
		<label><input class="animal" type="checkbox" value="5" />5:トリ</label><br>

		<input type="button" value="配列で取得" onclick="test_func()" />※結果はコンソールへ出力します。F12キーで確認してください。

	</div>


	<div class="sec3">
		<h2>ソースコード</h2>
		<strong>HTML</strong><br>
		<pre>
		&ltlabel&gt&ltinput class="animal" type="checkbox" value="2" /&gt2:トラ&lt/label&gt&ltbr&gt
		&ltlabel&gt&ltinput class="animal" type="checkbox" value="3" /&gt3:鵜&lt/label&gt&ltbr&gt
		&ltlabel&gt&ltinput class="animal" type="checkbox" value="4" /&gt4:サル&lt/label&gt&ltbr&gt
		&ltlabel&gt&ltinput class="animal" type="checkbox" value="5" /&gt5:トリ&lt/label&gt&ltbr&gt
		</pre><br><br><br>

		<strong>JavaScript</strong><br>
		<pre>
		var ary=[];
		var obj={};
	 	$(".animal").each(function (index, elm) {

	 		//チェックボックスリストのチェック状態を配列で取得する。
	 		var flg=$(elm).prop('checked');
	 		ary.push(flg);

	 		var v=$(elm).val();
	 		obj[v]=flg;



		 });

		console.log('チェック状態配列');
		console.log(ary);

		console.log('チェック状態連想配列');
		console.log(obj);

		</pre><br><br><br>

	</div>

	<br><br>
	<a href="http://amaraimusi.sakura.ne.jp/sample/js/jq_checkbox/jq_checkbox.html" class="btn btn-link btn-xs">参考：JQuery | チェックボックスの値を取得</a><br>
	<a href="http://amaraimusi.sakura.ne.jp/sample/js/checkbox_all_select/checkbox_all_select.html" class="btn btn-link btn-xs">参考：一覧のチェックボックスをすべて選択</a><br>
	<br><br>

	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2015-05-28</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>