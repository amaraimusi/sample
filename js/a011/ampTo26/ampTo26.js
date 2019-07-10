
var m_data = {};
$(()=>{
	
	var data = [
		{name:'dog&cat',v1:null,v2:'',v3:999,v4:'&catdog',v5:'catdog&'},
		{kaeru:{name:'ハナサキガエル&イシカワガエル',value:'1000',deep:{aaa:'a&b',ccc:'c&d'}}},
	];
	
	var json = JSON.stringify(data);
	$('#data_preview1').html(json);
	
	m_data = data;
});


function test1(){
	var data = m_data;
	var data = _ampTo26(data);
	var json = JSON.stringify(data);
	$('#data_preview2').html(json);
}



/**
 * データ中の「&」を「%26」に一括エスケープ
 * @note
 * PHPのJSONデコードでエラーになるので、＆記号を「%26」に変換する
 * 
 * @param mixed data エスケープ対象 :文字列、オブジェクト、配列を指定可
 * @returns エスケープ後
 */
function _ampTo26(data){
	if (typeof data == 'string'){
		if ( data.indexOf('&') != -1) {
			return data.replace(/&/g, '%26');
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