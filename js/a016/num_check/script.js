
$(()=>{
	
	let data= [
		{value:1000, note:'自然数'},
		{value:'900', note:'文字列型の数字'},
		{value:0.01, note:'小数値'},
		{value:'0.01', note:'文字列型の小数値'},
		{value:-900, note:'負の自然数'},
		{value:'-0.01', note:'文字列型の負の小数値'},
		{value:0, note:'数値型の0'},
		{value:'0', note:'文字列型の0'},
		{value:'', note:'空文字'},
		{value:undefined, note:'undefined'},
		{value:null, note:'null'},
		{value:'abcd', note:'数字ではない'},
		{value:' ', note:'半角スペース'},
		{value:true, note:'bool型のtrue'},
		{value:false, note:'bool型のfale'},
		{value:NaN, note:'NaN'},
	];
	
	let tbody1 = $('#tbody1');
	
	let trs_html = '';
	for(let i in data){
		let ent = data[i];
		console.log('ent.value=' + ent.value + '←' + ent.note);
		let res1 = isNaN(ent.value);
		let res2 = !isNaN(ent.value);
		let res3 = isFinite(ent.value);
		let res4 = Number.isNaN(ent.value);
		let res5 = Number.isFinite(ent.value);
		let res6 = Number.isInteger(ent.value);

		trs_html += `
			<tr>
				<td>${ent.note}</td>
				<td>${ent.value}</td>
				<td class='r_${res1}'>${res1}</td>
				<td class='r_${res2}'>${res2}</td>
				<td class='r_${res3}'>${res3}</td>
				<td class='r_${res4}'>${res4}</td>
				<td class='r_${res5}'>${res5}</td>
				<td class='r_${res6}'>${res6}</td>
			</tr>
		`;
		
	}
	
	tbody1.html(trs_html);
	
});