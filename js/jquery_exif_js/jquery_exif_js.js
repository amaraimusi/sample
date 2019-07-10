/**
 * jpegからExif情報を取得する | jquery.exif.js
 * 
 * @date 2016-5-16
 */

$(function(){
	$('#file1').change(function() {
		// アップロードファイルからExif情報を抜出す。
		$(this).fileExif(function(exif) {
			console.log(exif);
		});
	  
	});

});





function test(){
	
	// サーバー上の画像ファイルから、Ajaxを利用してバイトデータを取得する
	var xhr = new XMLHttpRequest();
	xhr.open('GET', 'img/test4.jpg', true);
	xhr.responseType = 'arraybuffer';
	xhr.onload = function(e) {
		
		// 画像ファイルのバイトデータを取得する
		var arrayBuffer = this.response;

		// バイトデータとコンテンツタイプからBlobを生成する
		var blob = new Blob([arrayBuffer], {type: "image/jpeg"});
		
		// BlobからExif情報を取得する
		$.fileExif(blob,function(exif){
			console.log(exif);
			var res = printProperties(exif);
			$('#res').html(res);
		});
	};

	xhr.send();

}

function printProperties(obj) {
    var properties = '';
    for (var prop in obj){
        properties += prop + "=" + obj[prop] + "<br>";
    }
    return properties;
}


