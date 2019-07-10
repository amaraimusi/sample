

var reqBatch; // ReqBatch.js | リクエストを1件ずつ、実行するバッチ処理

$(()=>{
	reqBatch = new ReqBatch();
	reqBatch.init({
		div_xid:'req_batch_div',
		interval:300,
		fail_limit:5,
		asyn_cb:asyn_test1,
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
	for(var i=0;i<40;i++){
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

/**
 * 外・非同期処理
 * @param index インデックス
 * @param ent エンティティ
 */
function asyn_test1(index, ent){
	
	var sendData = ent;
	var send_json = JSON.stringify(sendData);//データをJSON文字列にする。

	// AJAX
	jQuery.ajax({
		type: "POST",
		url: 'ajax_req_batch_exe.php',
		data: "key1=" + send_json,
		cache: false,
		dataType: "text",
	})
	.done((res_json, type) => {
		var res;
		try{
			res =jQuery.parseJSON(res_json);//パース

		}catch(e){
			reqBatch.asynFail(res_json); // 非同期処理・失敗
			return;
			
		}
		
		reqBatch.asynSuccess(res); // 非同期処理・成功

	})
	.fail((jqXHR, statusText, errorThrown) => {
		console.log(jqXHR.responseText);
		jQuery('#err').append(jqXHR.responseText);
		alert(statusText);
	});
	
}
