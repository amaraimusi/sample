

var reqBatch; // ReqBatch.js | リクエストを1件ずつ、実行するバッチ処理

$(()=>{
	reqBatch = new ReqBatch();
	reqBatch.init({
		div_xid:'req_batch_div',
		interval:300,
		fail_limit:5,
		ajax_url:'text_distributed_batch.php',
		asyn_res_cb:response1,
		complete_cb:allEnd
	})
	
});

function start(){
	
	var data = _getSampleData(); // サンプルデータを取得する
	
	// バッチ処理開始
	reqBatch.start(data);
}

function _getSampleData(){
	var data = []
	for(var i=0;i<10;i++){
		var ent = {id:i+1};
		data.push(ent);
	}
	return data;
}

function response1(index, param){
	jQuery('#res').append(param.name + '<br>');
}

function allEnd(){
	jQuery('#res').append("<div class='text-success'>処理が終わった</div>");
	
}
