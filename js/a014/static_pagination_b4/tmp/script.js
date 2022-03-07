

function test1(){
	
	let ary1 = ['abc', 'ネコ', '300', '1000', 0.1, -3, 31,32,100,'10:02','0:15','1:2', 'baseball'];
	
	let ary2 = ary1.sort();
	console.log(ary2);//■■■□□□■■■□□□
	
	let boxs = getDataFromTable('table1'); // HTMLテーブルからデータを取得する
	
		// 昇順
	boxs = boxs.sort(function(a, b) {
		return (a.ent[3] > b.ent[3] ? 1: -1);
	});
	
	console.log(boxs);//■■■□□□■■■□□□
	
	reflection('table1', boxs);

}

function reflection(xid, boxs){
	
	let jqTbl = $('#' + xid);
	let jqTbody = jqTbl.find('tbody');
	jqTbody.html('');
	
	let tbody_html = '';
	for(let i in boxs){
		let box = boxs[i];
		let jqTr = box.jqTr;
		tbody_html += jqTr[0].outerHTML;
	}
	
	jqTbody.html(tbody_html);
}



// HTMLテーブルからデータを取得する
function getDataFromTable(xid){
	
	let jqTbl = $('#' + xid);
//	let jqThs = jqTbl.find('thead th');■■■□□□■■■□□□
//	let clm_cnt = jqThs.length;
//	console.log('clm_cnt＝' + clm_cnt);//■■■□□□■■■□□□
	
	let jqTrs = jqTbl.find('tbody tr')
	
	let boxs = [];
	
	jqTrs.each((i, tr) => {
		let jqTr = $(tr);
		let tds = jqTr.find('td');
		let clm_cnt = tds.length;
		let ent = {};
		for(let clm_i=0; clm_i <   clm_cnt; clm_i++){
			ent[clm_i] = tds.eq(clm_i).text();
		}
		ent['']
		let box = {
			'ent':ent,
			'jqTr':jqTr,
		}
		boxs.push(box);
	
	});
	
	return boxs;
	
}