/**
 * File API | ファイル読込の進捗
 * @date 2016-3-2 新規作成
 */

$( function() {

	
	// ファイルアップロードAPIの初期化
	initFileApi();
	

});


/**
 * ファイルアップロードAPIの初期化
 */
function initFileApi(){
	//ファイルアップロードイベント
	$('#file1').change(function(e) {

		//ファイルオブジェクト配列を取得（配列要素数は選択したファイル数を表す）
		var files = e.target.files;
		var fileObj = files[0];
		
		//ファイルリーダーにファイルオブジェクトを渡すと、ファイル読込完了イベントなどをセットする。
		var reader = new FileReader();
		reader.readAsText(fileObj, "Shift_JIS");
		
	    reader.onloadstart = function(e) {
	    	$('#prog').html('0%');
	    };
	      
		//ファイル読込進捗
		reader.onprogress =function(evt){
			readerOnProgress(evt);
		}
		
		//ファイル読込成功イベント
		reader.onload = function(evt) {
			readerOnLoad(evt);
		}
		
		//ファイル読込中断
		reader.onabort = function(evt) {
			alert('中断されました。');
		}
		
		//ファイル読込エラー
		reader.onerror = function(evt) {
			alert('読み込み中にエラーが発生しました。');
		}
		
		//ファイル読込完了イベント（成功と失敗両方）
		reader.onloadend = function(evt) {
			$("#res").append('：処理完了');
		}
		
		
	});
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