/**
 * 行列データからHTMLテーブルコードを生成を生成
 * 2015-12-29	新規作成
 */


/**
* 実行
* mode モード to_camel, to_snake
*/
function execution1(mode){

	// データのエンティティキー
	let keys = ['field'];// 例→ 	neko_name	varchar(255)	1	NULL ネコ名
	
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

	let resList = [];
	let resBList = [];
	for(let i in data){
		let ent = data[i];
		let field = ent.field;
		let res_str = '';
		let res_b_str = '';
		if(mode == 'to_camel'){
			
			res_str = snakeToCamel(field);
			res_b_str = capitalizeFirstLetter(res_str);
		}else if(mode == 'to_snake'){
			
			let field2 = lowercaseFirstLetter(field);
			res_str = camelToSnake(field2);
			
		}
		
		resList.push(res_str);
		resBList.push(res_b_str);
	}
	
	let res = resList.join('\n');
	let res_b = resBList.join('\n');
	
	jQuery('#res').html(res);
	jQuery('#res_b').html(res_b);


}


function snakeToCamel(str) {
  return str
    .split('_')
    .map((word, index) => 
      index === 0 ? word : word.charAt(0).toUpperCase() + word.slice(1)
    )
    .join('');
}

function camelToSnake(str) {
  return str
    .replace(/([A-Z])/g, '_$1')
    .toLowerCase();
}

function capitalizeFirstLetter(str) {
  if (str.length === 0) {
    return str;
  }
  return str.charAt(0).toUpperCase() + str.slice(1);
}

function lowercaseFirstLetter(str) {
  if (str.length === 0) {
    return str;
  }
  return str.charAt(0).toLowerCase() + str.slice(1);
}

