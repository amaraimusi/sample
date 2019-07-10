/**
 * Img upload  after  the thumbnail display
 * サムネイルを表示してから画像アップロード
 * @date 2016-9-20
 */


$( function() {
	
	//ファイルアップロードイベント
	$('#file1').change(function(e) {
		
		var files = e.target.files;
		var oFile = files[0];

		var reader = new FileReader();
		reader.readAsDataURL(oFile);
	
		//ファイル読込成功イベント
		reader.onload = function(evt) {
			
		    var fd = new FormData();
		    fd.append( "upload_file", $("#file1").prop("files")[0] );
			
			$.ajax({
				type: "POST",
				url: "upload.php",
				data: fd,
				cache: false,
				dataType: "text",
				processData : false,
				contentType : false,
				success: function(res, type) {
					
					$('#res').html(res);
		
				},
				error: function(xmlHttpRequest, textStatus, errorThrown){
					console.log(xmlHttpRequest.responseText);
					
					alert(textStatus);
				}

			});
			
			
			
			
			
			
			
			
			
			
			
		}
		
		

		
		
		

	});
	
	
});