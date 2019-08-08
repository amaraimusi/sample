

$(()=>{
	
	let data = [
		{name:"数値の0", value:0},
		{name:"半角文字列の'0'", value:'0'},
		{name:"全角文字列の'０'", value:'０'},
		{name:"数値の9", value:9},
		{name:"半角文字の'9'", value:'9'},
		{name:"全角の'９'", value:'９'},
		{name:"全角の'１２３４５６７８９０'", value:'１２３４５６７８９０'},
		{name:"空文字 ''", value:''},
		{name:"null", value:null},
		{name:"undefined", value:undefined},
		{name:"数値以外「あ」", value:'あ'},
		{name:"負値 -1", value:-1},
		{name:"全角の負値'ー１'", value:"ー１"},
		{name:"小数 1.23", value:1.23},
		{name:"全角の小数'１．２３'", value:"１．２３"},
	];
	
	let html = `
		<table class="tbl2">
			<thead>
				<tr><th>サンプル</th><th>結果</th></tr>
			</thead>
			<tbody>
	`;
	for(let i in data){
		let ent = data[i];
		let res = _numericizeAndCheck(ent.value);
		
		html += `
			<tr>
				<td>${ent.name}</td>
				<td>${res}</td>
			</tr>
		`;
		
	}
	
	html += `
			</tbody>
		</table>
	`;
	
	$('#res').html(html);
});


	/**
	 * 手入力数値の数値化および入力チェック | 全角数値を半角数値に変換
	 * 
	 * @note
	 * 負数にも対応するが全角ハイフン「－」には対応しない。半角ハイフンのみ。
	 * 小数値にも対応。
	 * 
	 * @param mixed num_text 数値テキスト
	 * @param bool req 必須チェックフラグ true(デフォ）:必須
	 * @return int 数値 or エラー文字列
	 */
	function _numericizeAndCheck(num_text, req){
		
		if(req==null) req = true; // 必須チェックフラグ
		
		// 空文字判定
		if(num_text == null || num_text === '' || num_text === false){
			if(req == true){
				return "必須入力です。";
			}else{
				return 0;
			}
		}
	
		num_text += ''; // 文字列扱いにする
		
		// 全角を半角にする
		num_text = num_text.replace(/[Ａ-Ｚａ-ｚ０-９！-～]/g, (s) => {
			return String.fromCharCode(s.charCodeAt(0)-0xFEE0);
		});
		
		num_text = num_text.trim();
		
		// 整形後の空文字判定
		if(num_text === ''){
			if(req == true){
				return "必須入力です。";
			}else{
				return 0;
			}
		}

		if(isNaN(num_text)){
			return "数値を入力してください。";
			return;
		}
		
		num_text = num_text * 1; // 数値化する
		
		return num_text;
	}