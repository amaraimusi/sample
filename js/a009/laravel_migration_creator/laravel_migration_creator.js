/**
 * 行列データからHTMLテーブルコードを生成を生成
 * 2015-12-29	新規作成
 */



function execution1(){

	// データのエンティティキー
	let keys = ['field', 'type', 'not_null', 'def', 'wamei'];// 例→ 	neko_name	varchar(255)	1	NULL ネコ名
	
	// 貼り付けテキストエリアからテキストを取得する
	let text = $('#pasting_csv').val();

	// テキストを分解してデータを取得する
	let data = [];//データ
	let lines = text.split(/\r\n|\r|\n/);
	for (let i=0;i<lines.length;i++){
		let line = lines[i];
		if(line == null || line=='') continue;
		let dd = line.split(/\t/);
		
		// エンティティにセット
		let ent ={};
		for(let k_i in keys){
			let key = keys[k_i];
			ent[key] = dd[k_i];
		}
		data.push(ent);
	}

	// テーブル名
	let tbl_name = jQuery('#tbl_name').val();

	// フィールドコード文字列を取得する
	let field_codes_str = _getFieldCodesStr(data);
	
	let html = `
    public function up(): void
    {
        Schema::create('${tbl_name}', function (Blueprint $table) {
${field_codes_str}
            $table->timestamps();
        });
	}
	`;

	
	let res=sanitize_str(html);//サニタイズ
	jQuery('#res').html(res);

}


/**
 * フィールドコード文字列を取得する
 * @param array data
 * @returns string フィールドコード文字列
 */
function _getFieldCodesStr(data){
	console.log(data);
	let codes_str = '';

	for(let i in data){
		let ent = data[i];
		
		let code = '';
		if(ent.field == 'id'){
			if(ent.type.substring(0, 4) == 'char'){
				code = `$table->ulid('id')->primary();`;
			}else{
				code = `$table->id();`;
			}
			codes_str += '            ' + code + "\n";
			continue;
		}
		
		let type = ent.type.replace(/\(.*?\)/g, ''); // 型から"()"とその中身を取り除く。
		type = type.toLowerCase(); // 小文字化する
		
		let _long = getParenthesesContents(ent.type); // 型から"()"内の数値を文字列長として取得する。
		
		let long_str = '';
		if(!_empty(_long)){
			long_str = `, ${_long}`;
		}
		
		// tinyint型で使用するtinyInteger()関数は2番の引数である文字列長の指定ができないので文字列長をなしにする。
		if(type=='tinyint'){
			long_str = '';
		}
		
		
		let nullable_str = '';
		if(this._empty(ent.not_null )){
			nullable_str = `->nullable()`;
		}
		
		let default_str = '';
		if(!(ent.def === '' || ent.def === null || ent.def === undefined)){
			default_str = `->default(${ent.def})`;
		}
		
		
		
		let field_str = '';
		switch (type){
			case 'int':
				field_str = 'integer'
				break;
			case 'date':
				field_str = 'date'
				break;
			case 'tinyint':
				field_str = 'tinyInteger'
				break;
			case 'text':
				field_str = 'text'
				break;
			default:
				field_str = 'string'
				break;
			
		}
		
		code = `$table->${field_str}('${ent.field}'${long_str})${default_str}->comment('${ent.wamei}')${nullable_str};`;

		codes_str += '            ' + code + "\n";
	}
	return codes_str;
}

function getParenthesesContents(str) {
  // 正規表現を使って、"("と")"の間にある文字列をマッチングします。
  // 丸括弧で囲まれた部分(.+?)がキャプチャグループになります。
  const regex = /\((.+?)\)/g;
  const contents = [];
  let match;

  // 全てのマッチを見つけて配列に追加します。
  while ((match = regex.exec(str)) !== null) {
    // キャプチャグループの文字列を取得します。
    contents.push(match[1]);
  }

  return contents;
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
