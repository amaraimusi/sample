/**
 * jsPDF サンプル1
 */


	function test1(){
		// コンテンツ化を画像化します。
		html2canvas(document.getElementById("test1"), {
	        onrendered: function (canvas) {
	        	// コンテンツの画像化が完了したら以下の処理を行います。
	        	
	        	// コンテンツの画像データを取得します。
	            var dataURI = canvas.toDataURL("image/jpeg");
	            
	            // ｊｓPDFを生成し、画像データを渡します。
	            var pdf = new jsPDF();
	            pdf.addImage(dataURI, 'JPEG', 0, 0);
	            
	            // とりこんだ画像データからレンダリングデータを作成し、PDFプレビュー画面を表示します。
	            var renderString = pdf.output("datauristring");
	            $("iframe").attr("src", renderString);
	        }
	    });   
	}