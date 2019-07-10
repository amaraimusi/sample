/**
 * オブジェクトをソートする
 * @date 2016-12-19
 */
$(function(){
	
	data=[
	       {'id':1,'name':'yagi','value1':103},
	       {'id':2,'name':'kani','value1':104},
	       {'id':3,'name':'same','value1':102},
	       {'id':4,'name':'wasi','value1':100},
	       {'id':5,'name':'gori','value1':101},
	       {'id':6,'name':'roba','value1':105},
	       {'id':7,'name':'semi','value1':106},
	       {'id':8,'name':'tako','value1':107},
	       {'id':9,'name':'hebi','value1':1000},
	       {'id':10,'name':'kame','value1':108},
	       ];
	
	var tblHtml = createHtmlTable(data);
	$('#res1').html(tblHtml);
	
	data = sortData(data,'value1','asc');
	
	//$('#res').html(JSON.stringify(data));
	var tblHtml = createHtmlTable(data);
	$('#res2').html(tblHtml);
	
});


/**
 * データをソートする
 * 
 * @note
 * データはObject型エンティティの配列である。
 * 
 * @param data データ
 * @param key エンティティのフィールド(プロパティ）
 * @param order 並び順  asc:昇順,  desc:降順
 * @return ソート後のデータ
 */
function sortData(data,field,order='asc'){
	
	if(order=='asc'){
		data.sort(function(a,b){
			if(a[field] < b[field]){
				return -1;
			
			}else if(a[field] > b[field]){
				return 1;
			}
			return 0;
		});
	}
	
	else if(order=='desc'){
		data.sort(function(a,b){
			if(a[field] < b[field]){
				return 1;
			
			}else if(a[field] > b[field]){
				return -1;
			}
			return 0;
		});
	}

	return data;
	
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
	html += "</tr></thead>\n";
	
	
	// tbodyの部分を作成
	for(var i in data){
		var ent = data[i];
		html += "<tr>";
		for(var f in ent){
			html += "<td>" + ent[f] + "</td>"
		}
		html += "</tr>\n";
		
	}
	
	html+= "</table>";

	return html;
	

}

