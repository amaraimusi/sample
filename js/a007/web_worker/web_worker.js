


function test1(){

	output('setTimeout関数を使って　重たい初期化を実行中です。(約3秒)');
	
	window.setTimeout(() => {
		sleep(3000);
		output('初期化を終了しました。<br>');
	}, 1);
	
}


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

function parallelCheck1(){
	output('別の並列処理を実行しました。');
}





function test2(){
	
		output('Web Workerを使って　重たい初期化を実行中です。(約3秒)');
	
		// キャッシュ読み込み回避ようのUNIXタイムスタンプを取得
		var u = Math.floor(new Date());
		
		//workerオブジェクト
		var worker = new Worker('sub_work.js?u=' + u);

		var obj = {'inu':'イヌ'};

		//処理命令
		worker.postMessage(obj);
		
		//処理結果、受信イベント
		worker.addEventListener('message', function(e) {
			output(e.data.bark);
			output('並列処理を終了しました。');
		}, false);
}

function output(msg){
	jQuery('#res1').append(msg + '<br>');
	console.log(msg);
}
