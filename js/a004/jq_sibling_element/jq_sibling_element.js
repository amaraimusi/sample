/**
 * 兄弟要素を取得する
 * @date 2017-6-22
 */

$(function(){
	
	
	
	
});



function test1(){
	var elms = $('#test1').siblings();
	elms.each(function(){
		var str = $(this).html() + '<br>';
		$('#res1').append(str);
	});
}



function test2(){
	var elms = $('#test1').siblings('div');
	elms.each(function(){
		var str = $(this).html() + '<br>';
		$('#res2').append(str);
	});
}



function test3(){
	var elms = $('#test1').nextAll();
	elms.each(function(){
		var str = $(this).html() + '<br>';
		$('#res3').append(str);
	});
}



function test4(){
	var elms = $('#test1').parent().children();
	elms.each(function(){
		var str = $(this).html() + '<br>';
		$('#res4').append(str);
	});
}





