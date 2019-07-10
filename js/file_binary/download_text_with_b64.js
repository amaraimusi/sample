/**
 * BASE64をテキストファイルとしてダウンロードする
 * @date 2016-6-1
 */


function test1(){

	
	var text1 = $('#text1').val();
	
	// utf8からbase64に変換する。
	var b64 = utf8_to_b64(text1);
	
	// Blobを BASE64とMIMEコンテンツタイプから作成する。
	var mime_ctype = "text/plain";
	var blob = toBlob(b64,mime_ctype);
	
	// BlobURLスキームをBlobから作成する。
	var blob_url = window.URL.createObjectURL(blob);

	// a要素にBlobURLスキームをセットしてダウンロードできるようにする。
	$('#txt_dl').attr('href',blob_url);
	$('#txt_dl').attr('download','test.txt');
	
	
	$('#txt_dl').show();
	console.log(blob_url);
	
}

/**
 * BASE64とMIMEコンテンツタイプからBlobオブジェクトを作成する。
 * 日本語対応。
 * 
 * @param base64
 * @param mime_ctype MIMEコンテンツタイプ
 * @returns Blob
 */
function toBlob(base64,mime_ctype) {
	// 日本語の文字化けに対処するためBOMを作成する。
	var bom = new Uint8Array([0xEF, 0xBB, 0xBF]);
	
    var bin = atob(base64.replace(/^.*,/, ''));
    var buffer = new Uint8Array(bin.length);
    for (var i = 0; i < bin.length; i++) {
        buffer[i] = bin.charCodeAt(i);
    }
    // Blobを作成
    try{
        var blob = new Blob([bom,buffer.buffer], {
            type: mime_ctype,
            
        });
    }catch (e){
        return false;
    }
    return blob;
}

// utf8からbase64に変換する
function utf8_to_b64(str) {
	return window.btoa( unescape(encodeURIComponent( str )) );
}

// base64からutf8に変換する
function b64_to_utf8(str) {
	return decodeURIComponent( escape(window.atob( str )) );
}



