$(()=>{
	
	let u = Math.floor(new Date());// UNIXタイムスタンプに変換
	let output = $('#res');
	output.html('読込開始<br>');
	
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