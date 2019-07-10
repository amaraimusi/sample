<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>年月ダイアログ | jquery.ui.ympicker.js</title>

		<link href="../../style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../style2/css/common2.css" rel="stylesheet">
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css" type="text/css">


		<script src="../../style2/js/jquery-1.11.1.min.js"></script>

		<script src="../../style2/js/bootstrap.min.js"></script>


		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>

		<script src="jquery.ui.ympicker.js"></script>

		<style>

		</style>
		<script>

		$(function(){


			$('.datepicker').datepicker({



			});
			//年月入力
			var op = {
				closeText: '閉じる',
				prevText: '&#x3c;前',
				nextText: '次&#x3e;',
				currentText: '今日',
				monthNames: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
				monthNamesShort: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
				dateFormat: 'yy/mm',
				yearSuffix: '年',

			};

			$('#test').ympicker(op);






		});
		</script>
	</head>

<body>
<div class="container">

	<div class="row">
		<div id="header" class="col-lg-12" >
			<h1>年月ダイアログ | jquery.ui.ympicker.js</h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">
		<h2>サンプル</h2>
		<input type="text" id="test" /><br>
	</div>



	<br><br>
	<a href="https://www.softel.co.jp/blogs/tech/archives/demo/jquery-ui-ympicker" class="btn btn-link btn-xs">開発元</a>
	<br><br>

	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2015-05-18</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>