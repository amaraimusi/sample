/**
 * テスト
 */

$(() => {
	
	var pwValidK = new PwValidK();

	var tests = getTestData();

	for(var i in tests){
		var test = tests[i];
		// 普通型
		var res = pwValidK.check(test.pw_text);
		test['check1'] = wrapRes(res);
		
		// 数値必須型
		var res = pwValidK.check(test.pw_text,{'num_req':true});
		test['check1_num_req'] = wrapRes(res);
	}
	
	var html = createHtmlTable(tests);
	$('#res').html(html);
	
	

	
});

function wrapRes(res){
	var msg = 'false';
	if(res.check===true){
		msg = "<span class='text-primary'>true</span>";
	}else if(res.check===false){
		msg = "<span class='text-danger'>" + res.err_msg + "</span>";
	}
	return msg;
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


function getTestData(){
	var tests = [
		{'pw_text':''},
		{'pw_text':'tV3hTdS'},
		{'pw_text':'12345678'},
		{'pw_text':'abcdefgh'},
		{'pw_text':'ABCDEFGH'},
		{'pw_text':'abcd1234'},
		{'pw_text':'abcdEFGH'},
		{'pw_text':'1234EFGH'},
		{'pw_text':'いろはにほへとちりぬのを'},
		{'pw_text':'abcd.efg'},
		{'pw_text':'abcd_efg'},
		{'pw_text':'abcd-efg'},
		{'pw_text':'abcdaefg'},
		{'pw_text':'E5z4ZnwB'},
		{'pw_text':'A4d72CzX'},
		{'pw_text':'U4jMAWD9'},
		{'pw_text':'tV3hTdSk'},
		{'pw_text':'mQ2ceTnH'},
		{'pw_text':'Cp64ySBi'},
		{'pw_text':'eN9kmgf2'},
		{'pw_text':'d4TynCBE'},
		{'pw_text':'L6uFGkRU'},
		{'pw_text':'V6gHNKsh'},
		{'pw_text':'uXtFCBdXXVKx'},
		{'pw_text':'wLrvmLrRZ8na'},
		{'pw_text':'uUEQJePFXCX3'},
		{'pw_text':'p5wpeMqnTjfS'},
		{'pw_text':'57Q5SsWfxjb6'},
		{'pw_text':'Y2mAFpT25Syk'},
		{'pw_text':'Ywnc3WDQybUv'},
		{'pw_text':'2ifZLhRiNWNk'},
		{'pw_text':'Kmyhczn3ryfA'},
		{'pw_text':'2uWywsiqj63A'},
		{'pw_text':'nazenekohahitonokaowomitaraniA9x'},
		{'pw_text':'nazenekohahitonokaowomitaraniA9xa'},
	];
	return tests;
}