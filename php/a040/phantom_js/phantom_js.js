/**
 * PhantomJSで動的HTMLをスクレイピング
 */


function test1(){
	
	var url1 = $('#url1').val();
	url1 = url1.replace(/&/g, '%26'); // PHPのJSONデコードでエラーになるので、＆だけ変換しておく。
	
	var data={'url1':url1};
	var json_str = JSON.stringify(data);//データをJSON文字列にする。

	// AJAX
	$.ajax({
		type: "POST",
		url: "phantom_js.php",
		data: "key1="+json_str,
		cache: false,
		dataType: "text",
	})
	.done((res_html, type) => {
		
		res_html = _xss_sanitize(res_html);
		jQuery("#res").html(res_html);

	})
	.fail((jqXHR, statusText, errorThrown) => {
		jQuery('#err').html(jqXHR.responseText);
		alert(statusText);
	});
	
}

/**
 * XSSサニタイズ
 * 
 * @note
 * 「<」と「>」のみサニタイズする
 * 
 * @param any data サニタイズ対象データ | 値および配列を指定
 * @returns サニタイズ後のデータ
 */
function _xss_sanitize(data){
	if(typeof data == 'object'){
		for(var i in data){
			data[i] = _xss_sanitize(data[i]);
		}
		return data;
	}
	
	else if(typeof data == 'string'){
		return data.replace(/</g, '&lt;').replace(/>/g, '&gt;');
	}
	
	else{
		return data;
	}
}