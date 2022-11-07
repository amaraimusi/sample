let animalList = {};

$(()=>{

	animalList['imori'] = 'イモリ';
	animalList['kaeru'] = 'カエル';
	animalList['sanshou-uo'] = 'サンショウウオ';
	animalList['hiki-gaeru'] = 'ヒキガエル';
	
});

function change1(tb){
	
	let jqTb = jQuery(tb);
	let name1 = jqTb.val();
	
	name1 += '';
	name1 = name1.trim();

	let value = '';
	for(let key in animalList){
		let name2 = animalList[key];
		if(name1 == name2 || name1 == key){
			value = key;
		}
	}
	
	jqTb.val(value);

}


