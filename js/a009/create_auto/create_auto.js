/**
 * 行列データからHTMLテーブルコードを生成を生成
 * 2015-12-29	新規作成
 */



function execution1(){

	// データのエンティティキー
	var keys = ['field', 'type', 'not_null', 'def', 'wamei'];// 例→ 	neko_name	varchar(255)	1	NULL ネコ名
	
	// 貼り付けテキストエリアからテキストを取得する
	var text = $('#pasting_csv').val();

	// テキストを分解してデータを取得する
	var data = [];//データ
	var lines = text.split(/\r\n|\r|\n/);
	for (var i=0;i<lines.length;i++){
		var line = lines[i];
		if(line == null || line=='') continue;
		var dd = line.split(/\t/);
		
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
	var field_codes_str = _getFieldCodesStr(data);
	
	var html = `
		SET AUTOCOMMIT = 0;
		START TRANSACTION;
		SET time_zone = "+00:00";
		
		CREATE TABLE ${tbl_name} (
			id int(11) NOT NULL,
${field_codes_str}
			sort_no int(11) DEFAULT '0' COMMENT '順番',
			delete_flg tinyint(1) DEFAULT '0' COMMENT '無効フラグ',
			update_user_id int(11) DEFAULT NULL COMMENT '更新者ユーザーID',
			ip_addr varchar(40) DEFAULT NULL COMMENT 'IPアドレス',
			created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '生成日時',
			updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新日'
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
		
		ALTER TABLE ${tbl_name} ADD PRIMARY KEY (id);
		
		ALTER TABLE ${tbl_name}
			MODIFY id int(11) NOT NULL AUTO_INCREMENT;
		COMMIT;
	`;
	
	var res=sanitize_str(html);//サニタイズ
	jQuery('#res').html(res);

}


/**
 * フィールドコード文字列を取得する
 * @param array data
 * @returns string フィールドコード文字列
 */
function _getFieldCodesStr(data){
	// `neko_val` int(11) DEFAULT NULL COMMENT 'ネコ数値',
	var codes_str = '';
	for(var i in data){
		var ent = data[i];
		
		var def = ent['def'];
		var def_str = '';
		if(def == 'null' || def=='NULL'){
			def_str = 'DEFAULT NULL';
		}else if(/^([1-9]\d*|0)$/.test(def)){
			def_str = 'DEFAULT ' + def;
		}else if(!_empty(def)){
			def_str = "DEFAULT '" + def + "'";
		}else{
			
		}

		var not_null = 'NOT NULL';
		if(_empty(ent.not_null)) not_null = '';

		var code = `${ent.field} ${ent.type} ${not_null} ${def_str} COMMENT '${ent.wamei}'`;
		code = "\t\t\t" + code + ", \n";
		codes_str += code;
	}
	return codes_str;
}


	// Check empty.
function _empty(v){
	if(v == null || v == '' || v=='0'){
		return true;
	}else{
		if(typeof v == 'object'){
			if(Object.keys(v).length == 0){
				return true;
			}
		}
		return false;
	}
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
