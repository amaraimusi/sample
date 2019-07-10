/**
 * 
 */

function test1(){
	
	var obj = jQuery('#neko');
	
	if(obj.hasClass('red')){
		obj.removeClass('red');
	}else{
		obj.addClass('red');
	}
}

function test2(){
	jQuery('#neko').toggleClass('big');
}

function test3(){
	
	var obj = jQuery('#neko');
	
	if(obj.hasClass('red')){
		obj.removeClass('red big');
	}else{
		obj.addClass('red big');
	}
}

function test4(){
	
	var obj = jQuery('.btn-success');
	
	if(obj.hasClass('btn-xs')){
		obj.removeClass('btn-xs');
	}else{
		obj.addClass('btn-xs');
	}
}

