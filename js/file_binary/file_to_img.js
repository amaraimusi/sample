
/**
 * ファイル送信要素から画像を取り込み、img要素に出力する
 * @date 2016-5-17
 */




$( function() {

	//ファイルアップロードイベント
	$('#file1').change(function(e) {

		//ファイルオブジェクト配列を取得（配列要素数は選択したファイル数を表す）
		var files = e.target.files;
		var oFile = files[0];

		var reader = new FileReader();
		reader.readAsDataURL(oFile);
	
		//ファイル読込成功イベント
		reader.onload = function(evt) {
			$('#img1').attr('src',reader.result);
		}
	});

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