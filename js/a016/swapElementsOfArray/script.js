let data;


$(()=>{
	
	data = [
		{name:'イヌ'},
		{name:'ネコ'},
		{name:'ブタ'},
		{name:'シカ'},
	];
	
	view(data);
});

function view(data){
	let html = '';
	for(let i in data){
		let ent = data[i];
		html += ent.name + '<br>';
	}
	$('#res').html(html);
}

function test(){
	let index1 = $('#index1').val();
	let index2 = $('#index2').val();
	console.log('index1＝' + index1);//■■■□□□■■■□□□
	data = swapElementsOfArray(data, index1, index2);
	view(data);
}

/**
 * 配列の要素を入替
 * @param [] ary 対象の配列
 * @param int from_index 入替元インデックス
 * @param int to_index 入替先インデックス
 * @return [] 要素入替後の配列
 */
function swapElementsOfArray(ary, from_index, to_index){

	if(from_index < 0) throw Error('Error:220710A');
	if(from_index >= ary.length) throw Error('Error:220710B');
	if(to_index < 0) throw Error('Error:220710C');
	if(to_index >= ary.length) throw Error('Error:220710D');
	
	let ary2 = [];
	let value1 = ary[from_index];
	let value2 = ary[to_index];
	for(let i in ary){
		if(i == from_index){
			ary2.push(value2);
		}else if(i == to_index){
			ary2.push(value1);
		}else{
			ary2.push(ary[i]);
		}
	}
	return ary2;
}

