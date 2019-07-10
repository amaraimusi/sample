/**
 * File API | ファイルからテキストデータを取得
 * @date 2016-2-29 新規作成
 */

$( function() {

	

	//ファイルアップロードイベント
	$('#file1').change(function(e) {

		//ファイルオブジェクト配列を取得（配列要素数は選択したファイル数を表す）
		var files = e.target.files;
		var fileObj = files[0];
		
		//ファイルリーダーにファイルオブジェクトを渡すと、ファイル読込完了イベントなどをセットする。
		var reader = new FileReader();
		reader.readAsText(fileObj, "Shift_JIS");
		
		//ファイル読込完了イベント
		reader.onload = function(evt) {
			
			//テキストデータを取得する
			var text_data = evt.target.result;
			
			//XSSサニタイズ
			text_data = xssSanitaizeEncode(text_data);
			
			//出力
			$("#res").html(text_data);
		}
		

	});

});


 
//XSSサニタイズエンコード
function xssSanitaizeEncode(str){
	return str.replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
}