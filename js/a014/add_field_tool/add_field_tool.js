/**
 * 行列データからHTMLテーブルコードを生成を生成
 * 2015-12-29	新規作成
 */



function execution1(){

	// データのエンティティキー
	var keys = ['wamei', 'field', 'type', 'long', 'def'];// 例→ ネコ名	neko_name	varchar	255	NULL
	
	// 貼り付けテキストエリアからテキストを取得する
	var text = $('#pasting_csv').val();

	// テキストを分解してデータを取得する
	var data = [];//データ
	var lines = text.split(/\r\n|\r|\n/);
	for (var i=0;i<lines.length;i++){
		var line = lines[i];
		if(line == null || line=='') continue;
		var dd = line.split(/\t/);
		if(typeof dd == 'string'){
			dd = dd.trim();
		}
		
		// エンティティにセット
		var ent ={};
		for(var k_i in keys){
			var key = keys[k_i];
			ent[key] = dd[k_i];
		}
		data.push(ent);
	}

	// テーブル名
	var tbl_name = jQuery('#tbl_name').val();

	// フィールドコード文字列を取得する
	var field_codes_str = _getFieldCodesStr(data, tbl_name);

	var html = field_codes_str;
	
	var res=sanitize_str(html);//サニタイズ
	jQuery('#res').html(res);

}


/**
 * フィールドコード文字列を取得する
 * @param array data
 * @returns string フィールドコード文字列
 */
function _getFieldCodesStr(data, tbl_name){
	var codes_str = '';
	var after = '';
	for(var i in data){
		var ent = data[i];

		var type = ent.type;
		var code = '';
		switch(type){
			case 'varchar':
				code = `ALTER TABLE ${tbl_name} ADD ${ent.field} VARCHAR(${ent.long}) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '${ent.wamei}' ${after};`;
				break;
				
			case 'text':
				code = `ALTER TABLE ${tbl_name} ADD ${ent.field} TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '${ent.wamei}' ${after};`;
				break;
				
			case 'int':
				code = `ALTER TABLE ${tbl_name} ADD ${ent.field} INT NULL DEFAULT '0' COMMENT '${ent.wamei}' ${after};`;
				break;
				
			case 'tinyint':
				code = `ALTER TABLE ${tbl_name} ADD ${ent.field} TINYINT NULL DEFAULT '0' COMMENT '${ent.wamei}' ${after};`;
				break;
				
			case 'double':
				code = `ALTER TABLE ${tbl_name} ADD ${ent.field} DOUBLE NULL DEFAULT '0' COMMENT '${ent.wamei}' ${after};`;
				break;
				
			case 'date':
				code = `ALTER TABLE ${tbl_name} ADD ${ent.field} DATE NULL COMMENT '${ent.wamei}' ${after};`;
				break;
				
			case 'datetime':
				code = `ALTER TABLE ${tbl_name} ADD ${ent.field} DATETIME NULL COMMENT '${ent.wamei}' ${after};`;
				break;
				
			case 'time':
				code = `ALTER TABLE ${tbl_name} ADD ${ent.field} TIME NULL COMMENT '${ent.wamei}' ${after};`;
				break;
				
			default:
				code = `ALTER TABLE ${tbl_name} ADD ${ent.field} ${type} NULL COMMENT '${ent.wamei}' ${after};`;
				break;
		}
		
		after = `AFTER ${ent.field}`;

		code =  code + " \n";
		codes_str += code;
	}
	return codes_str;
}



/**
 * 一般用のサニタイズ
 */
function sanitize_str(str) {


	//記号「;&<>",」をサニタイズ
    str = str.replace(/</g, '&lt;');
    str = str.replace(/>/g, '&gt;');
    str = str.replace(/"/g, '&quot;');
    str = str.replace(/\t/g, '&#x0009;');
    str = str.replace(/\r\n|\r|\n/g, '<br>');
    //str = str.replace(/&/g, '&amp;');



    return str;
}
