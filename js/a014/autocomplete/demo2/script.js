
$(()=>{
	refreshList('');
})
function changeText(){
	
	let text = $('#animal_tb').val();
	
	refreshList(text);
}
function test1(){
	console.log('xxx1');//■■■□□□■■■□□□
	refreshList();
}


function refreshList(text1){

	text1 = text1.replace(/&/g, '%26'); // PHPのJSONデコードでエラーになるので、＆だけ変換しておく。
	
	var sendData={'text1':text1};

	// data = _escapeForAjax(sendData); // Ajax送信データ用エスケープ。実体参照（&lt; &gt; &amp; &）を記号に戻す。
	// data = _ampTo26(data); // PHPのJSONデコードでエラーになるので、＆を%26に一括変換する

	var send_json = JSON.stringify(sendData);//データをJSON文字列にする。

	// AJAX
	jQuery.ajax({
		type: "POST",
		url: "backend.php",
		data: "key1=" + send_json,
		cache: false,
		dataType: "text",
	})
	.done((res_json, type) => {
		var res;
		console.log('xxx3');//■■■□□□■■■□□□
		try{
			res =jQuery.parseJSON(res_json);//パース
		}catch(e){
			jQuery("#err").append(res_json);
			return;
		}
		
		_refreshAutocomplete(res);
	})
	.fail((jqXHR, statusText, errorThrown) => {
		jQuery('#err').append('アクセスエラー');
		jQuery('#err').append(jqXHR.responseText);
		alert(statusText);
	});
}

	
function _refreshAutocomplete(data){
	
	let ac_option_html = '';
	for(i in data){
		let ent = data[i];
		let v = ent.wamei;
		ac_option_html += `<option value="${v}"></option>`;
	}
	
	$('#list1').html(ac_option_html);
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
 * データ中の「&」と「%」を一括エスケープ
 * @note
 * PHPのJSONデコードでエラーになるので、＆記号をエスケープ。％記号も後ろに数値がつくとエラーになるのでエスケープ
 * 
 * @param mixed data エスケープ対象 :文字列、オブジェクト、配列を指定可
 * @returns エスケープ後
 */
function _ampTo26(data){
	if (typeof data == 'string'){
		if ( data.indexOf('&') != -1) {
			return data.replace(/&/g, '%26');
		}else if(data.indexOf('%') != -1){
			return data.replace(/%/g, '%25');;
		}else{
			return data;
		}
	}else if (typeof data == 'object'){
		for(var i in data){
			data[i] = _ampTo26(data[i]);
		}
		return data;
	}else{
		return data;
	}
}