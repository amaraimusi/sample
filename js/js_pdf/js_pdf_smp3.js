/**
 * jsPDF サンプル1
 */


	function test1(){
//		console.log('test1');//■■■□□□■■■□□□)
//		// コンテンツ化を画像化します。
//		html2canvas(document.getElementById("test1"), {
//	        onrendered: function (canvas) {
//	        	// コンテンツの画像化が完了したら以下の処理を行います。
//	        	
//	        	// コンテンツの画像データを取得します。
//	            var dataURI = canvas.toDataURL("image/png");
//	            console.log('test');//■■■□□□■■■□□□)
//	            // ｊｓPDFを生成し、画像データを渡します。
//	            var pdf = new jsPDF();
//	            pdf.addImage(dataURI, 'png', 0, 0);
//	            
//	            // とりこんだ画像データからレンダリングデータを作成し、PDFプレビュー画面を表示します。
//	            var renderString = pdf.output("datauristring");
//	            $("iframe").attr("src", renderString);
//	        }
//	    });   
		
		html2canvas(document.querySelector("#test1")).then(canvas => {
		    //document.body.appendChild(canvas);
		    console.log('A2');//■■■□□□■■■□□□)
            var dataURI = canvas.toDataURL("image/jpeg");
		    console.log('A3.1');//■■■□□□■■■□□□)
            
            //pdf.addImage(dataURI, 'png', 0, 0);

		    console.log('A3.2');//■■■□□□■■■□□□)
            // ｊｓPDFを生成し、画像データを渡します。
            var pdf = new jsPDF();
		    console.log('A3.5');//■■■□□□■■■□□□)
            pdf.addImage(dataURI, 'png', 0, 0);

		    console.log('A4');//■■■□□□■■■□□□)
            // とりこんだ画像データからレンダリングデータを作成し、PDFプレビュー画面を表示します。
            var renderString = pdf.output("datauristring");
		    console.log('A4.1');//■■■□□□■■■□□□)
            $("iframe").attr("src", renderString);
		    console.log('A4.2');//■■■□□□■■■□□□)
            

		    console.log('A5');//■■■□□□■■■□□□)
		});
	}