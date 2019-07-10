
/**
 * ファイル送信要素から画像を取り込み、img要素に出力する
 * @date 2016-5-17
 */




$( function() {
	
	reader.readAsDataURL('smp1.png');
	
	//ファイル読込成功イベント
	reader.onload = function(evt) {
		
		// データURLスキーム形式のバイナリデータ
		console.log(reader.result);
		
		// base64形式のバイナリデータ
		var base64 = btoa(reader.result);
		console.log(base64);
	}

//	//ファイルアップロードイベント1
//	$('#file1').change(function(e) {
//
//		var files = e.target.files;
//		var oFile = files[0];
//
//		var reader = new FileReader();
//		reader.readAsDataURL(oFile);
//	
//		//ファイル読込成功イベント
//		reader.onload = function(evt) {
//			
//			// データURLスキーム形式のバイナリデータ
//			console.log(reader.result);
//			
//			// base64形式のバイナリデータ
//			var base64 = btoa(reader.result);
//			console.log(base64);
//		}
//	});
//	
//	
//	
//	//ファイルアップロードイベント2
//	$('#file2').change(function(e) {
//
//		var files = e.target.files;
//		var oFile = files[0];
//
//		var reader = new FileReader();
//		reader.readAsArrayBuffer(oFile);
//	
//		//ファイル読込成功イベント
//		reader.onload = function(evt) {
//			
//			// データURLスキーム形式のバイナリデータ
//			console.log(reader.result);
//			
//			// 8bit数値配列
//			var ary_u8 = new Uint8Array(reader.result);
//			console.log(ary_u8);
//		}
//	});
//	
//	
//	
//	//ファイルアップロードイベント3
//	$('#file3').change(function(e) {
//
//		var files = e.target.files;
//		var oFile = files[0];
//
//		var reader = new FileReader();
//		reader.readAsBinaryString(oFile);
//	
//		//ファイル読込成功イベント
//		reader.onload = function(evt) {
//			
//			// バイナリデータX
//			//console.log(reader.result);
//			
//			var binaryResponse = new BinaryFile(reader.result);
//			
//			console.log(binaryResponse);//■■■□□□■■■□□□■■■□□□)
//			
////			// 8bit数値配列
////			var ary_u8 = new Uint8Array(reader.result);
////			console.log(ary_u8);
//		}
//	});

});








function Base64ToImage(base64img, callback) {
    var img = new Image();
    img.onload = function() {
        callback(img);
    };
    img.src = base64img;
}



/**
 * ファイル読込完了イベント
 */
function readerOnLoad(evt){
	//テキストデータを取得する
	//var text_data = evt.target.result;
	
	//XSSサニタイズ
	//text_data = xssSanitaizeEncode(text_data);
	
	//出力
	$("#res").html('読込成功');
}

/**
 * ファイル読込進捗
 * 
 * サイズが大きいファイルをアップロードするとき、この関数は複数回、呼び出される。
 */
function readerOnProgress(evt){
	
	var prog = Math.round(100 * evt.loaded / evt.total);
	var msg= prog + '%';
	
	console.log(msg);
	$("#prog").html(msg);
}





 
//XSSサニタイズエンコード
function xssSanitaizeEncode(str){
	return str.replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
}