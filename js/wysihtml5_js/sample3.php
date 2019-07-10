<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>wysihtml5_jsによるリッチテキスト</title>

		<link href="../../style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../style2/css/common2.css" rel="stylesheet">
		<link href="wysihtml5-config.css" rel="stylesheet">

		<script src="../../style2/js/jquery-1.11.1.min.js"></script>
		<script src="../../style2/js/bootstrap.min.js"></script>
		<script src="wysihtml5-config.js"></script>
		<script src="wysihtml5-0.3.0-ja.js"></script>


		<style>


			#wh5_pulldown_list_color{
				display:none;
				position:relative;
				left:268px;
			}

			#wh5_pulldown_list_fsize{
				display:none;
				position:relative;
				left:210px;
			}

			#wh5_pulldown_list_other{
				display:none;
				position:relative;
				left:335px;
			}

			.pulldown_menu{

				position:absolute;
				width:100px;
				padding-left:4px;
				padding-bottom:10px;
				background-color:#484848;

			}

			.pulldown_menu ul{
				list-style-type:none;
				margin-left:-30px;
			}

			.pulldown_menu a{
				color:white;
			}

			.wh5-color{
				font-size:16px;
			}

		</style>

		<script type="text/javascript">

			var editor;

			$( function() {
				editor = new wysihtml5.Editor("textarea", {
					toolbar:      "toolbar",
					stylesheets:  "wysihtml5-config.css",
					locale: "ja-JP",
					parserRules:  wysihtml5ParserRules
				});






				//wysihtml5のプルダウンメニューを初期化
				init_wh5_pulldown_menu();



// 				editor.on
// 				(
// 				   "blur",
// 				   function()
// 				   {
// 					   var text=editor.getValue();
// 					   alert(text);//■■■□□□■■■□□□■■■□□□
// 				   }
// 				);

			});


			//wysihtml5のプルダウンメニュー
			function init_wh5_pulldown_menu(){



				//文字食項目
				$("#wh5_pulldown_menu_color").hover(function() {

					$("#wh5_pulldown_list_color").show();


				}, function() {

					$("#wh5_pulldown_list_color").hide();

					$("#wh5_pulldown_list_color").hover(function() {
						$("#wh5_pulldown_list_color").show();
					}, function() {
						$("#wh5_pulldown_list_color").hide();
					});

				});


				//フォントサイズ項目
				$("#wh5_pulldown_menu_fsize").hover(function() {

					$("#wh5_pulldown_list_fsize").show();


				}, function() {

					$("#wh5_pulldown_list_fsize").hide();

					$("#wh5_pulldown_list_fsize").hover(function() {
						$("#wh5_pulldown_list_fsize").show();
					}, function() {
						$("#wh5_pulldown_list_fsize").hide();
					});

				});

				//その他項目
				$("#wh5_pulldown_menu_other").hover(function() {

					$("#wh5_pulldown_list_other").show();


				}, function() {

					$("#wh5_pulldown_list_other").hide();

					$("#wh5_pulldown_list_other").hover(function() {
						$("#wh5_pulldown_list_other").show();
					}, function() {
						$("#wh5_pulldown_list_other").hide();
					});

				});

			}


// 			editor.on
// 			(
// 			   "blur",
// 			   function()
// 			   {
// 				   var text=editor.getValue();
// 				   alert(text);//■■■□□□■■■□□□■■■□□□
// 			   }
// 			);
			function test(){

// 				editor.on
// 				(
// 				   "blur",
// 				   function()
// 				   {
// 					   var text=editor.getValue();
// 					   alert(text);//■■■□□□■■■□□□■■■□□□
// 				   }
// 				);


				var text=editor.getValue();

				text=editor.parse(text);

				//alert(text);//■■■□□□■■■□□□■■■□□□
				$("#test").html(text);

			}

		</script>
	</head>

<body>
<div class="container">


	<div class="row">
		<div id="header" class="col-lg-12" >
			<h1>wysihtml5_jsによるリッチテキスト</h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">



		<div id="toolbar" style="display:none;width:500px">
			<div class="btn-group">
				<a data-wysihtml5-command="bold" title="太字" class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-bold"></span></a>
				<a data-wysihtml5-command="italic" title="イタリック" class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-italic"></span></a>
				<a data-wysihtml5-command="createLink" class="btn btn-primary btn-sm" title="リンク"><span class="glyphicon glyphicon-link"></span></a>
				<a data-wysihtml5-command="insertImage" class="btn btn-primary btn-sm" title="画像"><span class="glyphicon glyphicon-picture"></span>
				<a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1" class="btn btn-primary btn-sm" title="見出し1">h1</a>
				<a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2" class="btn btn-primary btn-sm" title="見出し2">h2</a>
				<a data-wysihtml5-command="insertUnorderedList" class="btn btn-primary btn-sm" title="リスト"><span class="glyphicon glyphicon-align-justify"></span></a>
				<a data-wysihtml5-command="insertOrderedList" class="btn btn-primary btn-sm" title="番号付リスト"><span class="glyphicon glyphicon-list"></span></a>
				<a id="wh5_pulldown_menu_color" class="btn btn-primary btn-sm" title="文字色"><span class="glyphicon glyphicon-tint"></span></a>
				<a id="wh5_pulldown_menu_fsize" class="btn btn-primary btn-sm" title="文字のサイズ"><span class="glyphicon glyphicon-text-width"></span></a>
				<a id="wh5_pulldown_menu_other" class="btn btn-primary btn-sm" title="その他の文字調整"><span class="glyphicon glyphicon-adjust"></span></a>
				<a data-wysihtml5-action="change_view" class="btn btn-primary btn-sm" title="HTMLソースを確認"><span class="glyphicon glyphicon-retweet"></span></a>
			</div><!--btn-group -->

			<div id="wh5_pulldown_list_color">
				<div class="pulldown_menu">

					<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="black " ><span class="wysiwyg-color-black  wh5-color">■</span></a>
					<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="silver " ><span class="wysiwyg-color-silver  wh5-color">■</span></a>
					<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="gray " ><span class="wysiwyg-color-gray  wh5-color">■</span></a>
					<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="white " ><span class="wysiwyg-color-white  wh5-color">■</span></a>
					<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="maroon " ><span class="wysiwyg-color-maroon  wh5-color">■</span></a>
					<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="red " ><span class="wysiwyg-color-red  wh5-color">■</span></a>
					<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="purple " ><span class="wysiwyg-color-purple  wh5-color">■</span></a>
					<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="fuchsia " ><span class="wysiwyg-color-fuchsia  wh5-color">■</span></a>
					<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="green " ><span class="wysiwyg-color-green  wh5-color">■</span></a>
					<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="lime " ><span class="wysiwyg-color-lime  wh5-color">■</span></a>
					<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="olive " ><span class="wysiwyg-color-olive  wh5-color">■</span></a>
					<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="yellow " ><span class="wysiwyg-color-yellow  wh5-color">■</span></a>
					<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="navy " ><span class="wysiwyg-color-navy  wh5-color">■</span></a>
					<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="blue " ><span class="wysiwyg-color-blue  wh5-color">■</span></a>
					<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="teal " ><span class="wysiwyg-color-teal  wh5-color">■</span></a>
					<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="aqua " ><span class="wysiwyg-color-aqua  wh5-color">■</span></a>


				</div>

			</div>

			<div id="wh5_pulldown_list_fsize">
				<div class="btn-group" style="position:absolute;">
					<a data-wysihtml5-command="fontSize" data-wysihtml5-command-value="xx-large " class="btn btn-success btn-xs">大3</a>
					<a data-wysihtml5-command="fontSize" data-wysihtml5-command-value="x-large " class="btn btn-success btn-xs">大2</a>
					<a data-wysihtml5-command="fontSize" data-wysihtml5-command-value="large " class="btn btn-success btn-xs">大1</a>
					<a data-wysihtml5-command="fontSize" data-wysihtml5-command-value="medium " class="btn btn-success btn-xs">標準</a>
					<a data-wysihtml5-command="fontSize" data-wysihtml5-command-value="small " class="btn btn-success btn-xs">小1</a>
					<a data-wysihtml5-command="fontSize" data-wysihtml5-command-value="x-small " class="btn btn-success btn-xs">小2</a>
					<a data-wysihtml5-command="fontSize" data-wysihtml5-command-value="xx-small " class="btn btn-success btn-xs">小3</a>

				</div>
			</div>

			<div id="wh5_pulldown_list_other">
				<div class="pulldown_menu">
					<ul >
						<li><a data-wysihtml5-command="fontSize" data-wysihtml5-command-value="hosoku">補足</a></li>
					</ul>
				</div>

			</div>





			<a data-wysihtml5-command="insertSpeech" style="display:none">speech</a><!-- マイク音声入力用？ -->







		    <div data-wysihtml5-dialog="createLink" style="display: none;">
		      <label>
		        Link:
		        <input data-wysihtml5-dialog-field="href" value="http://">
		      </label>
		      <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
		    </div>

		    <div data-wysihtml5-dialog="insertImage" style="display: none;">
		      <label>
		        Image:
		        <input data-wysihtml5-dialog-field="src" value="http://">
		      </label>
		      <label>
		        Align:
		        <select data-wysihtml5-dialog-field="className">
		          <option value="">default</option>
		          <option value="wysiwyg-float-left">left</option>
		          <option value="wysiwyg-float-right">right</option>
		        </select>
		      </label>
		      <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
		    </div>

</div><!--toolbar -->

		  <textarea id="textarea" placeholder="文章を書いてください" style="width:500px;height:300px">


		  </textarea>
		  <br><input type="reset" value="クリア">

		  <input type="button" value="テスト" onclick="test()" /><br>
		  <div id="test"></div>




	</div>





	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2015-07-24</p>
		</div>
	</div>
</div><!-- container  -->

</body>
</html>