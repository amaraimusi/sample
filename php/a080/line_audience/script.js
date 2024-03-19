$(()=>{
	
	let params_json = localStorage.getItem("line_audience_20240316"); 
	if(params_json){
		let params = JSON.parse(params_json);
		$('#access_token').val(params.access_token);
		$('#line_audience_group_id').val(params.line_audience_group_id);
	}
});



function exec(){

	$('#res').html('');
	$('#err').html('');
	
	let params = {
		access_token:$('#access_token').val(),
		line_audience_group_id:$('#line_audience_group_id').val(),
		mode:'audience_list',
	};

	// データ中の「&」と「%」を全角の＆と％に一括エスケープ(&記号や%記号はPHPのJSONデコードでエラーになる)
	params = _escapeAjaxSendData(params);
	
	let fd = new FormData();
	
	let params_json = JSON.stringify(params);//データをJSON文字列にする。
	localStorage.setItem("line_audience_20240316", params_json); 
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
		let res;
		try{
			res =jQuery.parseJSON(res_json);//パース
		}catch(e){
			jQuery("#err").append(res_json);
			return;
		}
		let data = res.list.audienceGroups;
		let html = createHtmlTable(data);
		
		console.log(data);
		$('#audience_list').html(html) ;
		
		_outputErrs(res.errs);

		
		let params_json = JSON.stringify(params);//データをJSON文字列にする。
		localStorage.setItem("line_audience_20240316", params_json); 
		
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
	
	$('#res').html('');
	$('#err').html('');

	let params = {
		access_token:$('#access_token').val(),
		line_audience_group_id:$('#line_audience_group_id').val(),
		mode:'audience_reg',
	};

	// データ中の「&」と「%」を全角の＆と％に一括エスケープ(&記号や%記号はPHPのJSONデコードでエラーになる)
	params = _escapeAjaxSendData(params);
	
	let fd = new FormData();
	
	let params_json = JSON.stringify(params);//データをJSON文字列にする。
	localStorage.setItem("line_audience_20240316", params_json); 
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

		_outputErrs(params.errs);

		if(_empty(params.errs)){
			$('#res').html('成功しました。');
		}
		
	})
	.fail((jqXHR, statusText, errorThrown) => {
		let errElm = jQuery('#err');
		errElm.append('アクセスエラー');
		errElm.append(jqXHR.responseText);
		alert(statusText);
	});
	
}
	
	
	
	
	


	



function exec5(){
	
	$('#res').html('');
	$('#err').html('');

	let params = {
		access_token:$('#access_token').val(),
		line_audience_group_id:$('#line_audience_group_id').val(),
		mode:'audience_delete',
	};

	// データ中の「&」と「%」を全角の＆と％に一括エスケープ(&記号や%記号はPHPのJSONデコードでエラーになる)
	params = _escapeAjaxSendData(params);
	
	let fd = new FormData();
	
	let params_json = JSON.stringify(params);//データをJSON文字列にする。
	localStorage.setItem("line_audience_20240316", params_json); 
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

		_outputErrs(params.errs);

		if(_empty(params.errs)){
			$('#res').html('成功しました。');
		}
	})
	.fail((jqXHR, statusText, errorThrown) => {
		let errElm = jQuery('#err');
		errElm.append('アクセスエラー');
		errElm.append(jqXHR.responseText);
		alert(statusText);
	});
	
}


function _outputErrs(errs){
	if(_empty(errs)) return;
	let err_html = '';
	for(let i in errs){
		let err = errs[i];
		err_html += `<div>${err}</div>`;
	}
	$('#err').append(err_html);
}
	
	
	
	// Check empty.
function _empty(v){
	if(v == null || v == '' || v=='0'){
		return true;
	}else{
		if(typeof v == 'object'){
			if(Object.keys(v).length == 0){
				return true;
			}
		}
		return false;
	}
}
	
	
	/**
	 * エンティティリスト型のデータからHTMLテーブルを生成
	 * @param data エンティティリスト型のデータ
	 * @return string HTMLテーブルのHTMLソース
	 */
	function createHtmlTable(data){
		
		if(data.length==0){
			return "";
		}
		
		var html = "<table class='tbl2'>";
		
		// 0件目のエンティティからtheadを作成
		html += "<thead><tr>";
	
		var ent0 = data[0];
		for(var field in ent0){
			html += "<th>" + field + "</th>";
		}
		html += "</tr></thead>";
		
		// tbodyの部分を作成
		for(var i in data){
			var ent = data[i];
			html += "<tr>";
			for(var f in ent){
				html += "<td>" + ent[f] + "</td>"
			}
			html += "</tr>";
			
		}
		
		html+= "</table>";
	
		return html;
		
	}
	
	
	
	
	