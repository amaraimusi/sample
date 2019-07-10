
function test1(){
	
	output('スタート');
	
	var i=0;
	function test(i){
		
		window.setTimeout(() => {
			output('コールバック' + i);
			i++;
			if(i<5){
				test(i);
			}
		},1000);
	}
	
	test(0); // 初回呼び出し
	
}

function output(msg){
	console.log(msg);
	jQuery('#res').append(msg + '<br>');
}