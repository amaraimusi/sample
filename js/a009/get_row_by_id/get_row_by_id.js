

function test1(){
	var parElm = $('#test_tbl tbody');
	
	// 第一の子要素のタグ名（エンティティセレクタ）を取得する
	var firstRow = parElm.children().eq(0);
	var ent_slt = firstRow.get(0).tagName;

	for(var id=1; id<=6; id++){
		// 親要素からデータidに紐づく行要素を取得する
		var rowElm = getRowElmById(parElm, ent_slt, id);
		output(rowElm);
	}
}


/**
 * 親要素からデータidに紐づく行要素を取得する
 * @param jQuery parElm 親要素
 * @param string ent_slt エンティティ要素のセレクタ 例 → tr
 * @param int id データid
 * @returns jQuery 行要素
 */
function getRowElmById(parElm, ent_slt, id){

	// ▼ data-id属性による行取得
	var slt = ent_slt + "[data-id='" + id +"']";
	var tr = jQuery(slt);
	if(tr[0]) return tr;
	
	// ▼ input系のname属性による値要素の取得
	slt = "[name='id'][value='" + id + "']";
	var valElm = parElm.find(slt);
	
	// ▼ input系のclass属性による値要素の取得
	if(valElm[0] == null){
		slt = ".id[value='" + id + "']";
		valElm = parElm.find(slt);
	}
	
	// ▼ div,spanなどのclass属性による値要素の取得（やや重い処理）
	if(valElm[0] == null){
		parElm.find('.id').each((i,e2) => {
			var elm2 = jQuery(e2);
			var id2 = elm2.text();
			if(id == id2){
				valElm = elm2;
				return;
			}
		});
	}
	
	
	
	if(valElm[0]){
		tr = valElm.parents(ent_slt);
		return tr;
	}
	return null;

}

function output(tar){
	if(tar instanceof jQuery){
		var html = tar[0].outerHTML;
		html = _xss_sanitize(html);
		html += '<br>';
		$('#res').append(html);
		
	}else{
		tar += '<br>';
		$('#res').append(tar);
	}
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