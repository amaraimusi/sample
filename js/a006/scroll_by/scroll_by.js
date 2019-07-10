/**
 * 
 */


function test1(slt,scroll_value){
	

	var elm = $(slt);
	
	if(typeof elm[0].scrollBy == 'function'){
		elm[0].scrollBy( 0, scroll_value ) ;
	}else{
		console.log('スクロールはサポート外です');
	}
	
}