<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>年選セレクトと年始日、年末日を連動</title>

		<link href="../../style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../style2/css/common2.css" rel="stylesheet">

		<script src="../../style2/js/jquery-1.11.1.min.js"></script>
		<script src="../../style2/js/bootstrap.min.js"></script>


		<script>
			function change_year_list(myself){

				var y=$("#year_list").val();

				if(y =='' || y==null){

					$("#year_first_date").val('');
					$("#year_last_date").val('');
					return;
				}


				var year_first_date= y + '-1-1';
				var year_last_date= y + '-12-31';

				$("#year_first_date").val(year_first_date);
				$("#year_last_date").val(year_last_date);

			}
		</script>
	</head>

<body>
<div class="container">

	<div class="row">
		<div id="header" class="col-lg-12" >
			<h1>年選セレクトと年始日、年末日を連動</h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">
		<h2>サンプル</h2>

		<select id="year_list" onchange="change_year_list(this)" placeholder="XX">
			<option value="" default></option>
			<option value="2013">2013</option>
			<option value="2014">2014</option>
			<option value="2015">2015</option>
			<option value="2016">2016</option>
			<option value="2017">2017</option>
		</select>

		<input id="year_first_date" type="text" placeholder="年始日" value="" />
		<input id="year_last_date" type="text" placeholder="年末日" value="" />

	</div>



	<br><br>
	<a href="http://amaraimusi.sakura.ne.jp/" class="btn btn-link btn-xs">参考サイト</a>
	<br><br>

	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2015-03-20</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>