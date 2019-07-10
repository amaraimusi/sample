

function test1(){
	var addr1 = jQuery('#addr1').val();

	var sendData={addr1:addr1};

	var send_json = JSON.stringify(sendData);//データをJSON文字列にする。

	// AJAX
	jQuery.ajax({
		type: "POST",
		url: "latlng_from_addr.php",
		data: "key1=" + send_json,
		cache: false,
		dataType: "text",
	})
	.done((res_json, type) => {
		var res;
		try{
			res =jQuery.parseJSON(res_json);//パース
		}catch(e){
			jQuery("#err").html(res_json);
			return;
		}
		console.log(res);
	})
	.fail((jqXHR, statusText, errorThrown) => {
		jQuery('#err').html('アクセスエラー');
		jQuery('#err').html(jqXHR.responseText);
		alert(statusText);
	});
}


function test2(){
	var addr1 = jQuery('#addr1').val();

	var sendData={addr1:addr1};

	var send_json = JSON.stringify(sendData);//データをJSON文字列にする。

	// AJAX
	jQuery.ajax({
		type: "POST",
		url: "latlng_from_addr2.php",
		data: "key1=" + send_json,
		cache: false,
		dataType: "text",
	})
	.done((res_json, type) => {
		var res;
		try{
			res =jQuery.parseJSON(res_json);//パース
		}catch(e){
			jQuery("#err").html(res_json);
			return;
		}
		console.log(res);
	})
	.fail((jqXHR, statusText, errorThrown) => {
		jQuery('#err').html('アクセスエラー');
		jQuery('#err').html(jqXHR.responseText);
		alert(statusText);
	});
}


function changeTestDataSelect(){
	
	var attr_text = jQuery('#test_data_select').val();
	jQuery('#addr1').val(attr_text);
	
}

