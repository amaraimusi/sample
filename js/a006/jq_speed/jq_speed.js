/**
 * 
 */


function test1(){
	var t1 = +new Date(); // ミリ秒を取得

	for(var i=0;i<10000;i++){
		var text = $("#iroha").html();
	}
	
	var t2 = +new Date(); // ミリ秒を取得
	$("#res1").html(t2-t1);
	
	
}

function test2(){
	var t1 = +new Date(); // ミリ秒を取得

	var obj = $("#iroha");
	for(var i=0;i<10000;i++){
		var text = obj.html();
	}
	
	var t2 = +new Date(); // ミリ秒を取得
	
	$("#res2").html(t2-t1);
	
	
}


