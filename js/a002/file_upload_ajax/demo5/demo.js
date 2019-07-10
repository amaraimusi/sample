/**
 * Ajaxファイルアップロード 
 * 
 * @date 2016-10-31
 */



function upload1(){
	
	var animal_name = $('#animal_name').val();
	
	var fd = new FormData();
    fd.append( "fu_file1", $("#file1").prop("files")[0] );
    fd.append( "animal_name", animal_name );
    
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