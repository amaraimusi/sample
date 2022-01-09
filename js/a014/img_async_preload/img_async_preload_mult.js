$(()=>{
	
	let u = Math.floor(new Date());// UNIXタイムスタンプに変換
	let output = $('#res');
	output.html('読込開始<br>');
	
	let imgUrls = [
		'https://amaraimusi.sakura.ne.jp/photos/halther/y2019/m03/orig/20190319181616_1552986941299-1867207771.jpg',
		'https://amaraimusi.sakura.ne.jp/photos/halther/y2019/m03/orig/20190319182356_1552987380648-69218458.jpg',
		//'https://amaraimusi.sakura.ne.jp/photos/halther/y2019/m03/orig/20190319183136_15529878714601767213182.jpg',
		//'https://amaraimusi.sakura.ne.jp/photos/halther/y2019/m03/orig/20190319184912_1552988920905-2001212512.jpg',
		//'https://amaraimusi.sakura.ne.jp/photos/halther/y2019/m03/orig/20190324184033_15534203777882106212973.jpg',
	];
	
	// キャッシュを回避するためUNIXタイムスタンプをURLに付加する。
	for(let i in imgUrls){
		imgUrls[i] += '?v=' + u;
	}
	
	let imgObjList = [];
	for(let i in imgUrls){
		console.log(i);//■■■□□□■■■□□□
		let img_url = imgUrls[i];
		let imgObj = new Image();
		
		imgObj.onload = function(){
			console.log('読み込み完了');//■■■□□□■■■□□□
			output.append('読み込み完了<br>');
		}
		imgObj.src = img_url;
		imgObjList.push(imgObj);
		
		
	}
	
	//loadImages(imgUrls);
	
	/*
	const img = new Image();
	
	img.onload = function(){
		// 画像のプリロード完了後に実行する処理（同期的な画像の読込）
		let u2 = Math.floor(new Date());// UNIXタイムスタンプに変換
		let time = u2 - u;
		let imgElm = jQuery("#img1");
		imgElm.attr('src',img.src);
		output.append(time + "ミリ秒<br>");
		output.append('Success<br>');
	}
	
	// キャッシュを回避するためUNIXタイムスタンプをURLに付加している。
	let url = 'https://amaraimusi.sakura.ne.jp/photos/halther/y2019/m03/orig/20190324184033_15534203777882106212973.jpg?v=' + u;
	img.src = url;
	*/
	
	/*
	let u3 = Math.floor(new Date());// UNIXタイムスタンプに変換
	let time = u3 - u;
	output.append(time + "ミリ秒<br>");
		
	output.append('Success<br>');
	*/

});






async function loadImages(imgUrls){
	const promises = [];
	const images = [];
	imgUrls.forEach(function(url){
		var promise = new Promise(function(resolve){
			const img = new Image();
			img.onload = function(){
				console.log('loaded : '+url);
				resolve();
			}
			img.src = url;
			
			images.push(img)
		});
		promises.push(promise);
	});
	/// すべて読込完了まで待つ
	await Promise.all(promises);
	return images;
}
/// 画像読み込みするasyncな関数
async function main(){
	var images = await loadImages([
		'img1.jpg', 'img2.png'
	]);
	console.log('images : ', images);
}