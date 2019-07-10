<html>
<head>
<title>get_page.jsのサンプル</title>
<meta charset="UTF-8" />
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript" src="get_page.js"></script>
<script type="text/javascript">

	//google.load() WEB上から最新のライブラリを読み込む。Google Ajax Libraries APIの関数。
    google.load('jquery', '1');



    //「Google Ajax Libraries API」のロードイベント。JQueryなどのスクリプトの読み込みも待つ
    google.setOnLoadCallback(load);



    function test(){

      var strUrl='http://www.e-tsuri.info/tide?p=%E4%B8%89%E5%8E%A9(%E3%83%9F%E3%83%B3%E3%83%9E%E3%83%A4)&d=2012/06/12';

    	loadAnotherDomain(strUrl,function(data){
        	alert(data);
    	}
    	);
    	

			
        
    }
   
</script>
<style type="text/css">

	

</style>
</head>
<body>

<h1>get_page.jsのサンプル</h1>


<input type="button" value="Test" onclick="test()" />


</body>
</html>