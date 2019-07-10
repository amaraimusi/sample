
$(() =>{
	
	var data = [
		{'before':'1990-1-1'}, 
		{'before':'2019-1-1'}, 
		{'before':'2019/1/1'}, 
		{'before':'2019/1/12'}, 
		{'before':'2019-1-31'}, 
		{'before':'2019-2-29'}, 
		{'before':'2019-8-32'}, 
		{'before':'2019-10-10 1:2:3'}, 
		{'before':'2019-12-31'}, 
		{'before':'2050-12-31'}, 
		{'before':'AAA'}, 
	];
	
	for(var i in data){
		var ent = data[i];
		var before = ent['before'];
		
		ent['after'] = convDateTo_yyyymmdd(before);
	}
	
	var html = createHtmlTable(data);
	$('#res').html(html);
	
});



/**
 * 日付の書式を「yyyy-mm-dd」形式に変換する
 * @param mixed date1 日付
 * @returns string 「yyyy-mm-dd」形式の日付文字列
 */
function convDateTo_yyyymmdd(date1){
	
	// 引数が文字列型であれば日付型に変換する
	if((typeof date1) == 'string'){
		date1 = new Date(date1);
		if(date1 == 'Invalid Date'){
			return null;
		}
	}
	
	var year = date1.getFullYear();
	var month = date1.getMonth() + 1;
	month = ("0" + month).slice(-2); // 2桁の文字列に変換する
	var day = date1.getDate();
	day = ("0" + day).slice(-2);
	var date_str = year + '-' + month + '-' + day;
	return date_str;
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