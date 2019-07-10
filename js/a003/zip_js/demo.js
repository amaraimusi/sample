/**
 * zip.jsのサンプル
 * @date 2016-10-25
 */


$( function() {
	

	//ファイルアップロードイベント
	$('#file1').change(function(e) {
		//ファイルオブジェクト配列を取得（配列要素数は選択したファイル数を表す）
		var files = e.target.files;
		var oFile = files[0];


		zip.createReader(new zip.BlobReader(oFile), function(reader) {


		  // get all entries from the zip
		  reader.getEntries(function(entries) {
			  
			  entries.forEach(function(entry) {
				  console.log(entry.filename);//■■■□□□■■■□□□■■■□□□)
				  $('#res').append(entry.filename + '<br>');
				});
			  

		  });
		  
		}, function(error) {
		  
			console.log(error);//■■■□□□■■■□□□■■■□□□)
		});
	});
});