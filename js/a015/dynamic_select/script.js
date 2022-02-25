
let g_value;

function dynamicChange(no){
	
	let options = getOptions(no);
	
	let options_str = '';
	for(let key in options){
		let name = options[key];
		options_str += `<option value='${key}'>${name}</option>`;
	}
	
	$('#select1').html(options_str);
	
	$('#select1').val(g_value);
	
}

function getOptions(no){
	let options = null;
	if(no==1){
		options = {
			'kani':'カニ',
			'neko':'ネコ',
			'buta':'ブタ',
			'sika':'シカ',
			'wani':'ワニ',
		};
		
	}else if(no==2){
		options = {
			'hiratakuwagata':'ヒラタクワガタ',
			'miyamakuwagata':'ミヤマクワガタ',
			'neko':'ネコ',
		};
		
	}
	
	return options;
	
}

function selectChange(){
	let value = $("#select1").val();
	$('#res').html(value);
	g_value = value;
}
