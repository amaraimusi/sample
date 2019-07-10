/**
 * Ajaxファイルアップロード | 複数のファイル要素
 * 
 * @date 2016-10-31
 */



function upload1(){
	
	
	var fileElm = $("#file1");
	var len = $("#file1").prop("files").length;
	if(len==0){
		return;
	}
	var fd = new FormData();
	for (var i=0 ; i<len ; i++){
		var key = 'fu_' + i;
		 fd.append( key, fileElm.prop("files")[i] );

	}


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