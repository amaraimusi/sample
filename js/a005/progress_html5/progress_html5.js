/**
 * 
 */

function test1(){
	
	var prog1 = $('#prog1');
	var v = prog1.val();
	if(v==null){
		v=0;
	}else{
		v += 10;
	}
	
	prog1.val(v);
	
	
}