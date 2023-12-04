$(()=>{
	
	let params_json = localStorage.getItem("rich_menu_curl_20231202"); 
	if(params_json){
		let params = JSON.parse(params_json);
		$('#access_token').val(params.access_token);
		$('#line_rich_menu_id').val(params.line_rich_menu_id);
	}
});



function exec(){

	
	let params = {
		access_token:$('#access_token').val(),
		line_rich_menu_id:$('#line_rich_menu_id').val(),
		mode:'template_to_line',
	};

	// データ中の「&」と「%」を全角の＆と％に一括エスケープ(&記号や%記号はPHPのJSONデコードでエラーになる)
	params = _escapeAjaxSendData(params);
	
	let fd = new FormData();
	
	let params_json = JSON.stringify(params);//データをJSON文字列にする。
	localStorage.setItem("rich_menu_curl_20231202", params_json); 
	fd.append( "key1", params_json );
	

	let ajax_url = "backend.php";
	
	// AJAX
	jQuery.ajax({
		type: "post",
		url: ajax_url,
		data: fd,
		cache: false,
		dataType: "text",
		processData: false,
		contentType : false,
	})
	.done((res_json, type) => {
		let params;
		try{
			params =jQuery.parseJSON(res_json);//パース
		}catch(e){
			jQuery("#err").append(res_json);
			return;
		}
		console.log(params);
		$('#line_rich_menu_id').val(params.line_rich_menu_id) ;
		
		let params_json = JSON.stringify(params);//データをJSON文字列にする。
		localStorage.setItem("rich_menu_curl_20231202", params_json); 
		
		$('#res').html('実行完了');
	})
	.fail((jqXHR, statusText, errorThrown) => {
		let errElm = jQuery('#err');
		errElm.append('アクセスエラー');
		errElm.append(jqXHR.responseText);
		alert(statusText);
	});
	
}
	
	
/**
 * Ajax送信データ用エスケープ。実体参照（&lt; &gt; &amp; &）を記号に戻す。
 * 
 * @param any data エスケープ対象 :文字列、オブジェクト、配列を指定可
 * @returns エスケープ後
 */
function _escapeForAjax(data){
	if (typeof data == 'string'){
		if ( data.indexOf('&') != -1) {
			data = data.replace(/&lt;/g,'<').replace(/&gt;/g,'>').replace(/&amp;/g,'&');
			return encodeURIComponent(data);
		}else{
			return data;
		}
	}else if (typeof data == 'object'){
		for(var i in data){
			data[i] = _escapeForAjax(data[i]);
		}
		return data;
	}else{
		return data;
	}
}


	
	
	/**
	 * データ中の「&」と「%」を全角の＆と％に一括エスケープ
	 * 
	 * @note
	 * PHPのJSONデコードでエラーになるので、＆記号をエスケープ。％記号も後ろに数値がつくとエラーになるのでエスケープ
	 * これらの記号はMySQLのインポートなどでエラーになる場合があるのでその予防。
	 * @param mixed data エスケープ対象 :文字列、オブジェクト、配列を指定可
	 * @returns エスケープ後
	 */
	function _escapeAjaxSendData(data){
		if (typeof data == 'string'){
			data = data.replace(/&/g, '＆');
			data = data.replace(/%/g, '％');
			return data;

		}else if (typeof data == 'object'){
			for(var i in data){
				data[i] = this._escapeAjaxSendData(data[i]);
			}
			return data;
		}else{
			return data;
		}
	}
	
	
	
	
	



function exec2(){

	
	let params = {
		access_token:$('#access_token').val(),
		line_rich_menu_id:$('#line_rich_menu_id').val(),
		rich_menu_img:$("[name='rich_menu_img']:checked").val(),
		mode:'img_to_line',
	};

	// データ中の「&」と「%」を全角の＆と％に一括エスケープ(&記号や%記号はPHPのJSONデコードでエラーになる)
	params = _escapeAjaxSendData(params);
	
	let fd = new FormData();
	
	let params_json = JSON.stringify(params);//データをJSON文字列にする。
	localStorage.setItem("rich_menu_curl_20231202", params_json); 
	fd.append( "key1", params_json );
	

	let ajax_url = "backend.php";
	
	// AJAX
	jQuery.ajax({
		type: "post",
		url: ajax_url,
		data: fd,
		cache: false,
		dataType: "text",
		processData: false,
		contentType : false,
	})
	.done((res_json, type) => {
		let params;
		try{
			params =jQuery.parseJSON(res_json);//パース
		}catch(e){
			jQuery("#err").append(res_json);
			return;
		}
		console.log(params);
		$('#line_rich_menu_id').val(params.line_rich_menu_id) ;
		
		let params_json = JSON.stringify(params);//データをJSON文字列にする。
		localStorage.setItem("rich_menu_curl_20231202", params_json); 
		
		$('#res').html(params.res);
	})
	.fail((jqXHR, statusText, errorThrown) => {
		let errElm = jQuery('#err');
		errElm.append('アクセスエラー');
		errElm.append(jqXHR.responseText);
		alert(statusText);
	});
	
}
	
	
	
	
	



function exec3(){

	
	let params = {
		access_token:$('#access_token').val(),
		line_rich_menu_id:$('#line_rich_menu_id').val(),
		mode:'default_to_line',
	};

	// データ中の「&」と「%」を全角の＆と％に一括エスケープ(&記号や%記号はPHPのJSONデコードでエラーになる)
	params = _escapeAjaxSendData(params);
	
	let fd = new FormData();
	
	let params_json = JSON.stringify(params);//データをJSON文字列にする。
	localStorage.setItem("rich_menu_curl_20231202", params_json); 
	fd.append( "key1", params_json );
	

	let ajax_url = "backend.php";
	
	// AJAX
	jQuery.ajax({
		type: "post",
		url: ajax_url,
		data: fd,
		cache: false,
		dataType: "text",
		processData: false,
		contentType : false,
	})
	.done((res_json, type) => {
		let params;
		try{
			params =jQuery.parseJSON(res_json);//パース
		}catch(e){
			jQuery("#err").append(res_json);
			return;
		}
		console.log(params);
		$('#line_rich_menu_id').val(params.line_rich_menu_id) ;
		
		let params_json = JSON.stringify(params);//データをJSON文字列にする。
		localStorage.setItem("rich_menu_curl_20231202", params_json); 
		
		$('#res').html(params.res);
	})
	.fail((jqXHR, statusText, errorThrown) => {
		let errElm = jQuery('#err');
		errElm.append('アクセスエラー');
		errElm.append(jqXHR.responseText);
		alert(statusText);
	});
	
}
	
	
	
	
	



function exec4(){

	
	let params = {
		access_token:$('#access_token').val(),
		line_rich_menu_id:$('#line_rich_menu_id').val(),
		mode:'list_from_line',
	};

	// データ中の「&」と「%」を全角の＆と％に一括エスケープ(&記号や%記号はPHPのJSONデコードでエラーになる)
	params = _escapeAjaxSendData(params);
	
	let fd = new FormData();
	
	let params_json = JSON.stringify(params);//データをJSON文字列にする。
	localStorage.setItem("rich_menu_curl_20231202", params_json); 
	fd.append( "key1", params_json );
	

	let ajax_url = "backend.php";
	
	// AJAX
	jQuery.ajax({
		type: "post",
		url: ajax_url,
		data: fd,
		cache: false,
		dataType: "text",
		processData: false,
		contentType : false,
	})
	.done((res_json, type) => {
		let params;
		try{
			params =jQuery.parseJSON(res_json);//パース
		}catch(e){
			jQuery("#err").append(res_json);
			return;
		}
		console.log(params);
		$('#line_rich_menu_id').val(params.line_rich_menu_id) ;
		
		let params_json = JSON.stringify(params);//データをJSON文字列にする。
		localStorage.setItem("rich_menu_curl_20231202", params_json);
		_resExec4(params.res);
	})
	.fail((jqXHR, statusText, errorThrown) => {
		let errElm = jQuery('#err');
		errElm.append('アクセスエラー');
		errElm.append(jqXHR.responseText);
		alert(statusText);
	});
	
}
	

function _resExec4(res){

	let richmenus = res.richmenus;

	let data_str = '';
	for(let i in richmenus){
		let ent = richmenus[i];
		let richMenuId = ent.richMenuId;
		let name = ent.name;
		let selected = ent.selected;
		let json_size = JSON.stringify(ent.size);
		let json_areas = JSON.stringify(ent.areas);
		let chatBarText = ent.chatBarText;
		
		data_str += '<tr>';
		data_str += `<td>${richMenuId}</td>`;
		data_str += `<td>${name}</td>`;
		data_str += `<td>${selected}</td>`;
		data_str += `<td>${json_size}</td>`;
		data_str += `<td>${chatBarText}</td>`;
		data_str += `<td>${json_areas}</td>`;
		data_str += '</tr>';
	}
	
	let html_str = `
		<table class='tbl2'>
			<thead>
				<tr>
					<th>richMenuId</th>
					<th>name</th>
					<th>selected</th>
					<th>size</th>
					<th>chatBarText</th>
					<th>areas</th>
				</tr>
			</thead>
			<tbody>
				${data_str}
			</tbody>
		</table>
	`;
	
	$('#res').html(html_str);
	
}
	
	
	



function exec5(){

	
	let params = {
		access_token:$('#access_token').val(),
		line_rich_menu_id:$('#line_rich_menu_id').val(),
		mode:'delete_to_line',
	};

	// データ中の「&」と「%」を全角の＆と％に一括エスケープ(&記号や%記号はPHPのJSONデコードでエラーになる)
	params = _escapeAjaxSendData(params);
	
	let fd = new FormData();
	
	let params_json = JSON.stringify(params);//データをJSON文字列にする。
	localStorage.setItem("rich_menu_curl_20231202", params_json); 
	fd.append( "key1", params_json );
	

	let ajax_url = "backend.php";
	
	// AJAX
	jQuery.ajax({
		type: "post",
		url: ajax_url,
		data: fd,
		cache: false,
		dataType: "text",
		processData: false,
		contentType : false,
	})
	.done((res_json, type) => {
		let params;
		try{
			params =jQuery.parseJSON(res_json);//パース
		}catch(e){
			jQuery("#err").append(res_json);
			return;
		}
		console.log(params);
		$('#line_rich_menu_id').val(params.line_rich_menu_id) ;
		
		let params_json = JSON.stringify(params);//データをJSON文字列にする。
		localStorage.setItem("rich_menu_curl_20231202", params_json); 
		
		$('#res').html(params.res);
	})
	.fail((jqXHR, statusText, errorThrown) => {
		let errElm = jQuery('#err');
		errElm.append('アクセスエラー');
		errElm.append(jqXHR.responseText);
		alert(statusText);
	});
	
}
	
	
	
	
	
	
	
	
	
	
	