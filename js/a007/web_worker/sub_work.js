

//web worker
self.addEventListener('message', function(e) {

	var obj = e.data;
	
	obj['bark'] = obj.inu + 'がワインワインとせがむ';
	console.log(obj);
	
	sleep(3000);

	//処理結果を送信
	self.postMessage(obj);
}, false);


/**
 * スリープ
 * @param interval スリープ時間(ミリ秒）
 * 
 */
function sleep(interval){
	var start_u = Math.floor(new Date());
	
	var flg = true;
	while(flg){
		var now_u = Math.floor(new Date());
		if(now_u - start_u > interval){
			flg = false;
		}
	}
}