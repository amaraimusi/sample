
function upload1(){
	var fd = new FormData();
	fd.append( "fu_file1", $("#file1").prop("files")[0] );
	
	var ajax_url = "http://amaraimusi.sakura.ne.jp/sample/js/a009/cors_file_upload/upload.php";

	$.ajax({
		type: "POST",
		url: ajax_url,
		data: fd,
		cache: false,
		dataType: "text",
		processData : false,
		contentType : false,

	})
	.done(function(str_json, type) {
		var data;
		try{
			data = JSON.parse(str_json);
			
		}catch(e){
			console.log(str_json);
			jQuery('#err').html(str_json);
			throw e;
		}
		
		console.log(data);
		$('#res').html('success');
		var fp = "http://amaraimusi.sakura.ne.jp/sample/js/a009/cors_file_upload/" + data.fp + '?v=' +  Date.now();
		console.log('fp=' + fp);
		$('#img1').attr('src', fp)
		
	})
	.fail(function(jqXHR, statusText, errorThrown) {
		var err_res = jqXHR.responseText;
		console.log(err_res);
		jQuery('#err').html(err_res);
		alert(statusText);
		
	});
}	