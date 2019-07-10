/**
 * AjaxCRUD.js	text()のテキスト取得について
 * @date 2016-9-28
 */



function test1(){
	var v = $('#neko').text();
	
	$('#res').html(v);
}

function test2(){
	var v = $('#neko :first').text();
	
	$('#res').html(v);
}


