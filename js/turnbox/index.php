<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ターンボックス | TURNBOX.js</title>

		<link href="../../style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../style2/css/common2.css" rel="stylesheet">

		<script src="../../style2/js/jquery-1.11.1.min.js"></script>
		<script src="../../style2/js/bootstrap.min.js"></script>


		<style>

		</style>
	</head>

<body>
<div class="container">


	<div class="row">
		<div id="header" class="col-lg-12" >
			<h1>ターンボックス | TURNBOX.js</h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">

		<strong>form submitとの相性</strong><br>
		input要素等は仕様していないため、submitとの相性はあまりよくない。<br>
		submitで利用する場合は、イベントにinput要素にセットする処理が必要になる。<br>
		イベントはTURNBOX.jsにて備えられてるものを使うこと。<br>
		AJAXなどJS関数だけで行う処理とは相性がよい。<br>


		<h2>公式サンプル</h2>
		<ul>
		<li><a href="examples/alert_form.html">alert_form</a></li>
		<li><a href="examples/colorpicker.html">colorpicker</a></li>
		<li><a href="examples/confirm.html">confirm</a></li>
		<li><a href="examples/contact_form.html">contact_form</a></li>
		<li><a href="examples/login_form.html">login_form</a></li>
		<li><a href="examples/notify.html">notify</a></li>
		<li><a href="examples/radio_check.html">radio_check</a></li>
		<li><a href="examples/tab.html">tab</a></li>
		<li><a href="examples/toggle.html">toggle</a></li>
		<li><a href="examples/uploader.html">uploader</a></li>
		</ul>

	</div>



	<br><br>
	<a href="http://noht.co.jp/turnbox" class="btn btn-link btn-xs">公式サイト</a>
	<br><br>

	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2015-09-14</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>