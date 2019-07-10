
/**
 * FileReaderでBlobを読み取る：サンプル
 * @date 2016-5-27
 */


function test1(){
	
	// サーバー上の画像ファイルから、Ajaxを利用してバイトデータを取得する
	var xhr = new XMLHttpRequest();
	xhr.open('GET', 'smp1.png', true);
	xhr.responseType = 'arraybuffer';
	xhr.onload = function(e) {
		
		// 画像ファイルのバイトデータを取得する
		var arrayBuffer = this.response;

		// バイトデータとコンテンツタイプからBlobを生成する
		var blob = new Blob([arrayBuffer], {type: "image/png"});

		// Blobを読込、データURLスキームとして出力する処理を非同期で開始する。
		var reader = new FileReader();
		reader.readAsDataURL(blob);
	
		// Blob読込後のイベント
		reader.onload = function(evt) {
			
			// データURLスキームを取得する
			var data_url = reader.result;
			console.log(data_url);
			
			// データURLスキームを画像表示させる。
			$('#img1').attr('src',data_url);
			
			// データURLスキームからbase64形式に変換してみる
			var base64 = btoa(data_url);
			console.log(base64);
		}
	};

	xhr.send();
}

