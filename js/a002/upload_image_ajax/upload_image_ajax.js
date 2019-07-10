/**
 * Upload image file by AJAX.
 * サムネイル作成：基本なAjaxによる画像ファイルアップロード
 * @date 2016-9-16
 */
$( function() {
	//ファイルアップロードイベント
	$('#file1').change(function(e) {
		//ファイルオブジェクト配列を取得（配列要素数は選択したファイル数を表す）
		var files = e.target.files;
		var oFile = files[0];

		var reader = new FileReader();
		reader.readAsDataURL(oFile); // データURLスキーム取得処理を非同期で開始する
	
		// データURLスキームを取得後に実行される処理
		reader.onload = function(evt) {
			// img要素にデータURLスキームをセットし、画像表示する。
			$('#img1').attr({
				'src':reader.result,
				'width':80,
				'height':80,
				
			});

		}
		
	  var fd = new FormData();

	  fd.append( "file", $("#file1").prop("files")[0] );
	  //fd.append("dir",$("#hoge").val());
		
	$.ajax({
		type: "POST",
	    dataType : "html",
		url: "upload_image_ajax.php",
        cache: false,
	    data: fd,
        processData: false,
        contentType: false,
		success: function(res, type) {
			console.log(res);//■■■□□□■■■□□□■■■□□□)
			$('#res').html(res);
//			var data;
//			console.log(str_json);//■■■□□□■■■□□□■■■□□□)
//
//			try{
//				data=$.parseJSON(str_json);//パース
//				console.log(data);//■■■□□□■■■□□□■■■□□□)
//			}catch(e){
//				alert('エラー');
//				console.log(str_json);//■■■□□□■■■□□□■■■□□□)
//				throw e;
//			}

		},
		error: function(xmlHttpRequest, textStatus, errorThrown){
			console.log(xmlHttpRequest.responseText);//■■■□□□■■■□□□■■■□□□)
			
			alert(textStatus);
		}
	});
		
//		reader.readAsArrayBuffer(oFile);
//		reader.onload = function(evt) {
//			console.log('test=XXX');//■■■□□□■■■□□□■■■□□□)
//			
//			var option = {
//					type: "application/octet-binary"
//				};
//			var source = new Uint8Array(reader.result); // reader.result is ArrayBuffer
//			//var source = reader.result
//			var blob = new Blob( source , option );
//			
//			
//			
//			var fd = new FormData();
//			//var blob = oFile;
//			fd.append("image", blob);
//			
//			var data={'neko':'ネコ','same':{'hojiro':'ホオジロザメ','shumoku':'シュモクザメ'},'xxx':111};
//
//			var json_str = JSON.stringify(data);//データをJSON文字列にする。
//
//			// AJAX非同期通信
//			$.ajax({
//				type: "POST",
//			    dataType : "text",
//				url: "upload_image_ajax.php",
//			    data: fd,
//	            processData: false,
//	            contentType: false,
//				success: function(res, type) {
//					console.log(res);//■■■□□□■■■□□□■■■□□□)
//					$('#res').html(res);
////					var data;
////					console.log(str_json);//■■■□□□■■■□□□■■■□□□)
//	//
////					try{
////						data=$.parseJSON(str_json);//パース
////						console.log(data);//■■■□□□■■■□□□■■■□□□)
////					}catch(e){
////						alert('エラー');
////						console.log(str_json);//■■■□□□■■■□□□■■■□□□)
////						throw e;
////					}
//
//				},
//				error: function(xmlHttpRequest, textStatus, errorThrown){
//					console.log(xmlHttpRequest.responseText);//■■■□□□■■■□□□■■■□□□)
//					alert(textStatus);
//				}
//			});
//		}
		
		
		

	});
	
	
});