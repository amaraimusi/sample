/**
 * 
 */


$(function(){
	
	dndFileuploadInit('#file1_wrap','#file1',function(files){
		var fns = [];
	
		for (var i = 0; i < files.length; i++) {
			fns.push(files[i].name);
		}
		
		// ファイル名を出力する
		var strFns = fns.join("<br>");
		$('#res1').html(strFns);

	});
	
});



/**
 * ファイルアップロード要素のラッパー要素にファイルドラッグ＆ドロップイベントを追加する
 * 
 * @param wrap_slt ラッパー要素のセレクタ
 * @param fu_slt ファイルアップロード要素のセレクタ
 * @param callback(files) callback after file set: ファイルセット後に実行するコールバック関数
 *  - files ファイルオブジェクトリスト
 * @param option
 *  - fu_show_flg ファイルアップロード要素の表示 0:非表示（デフォルト） , 1:表示
 */
function dndFileuploadInit(wrap_slt,fu_slt,callback,option){
	
	if(option == null){
		option = {};
	}
	
	if(option['fu_show_flg'] == null){
		option['fu_show_flg'] = 0;
	}
	
	var fuw = $(wrap_slt);
	
	// DnDイベントをラッパー要素に追加
	fuw[0].addEventListener('drop',function(evt){
		evt.stopPropagation();
		evt.preventDefault();

		var files = evt.dataTransfer.files; 
		callback(files);

	},false);
	
	fuw[0].addEventListener('dragover',function(evt){
		evt.preventDefault();
	},false);
	
	// ファイルアップロード要素のイベント
	var fu = $(fu_slt);
	fu.change(function(e) {
		
		var files = e.target.files; // ファイルオブジェクト配列を取得（配列要素数は選択したファイル数を表す）
		callback(files);
	});
	
	// ファイルアップロード要素の表示フラグがOFFならファイルアップロード要素を隠す。
	if(option.fu_show_flg == 0){
		fu.hide();
	}
	
}