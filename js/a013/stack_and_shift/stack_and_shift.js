/**
 * 
 */

let ary1 = [];
let count = 100;

function addAction(){
	ary1.push(count);
	count ++;
	debug(ary1);
}

function shiftAction(){
	ary1.shift();
	count ++;
	debug(ary1);
}

function debug(ary1){
	let json_str = JSON.stringify(ary1);
	$('#res').html(json_str);
}