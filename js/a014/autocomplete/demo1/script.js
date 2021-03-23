
function test1(data_no){
	let list2 = [];
	if(data_no == 2){
		list2 = ['かまいたち','からす', 'かまねこ', 'かます', 'かまきり', 'かたくりこ', 'きつね', 'くま'];
	}else{
		list2 = ['さむらい','さむい', 'さきほこる', 'さにー'];	
	}
	 
	
	let list2_option_html = '';
	for(i in list2){
		let v2 = list2[i];
		list2_option_html += `<option value="${v2}"></option>`;
	}
	//
	
	$('#list1').html(list2_option_html);
}

function _getList2() {
	let list2 = ['かまいたち','からす', 'かまねこ', 'かます', 'かまきり', 'かたくりこ', 'きつね', 'くま'];
	return list2;
}