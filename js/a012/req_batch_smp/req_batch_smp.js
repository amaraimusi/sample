

var reqBatch; // ReqBatch.js | リクエスト分散バッチ処理【シンプル版】

$(()=>{
	reqBatch = new ReqBatchSmp();
	var param = {
		div_xid:'req_batch_div',
		interval:300,
		fail_limit:5,
		ajax_url:'req_batch_smp.php',
		data:{
			index:0,
			name:'catdog',
		}
	}
	var callbacks = {
			thread_cb:thread1,
			complete_cb:allEnd,
	}
	reqBatch.init(param, callbacks)
	
});


function thread1(param){
	var data = param.data;
	console.log(param.main_index);
	jQuery('#res').append(data.name + '<br>');
	
	if(param.main_index == 10){
		reqBatch.stopThread();
	}
	
	return param;
}


function allEnd(param){
	jQuery('#res').append("<div class='text-success'>処理が終わった</div>");
	
}
