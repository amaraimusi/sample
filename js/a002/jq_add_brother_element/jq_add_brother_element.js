/**
 * Add brother element | 兄弟要素を追加する | jQuery
 * @date 2016-9-16
 */

function test1_1(){
	
	$('#sample1').after('<div>123</div>');
}

function test1_2(){
	var h = $('#sample1').next();
	alert(h.html());
}

function test2_1(){
	
	$('#sample2').before('<div>123</div>');
}

function test2_2(){
	var h = $('#sample2').prev();
	alert(h.html());
}