/**
 * URLクエリを取得する | GETパラメータ
 * @date 2016-4-19
 */

$(function(){

	// URLクエリデータを取得する
	var querys = getUrlQuery();
	
	console.log(querys);
	var json = JSON.stringify(querys);
	$('#res').html(json);
	
});

/**
 * URLクエリデータを取得する
 * 
 * @return object URLクエリデータ
 */
function getUrlQuery(){
	query = window.location.search;
	
	if(query =='' || query==null){
		return {};
	}
	var query = query.substring(1,query.length);
	var ary = query.split('&');
	var data = {};
	for(var i=0 ; i<ary.length ; i++){
		var s = ary[i];
		var prop = s.split('=');
		
		data[prop[0]]=prop[1];

	}	
	return data;
}