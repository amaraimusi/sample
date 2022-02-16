


function test1(){
	let url = $('#textbox1').val();
	
	let param =getQueryFromURL(url);
	
	// 検証結果に出力
	console.log(param);
	let json_str = JSON.stringify(param);
	$('#res').html(json_str);
	
}


/**
 * URLからクエリパラメータを抜き出す | URLからGETパラメータの取得
 * @param url
 * @return object URLクエリデータ
 */
function getQueryFromURL(url){
	
	if (url==null || url==""){
		return {};
	}
	
	let a=url.indexOf('?');
	let q_str =url.substring(a+1, url.length);
		
	if(q_str =='' || q_str==null) return {};
	
	let ary = q_str.split('&');
	let data = {};
	for(let i=0 ; i<ary.length ; i++){
		let s = ary[i];
		let prop = s.split('=');
		data[prop[0]]=prop[1];
	}	
	
	return data;
}