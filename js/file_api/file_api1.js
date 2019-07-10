/**
 * File API 基本
 * @date 2016-2-25 新規作成
 */

$( function() {

	//ファイルアップロードイベント
	$('#file1').change(function(e) {

		//ファイルオブジェクト配列を取得（配列要素数は選択したファイル数を表す）
		var files = e.target.files;
		
		//ファイルオブジェクトからファイル名、ファイルサイズ、MIMEタイプ、更新日時を取得する。
		var fileInfo = "none";
		for(var i = 0; i < files.length; i++){
			var fileObj = files[i];
			fileInfo +=
				'ファイル名：' + fileObj.name + '<br>' +
				'ファイルサイズ：' + fileObj.size + ' Byte<br>' +
				'MIME：' + fileObj.type + '<br>' +
				'更新日時：' + fileObj.lastModifiedDate + '<hr>';
			}
		
		$('#res').append(fileInfo);

	});

});


 
