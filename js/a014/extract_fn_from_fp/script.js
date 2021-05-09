

$(()=>{
	
	
	let tests = [
		'/animals/cat/red_cat.jpg',
		'http://localhost/animals/cat/red_cat.jpg',
		'http://localhost/animals/cat',
		'abcd',
		'kuroneko.png',
		'',
		null,
	];
	
	let trs_html= '';
	for(let i in tests){
		let fp = tests[i];
		
		let fn = _extractFileNameFromFp(fp); // ファイルパスからファイル名を取得する
		trs_html += `<tr><td>${fp}</td><td>${fn}</td></tr>`; 
		
	}
	
	let html = 
		`
			<table class='tbl2'>
				<thead><tr><th>ファイルパス</th><th>ファイル名</th></tr></thead>
				<tbody>
					${trs_html}
				</tbody>
			</table>
		`;
	
	$('#res').html(html);
	
});

/**
 * ファイルパスからファイル名を取得する
 * 
 * @param string fp ファイルパス
 * @return string ファイル名
 */
function _extractFileNameFromFp(fp){
	if(fp == null) return '';
	
	let ary = fp.split(/\/|\\/);
	let fn = ary[ary.length-1];
	
	return fn;
}