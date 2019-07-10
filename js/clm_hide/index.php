<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>列の表示、非表示を切り替える</title>

		<link href="../../style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../style2/css/common2.css" rel="stylesheet">

		<script src="../../style2/js/jquery-1.11.1.min.js"></script>
		<script src="../../style2/js/bootstrap.min.js"></script>

		<script>
		function test(){

			var clm_index=$("#clm3").index();

			$("#clm3").toggle();

			$.each($("#tbl1 tbody tr"), function() {

				var td=$(this).children();
				td.eq(clm_index).toggle();

			});

		}
		</script>

		<style>

		</style>
	</head>

<body>
<div class="container">

	<div class="row">
		<div id="header" class="col-lg-12" >
			<h1>列の表示、非表示を切り替える</h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">
		<h2>説明</h2>
		列を非表示にする。<br>


		<table id="tbl1" class="table">
			<thead><tr><th>ID</th><th id="clm2">名称</th><th id="clm3">数値A</th><th>数値B</th></tr></thead>
			<tbody>
				<tr><td>1</td><td>nezumi</td><td>10</td><td>100</td></tr>
				<tr><td>2</td><td>usi</td><td>20</td><td>200</td></tr>
				<tr><td>3</td><td>tora</td><td>30</td><td>300</td></tr>
				<tr><td>4</td><td>鵜</td><td>40</td><td>400</td></tr>
			</tbody>
		</table>
		<input type="button" class="btn btn-success" value="列(数値A）の表示切替" onclick="test()" />
	</div>




	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2015-03-20</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>