$(()=>{
	
	let u = Math.floor(new Date());// UNIXタイムスタンプに変換
	let output = $('#res');
	output.html('読込開始<br>');
	
	let imgUrls = [
		'https://amaraimusi.sakura.ne.jp/photos/halther/y2019/m03/orig/20190319181616_1552986941299-1867207771.jpg',
		'https://amaraimusi.sakura.ne.jp/photos/halther/y2019/m03/orig/20190319182356_1552987380648-69218458.jpg',
		'https://amaraimusi.sakura.ne.jp/photos/halther/y2019/m03/orig/20190319183136_15529878714601767213182.jpg',
		'https://amaraimusi.sakura.ne.jp/photos/halther/y2019/m03/orig/err.jpg', // 存在しない画像
	];
	
	// キャッシュを回避するためUNIXタイムスタンプをURLに付加する。
	for(let i in imgUrls){
		imgUrls[i] += '?v=' + u;
	}
	
	let imgsPreload = new ImgsPreload();
	let imgObjList = imgsPreload.preload(imgUrls, callbackTest, progress);
	

});

function callbackTest(imgObjList){
	console.log('すべての画像のプリロードした時のコールバックを呼び出しました。');
	for(let key in imgObjList){
		let img = imgObjList[key];
		$('#img' + key).attr('src', img.src);
	}
	
	$('#res').append('すべての画像のプリロード完了<br>');
}

function progress(param){
	$('#res').append(`進捗→${param.counter}/${param.data_cnt}<br>`);
}



