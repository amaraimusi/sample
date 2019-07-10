
/**
 * サーバー上のファイルからblobを作成する
 * @date 2016-5-20
 */


function test1(){
	var xhr = new XMLHttpRequest();
	xhr.open('GET', 'smp1.png', true);
	xhr.responseType = 'arraybuffer';
	xhr.onload = function(e) {
		
		var arrayBuffer = this.response;

		// Blobを生成する
		var blob = new Blob([arrayBuffer], {type: "image/png"});
		console.log(blob);
		
		// BlobをBlobURLスキームに変換して、img要素にセットする。
		var blob_url = window.URL.createObjectURL(blob);
		console.log(blob_url);//■■■□□□■■■□□□■■■□□□)
		$('#img1').attr('src',blob_url);
		
		
	};

	xhr.send();
}

