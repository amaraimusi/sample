/**
 * Blobの検証
 */

function test1(){
	
	// データソース。8bit数値配列形式のバイナリデータ。
	var i8ary = new Uint8Array([137,80,78,71]);
	var source = [ i8ary ];


	// オプション情報。コンテンツタイプ（MIME）など。
	var option = {
		type: "application/octet-binary"
	};


	// blobを作成
	var blob = new Blob( source , option );
	
	// 出力
	console.log(blob);
	$('#res1').append("blob.type : " + blob.type + '<br>');
	$('#res1').append("blob.size : " + blob.size + '<br>');
	
}
function testX(){
	var ary_u8 = new Uint8Array([0x00,0x01,0x02,0x03]);
	var source = [ ary_u8 ];

	// ------------------------------------------------------------
	// BlobPropertyBag オブジェクトを用意
	// ------------------------------------------------------------
	var blob_property_bag = {
		type: "application/octet-stream"
	};

	// ------------------------------------------------------------
	// Blob オブジェクトを作成（バイナリ形式）
	// ------------------------------------------------------------
	var blob = new Blob( source , blob_property_bag );
	console.log(blob);//■■■□□□■■■□□□■■■□□□)
	
	$('#res1').html(window.JSON.stringify(blob.type));

	// 出力テスト
	console.log("type:" + (blob.type)); // "application/octet-stream"
	console.log("size:" + (blob.size)); // 4


	// ------------------------------------------------------------
	// FileReader オブジェクトを生成
	// ------------------------------------------------------------
	var file_reader = new FileReader();

	// ------------------------------------------------------------
	// 読み込み完了時に実行されるイベント（成功失敗に関係なく）
	// ------------------------------------------------------------
	file_reader.onloadend = function(e){

		// エラー
		if(file_reader.error) return;

		// Uint8Array オブジェクトを作成する
		var ary_u8 = new Uint8Array(file_reader.result);

		// 出力テスト
		console.log(ary_u8); // [0x00,0x01,0x02,0x03]
	};

	// ------------------------------------------------------------
	// 読み込みを開始する（ArrayBuffer オブジェクトを得る）
	// ------------------------------------------------------------
	file_reader.readAsArrayBuffer(blob);
}