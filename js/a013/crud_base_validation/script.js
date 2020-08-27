var cbv; // CrudBaseValidation.js
$(()=>{
	
	cbv = new CrudBaseValidation();
	
	// 整数 | isIntegerメソッドのテスト
	testIsInteger();
	
});


// 整数 | isIntegerメソッドのテスト
function testIsInteger(){
	
	let testData = [
		{value:1, res:'', note:'テスト値はint型'},
		{value:'1', res:'', note:'テスト値は文字列型'},
		{value:123, res:'', note:'テスト値はint型'},
		{value:123456789123456789, res:'', note:'テスト値は大型のint型'},
		{value:1.0, res:'', note:'テスト値は浮動小数点'},
		{value:1.00, res:'', note:'テスト値は浮動小数点'},
		{value:+100, res:'', note:'テスト値は+記号あり'},
		{value:-100, res:'', note:'テスト値は-記号あり'},
		{value:'+100', res:'', note:'テスト値は+記号あり()'},
		{value:'-100', res:'', note:'テスト値は-記号あり'},
		{value:'abc', res:'', note:'テスト値は文字列あり'},
		{value:1.01, res:'', note:'テスト値は小数値あり'},
		{value:0.1, res:'', note:'テスト値は小数値あり'},
		{value:'100.1', res:'', note:'テスト値は小数値あり'},
		{value:0, res:'', note:'テスト値は数値の0'},
		{value:'0', res:'', note:'テスト値は文字列の0'},
		{value:'', res:'', note:'テスト値は空文字'},
		{value:null, res:'', note:'テスト値はnull'},
		{value:'2020/8/27', res:'', note:'テスト値は日付'},
	];
	
	for(let i in testData){
		let ent = testData[i];
		let value = ent.value;
		if(cbv.isInteger(value)){
			ent.res = '〇';
		}else{
			ent.res = '×';
		}
	}
	
	_showTestData('#test_is_integer tbody', testData); // テストデータを表示
	
}

// テストデータを表示
function _showTestData(tbody_slt, testData){
	let html = '';
	for(let i in testData){
		let ent = testData[i];
		html += `<tr><td>${ent.value}</td><td>${ent.res}</td><td>${ent.note}</td></tr>`;
		
	}
	$(tbody_slt).html(html);
}

