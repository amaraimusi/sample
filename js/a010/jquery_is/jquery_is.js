/**
 * 
 */

$(() => {
	
	$("input").one('click', (evt) =>{

		var inp = $(evt.currentTarget);
		if (inp.is(":radio")) {
			alert('ラジオ入力です。');
		}
		if (inp.is(":text")) {
			alert('テキストボックス入力です。');
		}
		if (inp.is(".animal, .tori")) {
			alert('脊椎動物です。');
		}
		if (inp.is(".musi")) {
			alert('虫です。');
		}
		
	});
	

});