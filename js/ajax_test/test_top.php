<html>
<head>
<title>$.AJAXテスト</title>
<!-- localhost 用のキー使用 -->
<meta charset="UTF-8" />
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">

	//google.load() WEB上から最新のライブラリを読み込む。Google Ajax Libraries APIの関数。
  google.load('maps', '2.x');
  google.load('jquery', '1');


    
	function test1(){
		

		$.ajax({
			   type: "GET",
			   url: "test1.php",
				 dataType: 'html',
				 cache: false,
			   data: "lat=30&lon=123",
			   success: function(msg){
			     $("#test").html(msg);
			   }
			 });

	}
</script>
</head>
<!-- GUnload()　GMAP用のアンロード関数。メモリリークを解消する働きがある。 -->
<body onunload="GUnload()">
<h1>＄ＡＪＡＸテスト</h1>


<input type="button" value="test1" onclick="test1()" />


<br />
<div id="test"></div>
</body>
</html>