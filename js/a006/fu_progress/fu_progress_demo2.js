
$(function(){
	
	var ajax_url = 'upload_demo2.php';
	
	fileuploadEx('#file1_wrap','#file1','#prog1',ajax_url,function(res){
		
		$('#res1').html(res);

	},
	{'fu_show_flg':1});
	
});

/**
 * ファイルアップロード要素のラッパー要素にファイルドラッグ＆ドロップイベントを追加する
 * 
 * @param wrap_slt ラッパー要素のセレクタ
 * @param fu_slt ファイルアップロード要素のセレクタ
 * @param prog_slt 進捗バー要素のセレクタ
 * @param ajax_url AJAX通信先URL
 * @param callback(res) ファイルアップロード後コールバック
 * @param option
 *  - fu_show_flg ファイルアップロード要素の表示 0:非表示（デフォルト） , 1:表示
 */
function fileuploadEx(wrap_slt,fu_slt,prog_slt,ajax_url,callback,option){
	
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
		_uploadByAjax(files,prog_slt,ajax_url,callback,option); // AJAXによるアップロード

	},false);
	
	fuw[0].addEventListener('dragover',function(evt){
		evt.preventDefault();
	},false);
	
	// ファイルアップロード要素のイベント
	var fu = $(fu_slt);
	fu.change(function(e) {
		
		var files = e.target.files; // ファイルオブジェクト配列を取得（配列要素数は選択したファイル数を表す）
		_uploadByAjax(files,prog_slt,ajax_url,callback,option); // AJAXによるアップロード
	});
	
	// ファイルアップロード要素の表示フラグがOFFならファイルアップロード要素を隠す。
	if(option.fu_show_flg == 0){
		fu.hide();
	}
	
}

/**
 * AJAXによるアップロード
 * @param files ファイルオブジェクトリスト
 * @param prog_slt 進捗バー要素のセレクタ
 * @param ajax_url AJAX通信先URL
 * @param callback(res) ファイルアップロード後コールバック
 * @param option
 */
function _uploadByAjax(files,prog_slt,ajax_url,callback,option){

	var fd = new FormData();
	for(var i in files){
		fd.append(i, files[i]);
	}

	var prog1 = $(prog_slt); // 進捗バー要素
	
	// AJAXによるファイルアップロード
	$.ajax({
		type: "POST",
		url: ajax_url,
		data: fd,
		cache: false,
		dataType: "text",
		processData : false,
		contentType : false,
		xhr : function() { // 進捗イベント
			var XHR = $.ajaxSettings.xhr();
			if (XHR.upload) {
				XHR.upload.addEventListener('progress',
						function(e) {
							var prog_value = parseInt(e.loaded / e.total * 10000) / 100;
							prog1.val(prog_value);
						}, false);
			}
			return XHR;
		},

	})
	.done(function(res, type) {

		callback(res);
		
	})
	.fail(function(jqXHR, statusText, errorThrown) {
		
		var err_res = jqXHR.responseText;
		console.log(err_res);
		jQuery('#err').html(err_res);
		alert(statusText);
	});
}