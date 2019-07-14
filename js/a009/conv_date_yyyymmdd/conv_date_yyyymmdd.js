
$(() =>{
	
	var data = [
		{'before':null}, 
		{'before':'1990-1-1'}, 
		{'before':'2019-1-1'}, 
		{'before':'2019/1/1'}, 
		{'before':'2019/1/12'}, 
		{'before':'2019-1-31'}, 
		{'before':'2019-2-29'}, 
		{'before':'2019-8-32'}, 
		{'before':'2019-10-10 1:2:3', 'format':'Y/m/d h:i:s'}, 
		{'before':'2019-12-31'}, 
		{'before':'2050-12-31'}, 
		{'before':'1990-1-1 1:2:3', 'format':'Y-m-d h:i:s'}, 
		{'before':'2019-7-14 12:13:14', 'format':'Y-m-d h:i:s'}, 
		{'before':'2019-7-14 12:13', 'format':'Y-m-d h:i:s'}, 
		{'before':'2019-7-14 12', 'format':'Y-m-d h:i:s'}, 
		{'before':'2019-7-14', 'format':'Y-m-d h:i:s'}, 
		{'before':'2019-7', 'format':'Y-m-d h:i:s'}, 
		{'before':'2019', 'format':'Y-m-d h:i:s'}, 
		{'before':'AAA'}, 
	];
	
	for(var i in data){
		var ent = data[i];
		var before = ent['before'];
		var format = ent['format'];
		
		ent['after'] = dateFormat(before, format);
		
		if(ent['format'] == null){
			ent['format'] = 'Y-m-d';
		}
	}
	
	var html = createHtmlTable(data);
	$('#res').html(html);
	
});



/**
 * 日付フォーマット変換
 * @param mixed date1 日付
 * @param string format フォーマット Y-m-d, Y/m/d h:i:s など
 * @returns string 「yyyy-mm-dd」形式の日付文字列
 */
function dateFormat(date1, format){
	
	if(date1 == null) date1 = new Date().toLocaleString();
	if(format == null) format = 'Y-m-d';
	
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
	
	var houre = date1.getHours();
	houre = ("0" + houre).slice(-2);
	
	var minute = date1.getMinutes();
	minute = ("0" + minute).slice(-2);
	
	var second = date1.getSeconds();
	second = ("0" + second).slice(-2); // 2桁の文字列に変換する
	
	var date_str = format;
	date_str = date_str.replace('Y', year);
	date_str = date_str.replace('m', month);
	date_str = date_str.replace('d', day);
	date_str = date_str.replace('h', houre);
	date_str = date_str.replace('i', minute);
	date_str = date_str.replace('s', second);
	
	//var date_str = year + '-' + month + '-' + day;
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
	
	var html = `
		<table class='tbl2'><thead><tr>
			<th>変換前</th><th>フォーマット</th><th>変換後</th>
		<tr></thead><tbody>
	`;
	
	for(var i in data){
		var ent = data[i];
		html += `<tr><td>${ent['before']}</td><td>${ent['format']}</td><td>${ent['after']}</td></tr>`;
	}
	
	html+= "</tbody></table>";

	return html;
	
}